@extends('layouts.menu')

@section('title', 'Cardápio Digital')

@section('content')
<div class="bg-gradient-to-r from-amber-500 to-red-500 text-white">
    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="text-center">
            <h1 class="font-playfair text-4xl md:text-6xl font-bold mb-6">Bem-vindo ao Cardápio Digital</h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto">Escaneie o QR code da sua mesa para fazer seu pedido ou explore nosso cardápio.</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <h2 class="font-playfair text-3xl font-bold text-center mb-8">Destaques do Cardápio</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(App\Models\Dish::where('featured', true)->where('available', true)->take(6)->get() as $dish)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
            <div class="relative h-48 md:h-56 bg-gray-200">
                @if($dish->image)
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
                
                <div class="absolute top-2 right-2">
                    @if($dish->is_vegetarian)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Vegetariano
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-bold">{{ $dish->name }}</h3>
                    <span class="font-bold text-amber-600">R$ {{ number_format($dish->price, 2, ',', '.') }}</span>
                </div>
                
                <p class="text-gray-600 mb-4 line-clamp-2">{{ $dish->description }}</p>
                
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-sm text-gray-600 ml-1">{{ number_format($dish->ratings()->avg('rating') ?? 0, 1) }}</span>
                    </div>
                    
                    <a href="{{ route('menu.dish', $dish) }}" class="px-4 py-2 bg-amber-600 text-white text-sm font-bold rounded hover:bg-amber-700 transition">
                        Ver Detalhes
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-12 text-center">
        <a href="{{ route('menu.index') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-amber-600 to-red-600 text-white font-bold rounded-lg shadow hover:from-amber-700 hover:to-red-700 transition">
            Ver Cardápio Completo
        </a>
    </div>
</div>

<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h2 class="font-playfair text-3xl font-bold text-center mb-8">Como Funciona</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-600 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Escaneie o QR Code</h3>
                <p class="text-gray-600">Encontre o QR code na sua mesa e escaneie com seu smartphone para acessar o cardápio digital.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-600 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Faça seu Pedido</h3>
                <p class="text-gray-600">Escolha os pratos, bebidas e acompanhamentos desejados e adicione-os ao seu carrinho.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-600 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Aprecie sua Refeição</h3>
                <p class="text-gray-600">Finalize seu pedido e aguarde enquanto preparamos sua refeição com todo o cuidado.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <h2 class="font-playfair text-3xl font-bold text-center mb-8">Categorias</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach(App\Models\Category::where('active', true)->orderBy('order')->get() as $category)
        <a href="{{ route('menu.index') }}?categoria={{ $category->id }}" class="block group">
            <div class="relative h-40 rounded-lg overflow-hidden shadow-md">
                @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <h3 class="text-white text-lg font-bold">{{ $category->name }}</h3>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection 