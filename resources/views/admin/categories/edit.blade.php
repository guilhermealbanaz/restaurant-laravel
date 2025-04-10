@extends('layouts.admin')

@section('title', 'Editar Categoria')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center my-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">
                Editar Categoria: {{ $category->name }}
            </h2>
            <p class="text-gray-600 mt-1">Modifique as informações da categoria</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.categories.show', $category) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Ver Detalhes</span>
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

    <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
        @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
            <p class="font-bold">Ocorreram erros ao atualizar a categoria:</p>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome da Categoria <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $category->name) }}" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="Ex: Entradas, Pratos Principais, Sobremesas">
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Ordem de Exibição</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $category->order) }}" min="0"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                    @error('order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Categorias com valores menores serão exibidas primeiro</p>
                </div>

                <div class="col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagem</label>
                    @if($category->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="h-32 w-auto rounded-lg object-cover">
                        <p class="text-gray-500 text-xs mt-1">Imagem atual: {{ basename($category->image) }}</p>
                    </div>
                    @endif
                    <div class="flex items-center">
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                    </div>
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Tamanho máximo: 2MB. Formatos recomendados: JPG, PNG. Deixe em branco para manter a imagem atual.</p>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="Descreva brevemente esta categoria de pratos">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <div class="flex items-center">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" id="active" name="active" value="1" {{ $category->active ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="active" class="ml-2 block text-sm text-gray-700">
                            Categoria ativa (visível para os clientes)
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    Atualizar Categoria
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Zona de Perigo</h3>
        <p class="text-gray-600 mb-4">
            Essa ação não pode ser desfeita. Todos os pratos associados a esta categoria ficarão sem categoria.
        </p>
        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Esta ação não pode ser desfeita.');">
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
@endsection 