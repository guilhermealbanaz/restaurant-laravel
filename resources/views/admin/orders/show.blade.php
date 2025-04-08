@extends('layouts.admin')

@section('title', 'Detalhes do Pedido #' . $order->id)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Pedido #{{ $order->id }}</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                Voltar para lista
            </a>
            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                    Excluir Pedido
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Informações do Pedido</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Data do Pedido</p>
                    <p class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Mesa</p>
                    <p class="font-medium">{{ $order->table_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Cliente</p>
                    <p class="font-medium">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="font-medium">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Status do Pedido</h2>
            <div class="mb-4">
                <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium 
                    @if($order->status === App\Models\Order::STATUS_PENDING) 
                        bg-yellow-100 text-yellow-800 
                    @elseif($order->status === App\Models\Order::STATUS_PREPARING) 
                        bg-blue-100 text-blue-800 
                    @elseif($order->status === App\Models\Order::STATUS_READY) 
                        bg-green-100 text-green-800 
                    @elseif($order->status === App\Models\Order::STATUS_DELIVERED) 
                        bg-gray-100 text-gray-800 
                    @else 
                        bg-red-100 text-red-800 
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Atualizar Status</label>
                <div class="flex items-center space-x-2">
                    <select id="status" name="status" class="border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 block w-full">
                        <option value="{{ App\Models\Order::STATUS_PENDING }}" {{ $order->status === App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>Pendente</option>
                        <option value="{{ App\Models\Order::STATUS_PREPARING }}" {{ $order->status === App\Models\Order::STATUS_PREPARING ? 'selected' : '' }}>Preparando</option>
                        <option value="{{ App\Models\Order::STATUS_READY }}" {{ $order->status === App\Models\Order::STATUS_READY ? 'selected' : '' }}>Pronto</option>
                        <option value="{{ App\Models\Order::STATUS_DELIVERED }}" {{ $order->status === App\Models\Order::STATUS_DELIVERED ? 'selected' : '' }}>Entregue</option>
                        <option value="{{ App\Models\Order::STATUS_CANCELED }}" {{ $order->status === App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded hover:bg-amber-700 transition-colors">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Observações</h2>
            <div class="bg-gray-50 p-4 rounded min-h-[100px]">
                {{ $order->notes ?? 'Nenhuma observação informada.' }}
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-bold">Itens do Pedido</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prato</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço Unitário</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($item->dish->image)
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $item->dish->image) }}" alt="{{ $item->dish->name }}">
                                </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->dish->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($item->dish->description, 50) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            R$ {{ number_format($item->unit_price, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            R$ {{ number_format($item->unit_price * $item->quantity, 2, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium">Total:</td>
                        <td class="px-6 py-4 font-bold">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold mb-4 border-b pb-2">Histórico do Pedido</h2>
        
        <div class="flow-root">
            <ul class="-mb-8">
                <li class="relative pb-8">
                    <div class="relative flex items-start space-x-3">
                        <div class="relative">
                            <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    Pedido criado
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                
                <!--tem q adicionar mais entrada pra historico, como quando o status muda, etc. -->
                
            </ul>
        </div>
    </div>
</div>
@endsection 