<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('items')->orderBy('created_at', 'desc');
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('table_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }
        
        $orders = $query->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dishes = Dish::where('available', true)->with('category')->get();
        return view('admin.orders.create', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string',
            'customer_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.dish_id' => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $items = [];

            foreach ($validated['items'] as $item) {
                $dish = Dish::findOrFail($item['dish_id']);
                $quantity = $item['quantity'];
                $unitPrice = $dish->price;
                $totalPrice = $unitPrice * $quantity;
                
                $totalAmount += $totalPrice;
                
                $items[] = [
                    'dish_id' => $dish->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'notes' => $item['notes'] ?? null,
                ];
            }

            $order = Order::create([
                'table_number' => $validated['table_number'],
                'customer_name' => $validated['customer_name'],
                'total_amount' => $totalAmount,
                'notes' => $validated['notes'],
                'status' => Order::STATUS_PENDING,
                'user_id' => Auth::id(),
            ]);

            foreach ($items as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Pedido criado com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao criar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['items.dish', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in([
                Order::STATUS_PENDING,
                Order::STATUS_PREPARING,
                Order::STATUS_READY,
                Order::STATUS_DELIVERED,
                Order::STATUS_CANCELED
            ])],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status do pedido atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pedido excluído com sucesso.');
    }

    /**
     * Create a new order (API).
     */
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string',
            'customer_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.dish_id' => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $items = [];

            foreach ($validated['items'] as $item) {
                $dish = Dish::findOrFail($item['dish_id']);
                $quantity = $item['quantity'];
                $unitPrice = $dish->price;
                $totalPrice = $unitPrice * $quantity;
                
                $totalAmount += $totalPrice;
                
                $items[] = [
                    'dish_id' => $dish->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'notes' => $item['notes'] ?? null,
                ];
            }

            $order = Order::create([
                'table_number' => $validated['table_number'],
                'customer_name' => $validated['customer_name'],
                'total_amount' => $totalAmount,
                'notes' => $validated['notes'],
                'status' => Order::STATUS_PENDING,
                'user_id' => Auth::id(),
            ]);

            foreach ($items as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            // se for uma solicitação ajax retorna como json
            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pedido criado com sucesso',
                    'order' => $order->load('items.dish'),
                ]);
            }
            
            // se for uma solicitação web padrão redireciona com mensagem
            return redirect()->back()->with('success', 'Pedido criado com sucesso');

        } catch (\Exception $e) {
            // mesma coisa
            DB::rollBack();
            
            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao criar pedido: ' . $e->getMessage(),
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Erro ao criar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Get order status (API).
     */
    public function getOrderStatus(Order $order)
    {
        $order->load('items.dish');
        return response()->json($order);
    }
} 