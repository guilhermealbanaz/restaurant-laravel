@extends('layouts.admin')

@section('title', 'Gerenciar Pratos')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gerenciar Pratos</h1>
        <a href="{{ route('admin.dishes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Novo Prato
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Total de Pratos</p>
                    <p class="text-xl font-semibold">{{ App\Models\Dish::count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-100 text-amber-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Em Destaque</p>
                    <p class="text-xl font-semibold">{{ App\Models\Dish::where('featured', 1)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Disponíveis</p>
                    <p class="text-xl font-semibold">{{ App\Models\Dish::where('available', 1)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Categorias</p>
                    <p class="text-xl font-semibold">{{ App\Models\Category::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6 bg-white rounded-lg shadow p-4">
        <form action="{{ route('admin.dishes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-3">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <select id="category_id" name="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label for="available" class="block text-sm font-medium text-gray-700 mb-1">Disponibilidade</label>
                <select id="available" name="available" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('available') === '1' ? 'selected' : '' }}>Disponível</option>
                    <option value="0" {{ request('available') === '0' ? 'selected' : '' }}>Indisponível</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label for="featured" class="block text-sm font-medium text-gray-700 mb-1">Destaque</label>
                <select id="featured" name="featured" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Em destaque</option>
                    <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Sem destaque</option>
                </select>
            </div>
            
            <div class="md:col-span-3">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Nome, ingredientes..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="md:col-span-2 flex items-end">
                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                    Filtrar
                </button>
            </div>

            <div class="md:col-span-12 flex flex-wrap gap-4 pt-3 border-t border-gray-200">
                <div class="flex items-center">
                    <input type="checkbox" id="is_vegetarian" name="is_vegetarian" value="1" {{ request('is_vegetarian') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="is_vegetarian" class="ml-2 text-sm text-gray-700">Vegetariano</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="is_vegan" name="is_vegan" value="1" {{ request('is_vegan') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="is_vegan" class="ml-2 text-sm text-gray-700">Vegano</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="is_gluten_free" name="is_gluten_free" value="1" {{ request('is_gluten_free') == '1' ? 'checked' : '' }} class="h-4 w-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                    <label for="is_gluten_free" class="ml-2 text-sm text-gray-700">Sem Glúten</label>
                </div>
                
                <div class="flex-grow"></div>
                
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm text-gray-700">Ordenar por:</label>
                    <select id="sort" name="sort" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nome</option>
                        <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>Preço</option>
                        <option value="preparation_time" {{ request('sort') === 'preparation_time' ? 'selected' : '' }}>Tempo de Preparo</option>
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Data de Criação</option>
                    </select>
                </div>
                
                <div class="flex items-center">
                    <select id="direction" name="direction" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="asc" {{ request('direction') === 'asc' ? 'selected' : '' }}>Crescente</option>
                        <option value="desc" {{ request('direction') === 'desc' ? 'selected' : '' }}>Decrescente</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($dishes as $dish)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg">
                <div class="relative h-48 bg-gray-200">
                    @if($dish->image)
                        <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-200 text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-2 right-2 flex space-x-1">
                        @if($dish->featured)
                            <span class="bg-amber-500 text-white text-xs px-2 py-1 rounded">Destaque</span>
                        @endif
                        
                        @if(!$dish->available)
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Indisponível</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $dish->name }}</h3>
                        <span class="font-bold text-blue-600">R$ {{ number_format($dish->price, 2, ',', '.') }}</span>
                    </div>
                    
                    <div class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $dish->description }}</div>
                    
                    <div class="text-xs text-gray-500 mb-3">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $dish->category->name }}
                        </span>
                        
                        @if($dish->preparation_time)
                            <span class="inline-flex items-center ml-3">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $dish->preparation_time }} min
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap gap-1 mb-4">
                        @if($dish->is_vegetarian)
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Vegetariano</span>
                        @endif
                        
                        @if($dish->is_vegan)
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Vegano</span>
                        @endif
                        
                        @if($dish->is_gluten_free)
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full">Sem Glúten</span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar
                        </a>
                        
                        <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este prato?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum prato encontrado</h3>
                    <p class="mt-1 text-gray-500">Comece adicionando pratos ao seu cardápio.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.dishes.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Adicionar Prato
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $dishes->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // listener p ordenação
        const sortLinks = document.querySelectorAll('.sort-link');
        sortLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const sort = this.dataset.sort;
                const currentDirection = urlParams.get('direction') || 'asc';
                const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
                
                urlParams.set('sort', sort);
                urlParams.set('direction', newDirection);
                
                window.location.search = urlParams.toString();
            });
        });
    });
</script>
@endpush
@endsection 