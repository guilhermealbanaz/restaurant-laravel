@extends('layouts.admin')

@section('title', $dish->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $dish->name }}</h1>
            <p class="text-gray-600 mt-1">Detalhes do prato</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.dishes.edit', $dish) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
            </a>
            <a href="{{ route('admin.dishes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                </svg>
                Voltar para lista
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative h-64 md:h-80 bg-gray-200">
            @if($dish->image)
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full bg-gray-200 text-gray-400">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
            
            <div class="absolute top-4 right-4 flex space-x-2">
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $dish->available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $dish->available ? 'Disponível' : 'Indisponível' }}
                </span>
                
                @if($dish->featured)
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-800">
                        Destaque
                    </span>
                @endif
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informações</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Preço</p>
                            <p class="text-lg font-bold text-blue-600">R$ {{ number_format($dish->price, 2, ',', '.') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500">Categoria</p>
                            <p class="text-gray-700">{{ $dish->category->name }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tempo de Preparo</p>
                            <p class="text-gray-700">{{ $dish->preparation_time ? $dish->preparation_time . ' minutos' : 'Não informado' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500">Dietas Especiais</p>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @if($dish->is_vegetarian)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Vegetariano</span>
                                @endif
                                
                                @if($dish->is_vegan)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Vegano</span>
                                @endif
                                
                                @if($dish->is_gluten_free)
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full">Sem Glúten</span>
                                @endif
                                
                                @if(!$dish->is_vegetarian && !$dish->is_vegan && !$dish->is_gluten_free)
                                    <span class="text-gray-500 text-sm">Nenhuma dieta especial</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Estatísticas</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm font-medium text-gray-500">Avaliação média</p>
                                <p class="text-xl font-bold text-blue-600 flex items-center">
                                    {{ number_format($dish->ratings->avg('rating') ?? 0, 1) }}
                                    <svg class="w-5 h-5 text-yellow-500 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">De {{ $dish->ratings->count() }} avaliações</p>
                            </div>
                            
                            <div class="bg-amber-50 p-3 rounded-lg">
                                <p class="text-sm font-medium text-gray-500">Pedidos</p>
                                <p class="text-xl font-bold text-amber-600">{{ $dish->orderItems->count() }}</p>
                                <p class="text-xs text-gray-500 mt-1">Itens vendidos</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Descrição</h2>
                        <p class="text-gray-700">
                            {{ $dish->description ?: 'Nenhuma descrição informada.' }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Ingredientes</h2>
                        <p class="text-gray-700">
                            {{ $dish->ingredients ?: 'Nenhum ingrediente informado.' }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Alérgenos</h2>
                        <p class="text-gray-700">
                            {{ $dish->allergens ?: 'Nenhum alérgeno informado.' }}
                        </p>
                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informações Adicionais</h3>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>Criado em: {{ $dish->created_at->format('d/m/Y H:i') }}</p>
                            <p>Última atualização: {{ $dish->updated_at->format('d/m/Y H:i') }}</p>
                            <p>ID: {{ $dish->id }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 pt-5 border-t border-gray-200 flex justify-between">
                <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este prato?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Excluir Prato
                    </button>
                </form>
                
                <a href="{{ route('admin.dishes.edit', $dish) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar Prato
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 