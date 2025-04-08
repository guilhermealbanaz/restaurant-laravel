@extends('layouts.admin')

@section('title', 'Criar Novo Pedido')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Criar Novo Pedido</h1>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
            Voltar para lista
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm" class="bg-white rounded-lg shadow overflow-hidden">
        @csrf
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold mb-4">Informações do Pedido</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="table_number" class="block text-sm font-medium text-gray-700 mb-1">Mesa *</label>
                    <input type="text" name="table_number" id="table_number" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500"
                        value="{{ old('table_number') }}">
                    @error('table_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nome do Cliente</label>
                    <input type="text" name="customer_name" id="customer_name"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500"
                        value="{{ old('customer_name') }}">
                    @error('customer_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Itens do Pedido</h2>
                <button type="button" id="addItemBtn" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                    Adicionar Item
                </button>
            </div>

            <div id="itemsContainer">
                <div class="bg-gray-50 p-4 mb-4 rounded">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-medium">Item #1</h3>
                        <button type="button" class="text-red-500 hover:text-red-700 removeItem" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label for="items[0][dish_id]" class="block text-sm font-medium text-gray-700 mb-1">Prato *</label>
                            <select name="items[0][dish_id]" required class="dishSelect w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                <option value="">Selecione um prato</option>
                                @foreach($dishes as $dish)
                                    <option value="{{ $dish->id }}" data-price="{{ $dish->price }}">
                                        {{ $dish->name }} - R$ {{ number_format($dish->price, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="items[0][quantity]" class="block text-sm font-medium text-gray-700 mb-1">Quantidade *</label>
                            <input type="number" name="items[0][quantity]" min="1" value="1" required
                                class="quantityInput w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>
                    
                    <div>
                        <label for="items[0][notes]" class="block text-sm font-medium text-gray-700 mb-1">Observações do item</label>
                        <input type="text" name="items[0][notes]" placeholder="Ex: Sem cebola, sem alface, etc."
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>
            </div>

            <div class="text-right mt-4 text-xl font-bold">
                Total: R$ <span id="orderTotal">0,00</span>
            </div>
        </div>

        <div class="p-6 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition-colors">
                Criar Pedido
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemCounter = 1;
        const dishPrices = new Map();
        
        @foreach($dishes as $dish)
            dishPrices.set({{ $dish->id }}, {{ $dish->price }});
        @endforeach
        
        document.getElementById('addItemBtn').addEventListener('click', function() {
            const itemsContainer = document.getElementById('itemsContainer');
            const newItem = document.createElement('div');
            newItem.className = 'bg-gray-50 p-4 mb-4 rounded';
            newItem.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-medium">Item #${itemCounter + 1}</h3>
                    <button type="button" class="text-red-500 hover:text-red-700 removeItem">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                    <div>
                        <label for="items[${itemCounter}][dish_id]" class="block text-sm font-medium text-gray-700 mb-1">Prato *</label>
                        <select name="items[${itemCounter}][dish_id]" required class="dishSelect w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Selecione um prato</option>
                            @foreach($dishes as $dish)
                                <option value="{{ $dish->id }}" data-price="{{ $dish->price }}">
                                    {{ $dish->name }} - R$ {{ number_format($dish->price, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="items[${itemCounter}][quantity]" class="block text-sm font-medium text-gray-700 mb-1">Quantidade *</label>
                        <input type="number" name="items[${itemCounter}][quantity]" min="1" value="1" required
                            class="quantityInput w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>
                
                <div>
                    <label for="items[${itemCounter}][notes]" class="block text-sm font-medium text-gray-700 mb-1">Observações do item</label>
                    <input type="text" name="items[${itemCounter}][notes]" placeholder="Ex: Sem cebola, sem alface, etc."
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                </div>
            `;
            
            itemsContainer.appendChild(newItem);
            itemCounter++;
            
            // listener pra o botão de remover
            const removeButtons = document.querySelectorAll('.removeItem');
            removeButtons.forEach(button => {
                button.addEventListener('click', removeItem);
            });
            
            // listeners p calcular o total
            addPriceCalculationListeners();
        });
        
        // função para remover um item
        function removeItem() {
            this.closest('.bg-gray-50').remove();
            updateTotal();
        }
        
        // adiciona os listeners iniciais pros elementos existentes
        const initialRemoveButtons = document.querySelectorAll('.removeItem');
        initialRemoveButtons.forEach(button => {
            button.addEventListener('click', removeItem);
        });
        
        // adiciona listeners p calcular o preço total
        function addPriceCalculationListeners() {
            const dishSelects = document.querySelectorAll('.dishSelect');
            const quantityInputs = document.querySelectorAll('.quantityInput');
            
            dishSelects.forEach(select => {
                select.addEventListener('change', updateTotal);
            });
            
            quantityInputs.forEach(input => {
                input.addEventListener('change', updateTotal);
                input.addEventListener('keyup', updateTotal);
            });
        }
        
        // calcula e atualiza o total do pedido
        function updateTotal() {
            let total = 0;
            const items = document.querySelectorAll('.bg-gray-50');
            
            items.forEach(item => {
                const dishSelect = item.querySelector('.dishSelect');
                const quantityInput = item.querySelector('.quantityInput');
                
                if (dishSelect.value && quantityInput.value) {
                    const dishId = parseInt(dishSelect.value);
                    const quantity = parseInt(quantityInput.value);
                    const price = dishPrices.get(dishId);
                    
                    if (price && quantity) {
                        total += price * quantity;
                    }
                }
            });
            
            // formata o total como R$
            document.getElementById('orderTotal').textContent = total.toFixed(2).replace('.', ',');
        }
        
        // inicia a escuta de eventos p cálculo de preço
        addPriceCalculationListeners();
    });
</script>
@endpush
@endsection 