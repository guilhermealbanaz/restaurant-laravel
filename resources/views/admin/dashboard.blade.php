@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Painel de Controle</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pedidos Pendentes</p>
                    <h2 class="text-2xl font-bold">{{ App\Models\Order::where('status', App\Models\Order::STATUS_PENDING)->count() }}</h2>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="block mt-4 text-sm text-blue-500 hover:underline">Ver todos pedidos →</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Categorias</p>
                    <h2 class="text-2xl font-bold">{{ App\Models\Category::count() }}</h2>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="block mt-4 text-sm text-blue-500 hover:underline">Gerenciar categorias →</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pratos</p>
                    <h2 class="text-2xl font-bold">{{ App\Models\Dish::count() }}</h2>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.dishes.index') }}" class="block mt-4 text-sm text-blue-500 hover:underline">Gerenciar pratos →</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">QR Codes</p>
                    <h2 class="text-2xl font-bold">{{ App\Models\QrCode::count() }}</h2>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.qrcodes.index') }}" class="block mt-4 text-sm text-blue-500 hover:underline">Gerenciar QR Codes →</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Pedidos Recentes</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-3 pr-4">ID</th>
                            <th class="pb-3 pr-4">Mesa</th>
                            <th class="pb-3 pr-4">Total</th>
                            <th class="pb-3 pr-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Models\Order::latest()->take(5)->get() as $order)
                        <tr class="border-b">
                            <td class="py-3 pr-4">#{{ $order->id }}</td>
                            <td class="py-3 pr-4">{{ $order->table_number }}</td>
                            <td class="py-3 pr-4">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                            <td class="py-3 pr-4">
                                <span class="@if($order->status === App\Models\Order::STATUS_PENDING) bg-yellow-100 text-yellow-800 @elseif($order->status === App\Models\Order::STATUS_PREPARING) bg-blue-100 text-blue-800 @elseif($order->status === App\Models\Order::STATUS_READY) bg-green-100 text-green-800 @elseif($order->status === App\Models\Order::STATUS_DELIVERED) bg-gray-100 text-gray-800 @else bg-red-100 text-red-800 @endif px-2 py-1 rounded text-xs">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Pratos Populares</h3>
            <div class="space-y-4">
                @php
                $popularDishes = App\Models\OrderItem::selectRaw('dish_id, SUM(quantity) as total_quantity')
                    ->groupBy('dish_id')
                    ->orderByDesc('total_quantity')
                    ->take(5)
                    ->with('dish')
                    ->get();
                @endphp

                @foreach($popularDishes as $item)
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if($item->dish->image)
                        <img src="{{ asset('storage/' . $item->dish->image) }}" alt="{{ $item->dish->name }}" class="w-12 h-12 object-cover rounded">
                        @else
                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="text-sm font-medium">{{ $item->dish->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $item->total_quantity }} pedidos</p>
                    </div>
                    <div class="text-sm font-medium">
                        R$ {{ number_format($item->dish->price, 2, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 