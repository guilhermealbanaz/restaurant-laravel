@extends('layouts.admin')

@section('title', 'Detalhes da Categoria')

@section('content')
<div class="container px-6 mx-auto">
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center my-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">
                {{ $category->name }}
            </h2>
            <p class="text-gray-600 mt-1">Detalhes da categoria e pratos associados</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    <span>Editar</span>
                </div>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <span>Voltar</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <!-- Coluna da Esquerda - Detalhes da Categoria -->
        <div class="col-span-1 lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informações da Categoria</h3>
                    
                    <div class="mb-6">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover rounded-lg">
                        @else
                            <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Status</span>
                            <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $category->active ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                {{ $category->active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Ordem de Exibição</span>
                            <span class="text-gray-800">{{ $category->order }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Quantidade de Pratos</span>
                            <span class="text-gray-800">{{ $category->dishes->count() }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Data de Criação</span>
                            <span class="text-gray-800">{{ $category->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <div class="mb-4 col-span-2">
                            <span class="block text-sm font-semibold text-gray-600">Última Atualização</span>
                            <span class="text-gray-800">{{ $category->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Descrição</h3>
                    <div class="text-gray-600 p-4 bg-gray-50 rounded-lg">
                        {{ $category->description ?? 'Nenhuma descrição fornecida.' }}
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t">
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>Excluir Categoria</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coluna da Direit - Pratos da Categoria -->
        <div class="col-span-1 lg:col-span-3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-700">Pratos nesta Categoria</h3>
                        <a href="{{ route('admin.dishes.create', ['category_id' => $category->id]) }}" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span>Adicionar Prato</span>
                            </div>
                        </a>
                    </div>
                </div>

                @if($category->dishes->count() > 0)
                    <div class="divide-y">
                        @foreach($category->dishes as $dish)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="flex items-center">
                                        @if($dish->image)
                                            <img src="{{ Storage::url($dish->image) }}" alt="{{ $dish->name }}" class="h-16 w-16 rounded-lg object-cover mr-4">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-gray-700">{{ $dish->name }}</div>
                                            <div class="text-sm text-gray-500">
                                                R$ {{ number_format($dish->price, 2, ',', '.') }}
                                                @if($dish->preparation_time)
                                                    <span class="ml-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $dish->preparation_time }} min
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 md:mt-0 flex flex-wrap items-center gap-2">
                                        <div class="flex space-x-1">
                                            @if($dish->is_vegetarian)
                                                <span class="px-2 py-1 text-xs rounded-full text-green-700 bg-green-100" title="Vegetariano">Veg</span>
                                            @endif
                                            @if($dish->is_vegan)
                                                <span class="px-2 py-1 text-xs rounded-full text-green-700 bg-green-100" title="Vegano">Vgn</span>
                                            @endif
                                            @if($dish->is_gluten_free)
                                                <span class="px-2 py-1 text-xs rounded-full text-yellow-700 bg-yellow-100" title="Sem Glúten">S/G</span>
                                            @endif
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $dish->available ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                            {{ $dish->available ? 'Disponível' : 'Indisponível' }}
                                        </span>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.dishes.show', $dish) }}" class="text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.dishes.edit', $dish) }}" class="text-yellow-500 hover:text-yellow-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <p class="text-lg">Nenhum prato cadastrado nesta categoria</p>
                        <p class="mt-2 mb-6">Adicione pratos para exibi-los aqui.</p>
                        <a href="{{ route('admin.dishes.create', ['category_id' => $category->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span>Adicionar Prato</span>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 
