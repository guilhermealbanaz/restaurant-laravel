<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dish::with('category');

        // Filtrar por categoria
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Filtrar por disponibilidade
        if ($request->has('available')) {
            $query->where('available', $request->boolean('available'));
        }
        
        // Filtrar por destaque
        if ($request->has('featured')) {
            $query->where('featured', $request->boolean('featured'));
        }
        
        // Filtrar por dietas especiais
        if ($request->has('is_vegetarian')) {
            $query->where('is_vegetarian', $request->boolean('is_vegetarian'));
        }
        
        if ($request->has('is_vegan')) {
            $query->where('is_vegan', $request->boolean('is_vegan'));
        }
        
        if ($request->has('is_gluten_free')) {
            $query->where('is_gluten_free', $request->boolean('is_gluten_free'));
        }
        
        // Busca p nome ou ingrediente
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }
        
        // Ordena
        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');
        
        if (in_array($sortField, ['name', 'price', 'preparation_time', 'created_at'])) {
            $query->orderBy($sortField, $sortDirection);
        }
        
        // Pagina
        $dishes = $query->paginate(15)->withQueryString();
        
        // pega as categorias para o filtro
        $categories = Category::where('active', true)->orderBy('name')->get();
        
        return view('admin.dishes.index', compact('dishes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('active', true)->orderBy('name')->get();
        return view('admin.dishes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
            'is_vegetarian' => 'boolean',
            'is_vegan' => 'boolean',
            'is_gluten_free' => 'boolean',
            'available' => 'boolean',
            'featured' => 'boolean',
            'preparation_time' => 'nullable|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dishes', 'public');
        }

        Dish::create($validated);

        return redirect()->route('admin.dishes.index')
            ->with('success', 'Prato criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $categories = Category::where('active', true)->orderBy('name')->get();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
            'is_vegetarian' => 'boolean',
            'is_vegan' => 'boolean',
            'is_gluten_free' => 'boolean',
            'available' => 'boolean',
            'featured' => 'boolean',
            'preparation_time' => 'nullable|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::disk('public')->delete($dish->image);
            }
            $validated['image'] = $request->file('image')->store('dishes', 'public');
        }

        $dish->update($validated);

        return redirect()->route('admin.dishes.index')
            ->with('success', 'Prato atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        if ($dish->image) {
            Storage::disk('public')->delete($dish->image);
        }

        $dish->delete();

        return redirect()->route('admin.dishes.index')
            ->with('success', 'Prato excluído com sucesso.');
    }

    /**
     * Get dish details with ratings (API).
     */
    public function getDishDetails(Dish $dish)
    {
        $dish->load(['category', 'ratings']);
        
        // Calculate average rating
        $dish->average_rating = $dish->ratings->avg('rating') ?? 0;
        $dish->ratings_count = $dish->ratings->count();
        
        return response()->json($dish);
    }

    /**
     * Get featured dishes (API).
     */
    public function getFeaturedDishes()
    {
        $dishes = Dish::where('available', true)
            ->where('featured', true)
            ->with('category')
            ->get();

        foreach ($dishes as $dish) {
            $dish->average_rating = $dish->ratings()->avg('rating') ?? 0;
        }

        return response()->json($dishes);
    }
} 