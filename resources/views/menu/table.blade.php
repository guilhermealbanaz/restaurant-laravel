@extends('layouts.menu')

@section('title', 'Cardápio Digital - Mesa ' . $tableNumber ?? '')

@section('content')
<div class="bg-gradient-to-r from-amber-500 to-red-500 text-white py-10">
    <div class="container mx-auto px-4 text-center">
        <h1 class="font-playfair text-3xl md:text-4xl font-bold mb-2">Cardápio Digital</h1>
        @if(isset($tableNumber))
        <p class="text-xl">Mesa {{ $tableNumber }}</p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="relative">
            <input type="text" id="search-input" placeholder="Buscar pratos..." class="w-full px-4 py-3 pr-10 rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
            <div class="absolute right-3 top-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="mb-8 flex flex-wrap gap-2" id="filters">
        <button type="button" class="bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-amber-200 active" data-filter="all">
            Todos
        </button>
        <button type="button" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200" data-filter="vegetarian">
            Vegetarianos
        </button>
        <button type="button" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200" data-filter="vegan">
            Veganos
        </button>
        <button type="button" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200" data-filter="gluten-free">
            Sem Glúten
        </button>
    </div>
    
    @foreach(App\Models\Category::where('active', true)->orderBy('order')->get() as $category)
    <div class="mb-12">
        <h2 class="font-playfair text-2xl font-bold mb-4 pb-2 border-b border-gray-200">{{ $category->name }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($category->dishes()->where('available', true)->get() as $dish)
            <div class="dish-card bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg 
                 {{ $dish->is_vegetarian ? 'is-vegetarian' : '' }} 
                 {{ $dish->is_vegan ? 'is-vegan' : '' }} 
                 {{ $dish->is_gluten_free ? 'is-gluten-free' : '' }}">
                <div class="relative h-48 bg-gray-200">
                    @if($dish->image)
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    
                    <div class="absolute top-2 right-2 flex space-x-1">
                        @if($dish->is_vegetarian)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dish-tag" title="Vegetariano">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        @endif
                        
                        @if($dish->is_vegan)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dish-tag" title="Vegano">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </span>
                        @endif
                        
                        @if($dish->is_gluten_free)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dish-tag" title="Sem Glúten">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold dish-name">{{ $dish->name }}</h3>
                        <span class="font-bold text-amber-600">R$ {{ number_format($dish->price, 2, ',', '.') }}</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-2 dish-description">{{ $dish->description }}</p>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm text-gray-600 ml-1">{{ number_format($dish->ratings()->avg('rating') ?? 0, 1) }}</span>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('menu.dish', $dish) }}" class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 transition">
                                Detalhes
                            </a>
                            <button type="button" class="px-3 py-1 bg-amber-600 text-white text-sm font-medium rounded hover:bg-amber-700 transition add-to-cart-btn" 
                                    data-dish-id="{{ $dish->id }}" 
                                    data-dish-name="{{ $dish->name }}" 
                                    data-dish-price="{{ $dish->price }}">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('#filters button');
        const dishCards = document.querySelectorAll('.dish-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active', 'bg-amber-100', 'text-amber-800'));
                filterButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800'));
                
                this.classList.remove('bg-gray-100', 'text-gray-800');
                this.classList.add('active', 'bg-amber-100', 'text-amber-800');
                
                const filter = this.getAttribute('data-filter');
                
                if (filter === 'all') {
                    dishCards.forEach(card => card.style.display = 'block');
                } else {
                    dishCards.forEach(card => {
                        if (card.classList.contains(`is-${filter}`)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }
            });
        });
        
        const searchInput = document.getElementById('search-input');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm === '') {
                dishCards.forEach(card => card.style.display = 'block');
                return;
            }
            
            dishCards.forEach(card => {
                const dishName = card.querySelector('.dish-name').textContent.toLowerCase();
                const dishDescription = card.querySelector('.dish-description').textContent.toLowerCase();
                
                if (dishName.includes(searchTerm) || dishDescription.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // adicionar ao carrinho
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        const cartCount = document.getElementById('cart-count');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const dishId = this.getAttribute('data-dish-id');
                const dishName = this.getAttribute('data-dish-name');
                const dishPrice = parseFloat(this.getAttribute('data-dish-price'));
                
                // usa a função global de adição ao carrinho
                window.addToCart(dishId, dishName, dishPrice);
                
                // mostra uma notificação mais discreta
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow-lg';
                notification.style.zIndex = '9999';
                notification.textContent = `${dishName} adicionado ao pedido!`;
                document.body.appendChild(notification);
                
                // remove a notificação após 2 segundos
                setTimeout(() => {
                    notification.remove();
                }, 2000);
            });
        });
    });
</script>
@endpush 