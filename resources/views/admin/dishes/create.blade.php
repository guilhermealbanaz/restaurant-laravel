@extends('layouts.admin')

@section('title', 'Adicionar Novo Prato')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Adicionar Novo Prato</h1>
            <p class="text-gray-600 mt-1">Preencha as informações do novo prato</p>
        </div>
        <a href="{{ route('admin.dishes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
            </svg>
            Voltar para lista
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
            <div class="font-bold mb-2">Ocorreram erros com os dados informados:</div>
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <!-- nome prato -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome do prato <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- categoria -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Preço -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Preço (R$) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- tempo de preparo -->
                    <div>
                        <label for="preparation_time" class="block text-sm font-medium text-gray-700 mb-1">Tempo de preparo (minutos)</label>
                        <input type="number" name="preparation_time" id="preparation_time" value="{{ old('preparation_time') }}" min="1" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- status e destaques -->
                    <div class="space-y-3 pt-3 border-t border-gray-200">
                        <div class="flex items-center">
                            <input type="hidden" name="available" value="0">
                            <input type="checkbox" name="available" id="available" value="1" {{ old('available', '1') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="available" class="ml-2 text-sm text-gray-700">Disponível para pedidos</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="featured" class="ml-2 text-sm text-gray-700">Destacar no cardápio</label>
                        </div>
                    </div>

                    <!-- dietas especiais -->
                    <div class="space-y-3 pt-3 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700">Dietas especiais</h3>
                        
                        <div class="flex items-center">
                            <input type="hidden" name="is_vegetarian" value="0">
                            <input type="checkbox" name="is_vegetarian" id="is_vegetarian" value="1" {{ old('is_vegetarian') ? 'checked' : '' }}
                                   class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="is_vegetarian" class="ml-2 text-sm text-gray-700">Vegetariano</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="hidden" name="is_vegan" value="0">
                            <input type="checkbox" name="is_vegan" id="is_vegan" value="1" {{ old('is_vegan') ? 'checked' : '' }}
                                   class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="is_vegan" class="ml-2 text-sm text-gray-700">Vegano</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="hidden" name="is_gluten_free" value="0">
                            <input type="checkbox" name="is_gluten_free" id="is_gluten_free" value="1" {{ old('is_gluten_free') ? 'checked' : '' }}
                                   class="h-4 w-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                            <label for="is_gluten_free" class="ml-2 text-sm text-gray-700">Sem Glúten</label>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- imagem -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagem do prato</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full border border-gray-300 rounded-md shadow-sm py-1.5 px-3 text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Arquivos PNG, JPG ou JPEG (máx. 2MB)</p>
                    </div>

                    <!-- descrição -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- ingredientes -->
                    <div>
                        <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-1">Ingredientes</label>
                        <textarea name="ingredients" id="ingredients" rows="3" 
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('ingredients') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Liste os principais ingredientes separados por vírgula</p>
                    </div>

                    <!-- alérgenos -->
                    <div>
                        <label for="allergens" class="block text-sm font-medium text-gray-700 mb-1">Alérgenos</label>
                        <textarea name="allergens" id="allergens" rows="2" 
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('allergens') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Informe os possíveis alérgenos presentes no prato</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-5 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200">
                    Adicionar Prato
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
