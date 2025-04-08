@extends('layouts.menu')

@section('title', $dish->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-4">
        <a href="{{ route('menu.index') }}" class="inline-flex items-center text-amber-600 hover:text-amber-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar ao Cardápio
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                @if($dish->image)
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-72 md:h-full object-cover">
                @else
                <div class="w-full h-72 md:h-full bg-gray-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
            </div>
            
            <div class="md:w-1/2 p-6 md:p-8">
                <div class="mb-2">
                    <span class="text-sm text-gray-500">{{ $dish->category->name }}</span>
                </div>
                
                <h1 class="text-3xl font-bold mb-2">{{ $dish->name }}</h1>
                
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400 mr-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($dish->ratings()->avg('rating') ?? 0))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">{{ number_format($dish->ratings()->avg('rating') ?? 0, 1) }} ({{ $dish->ratings->count() }} avaliações)</span>
                </div>
                
                <div class="text-2xl font-bold text-amber-600 mb-6">
                    R$ {{ number_format($dish->price, 2, ',', '.') }}
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Descrição</h2>
                    <p class="text-gray-700">{{ $dish->description }}</p>
                </div>
                
                @if($dish->ingredients)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Ingredientes</h2>
                    <p class="text-gray-700">{{ $dish->ingredients }}</p>
                </div>
                @endif
                
                @if($dish->allergens)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Informações sobre Alergênicos</h2>
                    <p class="text-gray-700">{{ $dish->allergens }}</p>
                </div>
                @endif
                
                <div class="flex flex-wrap gap-2 mb-6">
                    @if($dish->is_vegetarian)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Vegetariano
                    </span>
                    @endif
                    
                    @if($dish->is_vegan)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Vegano
                    </span>
                    @endif
                    
                    @if($dish->is_gluten_free)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Sem Glúten
                    </span>
                    @endif
                    
                    @if($dish->preparation_time)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $dish->preparation_time }} min
                    </span>
                    @endif
                </div>
                
                <div class="flex items-center">
                    <div class="flex items-center mr-4">
                        <button type="button" class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300" id="decrease-quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <input type="number" min="1" value="1" class="w-12 text-center mx-2 border-0" id="dish-quantity" readonly>
                        <button type="button" class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300" id="increase-quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                    
                    <button type="button" class="flex-1 py-3 bg-gradient-to-r from-amber-600 to-red-600 text-white font-bold rounded-lg shadow hover:from-amber-700 hover:to-red-700 transition" id="add-to-cart" data-dish-id="{{ $dish->id }}" data-dish-name="{{ $dish->name }}" data-dish-price="{{ $dish->price }}">
                        Adicionar ao Pedido
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Avaliações</h2>
        
        @if($dish->ratings->count() > 0)
            <div class="space-y-6">
                @foreach($dish->ratings()->with('user')->latest()->take(5)->get() as $rating)
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex justify-between mb-2">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-amber-100 text-amber-800">
                                        {{ substr($rating->user->name ?? 'Anônimo', 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-semibold">{{ $rating->user->name ?? 'Anônimo' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $rating->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating->rating)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        @if($rating->comment)
                            <p class="text-gray-700">{{ $rating->comment }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
            
            @if($dish->ratings->count() > 5)
                <div class="mt-4 text-center">
                    <button type="button" class="text-amber-600 hover:text-amber-800 font-medium">
                        Ver mais avaliações
                    </button>
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500">Este prato ainda não possui avaliações.</p>
            </div>
        @endif
    </div>
    
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Você pode gostar também</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(App\Models\Dish::where('category_id', $dish->category_id)->where('id', '!=', $dish->id)->where('available', true)->take(3)->get() as $relatedDish)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 bg-gray-200">
                    @if($relatedDish->image)
                    <img src="{{ asset('storage/' . $relatedDish->image) }}" alt="{{ $relatedDish->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold">{{ $relatedDish->name }}</h3>
                        <span class="font-bold text-amber-600">R$ {{ number_format($relatedDish->price, 2, ',', '.') }}</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $relatedDish->description }}</p>
                    
                    <a href="{{ route('menu.dish', $relatedDish) }}" class="block text-center py-2 bg-amber-100 text-amber-800 font-medium rounded hover:bg-amber-200 transition">
                        Ver Detalhes
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.getElementById('decrease-quantity');
        const increaseBtn = document.getElementById('increase-quantity');
        const quantityInput = document.getElementById('dish-quantity');
        const addToCartBtn = document.getElementById('add-to-cart');
        
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
        
        addToCartBtn.addEventListener('click', function() {
            const dishId = this.getAttribute('data-dish-id');
            const dishName = this.getAttribute('data-dish-name');
            const dishPrice = parseFloat(this.getAttribute('data-dish-price'));
            const quantity = parseInt(quantityInput.value);
            
            // aqui falta a logica pra adicionar no carrinho
            alert(`${quantity}x ${dishName} adicionado ao pedido!`);
            
            // por enquanto vai só atualizar contagem no carrinho
            const cartCount = document.getElementById('cart-count');
            cartCount.textContent = parseInt(cartCount.textContent) + quantity;
        });
    });
</script>
@endpush 