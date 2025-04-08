@extends('layouts.admin')

@section('title', 'Gerenciar Pedidos')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Gerenciar Pedidos</h1>
        <a href="{{ route('admin.orders.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Novo Pedido
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

    <div class="mb-6 bg-white rounded-lg shadow p-4">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Todos</option>
                    <option value="{{ App\Models\Order::STATUS_PENDING }}">Pendente</option>
                    <option value="{{ App\Models\Order::STATUS_PREPARING }}">Preparando</option>
                    <option value="{{ App\Models\Order::STATUS_READY }}">Pronto</option>
                    <option value="{{ App\Models\Order::STATUS_DELIVERED }}">Entregue</option>
                    <option value="{{ App\Models\Order::STATUS_CANCELED }}">Cancelado</option>
                </select>
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Data</label>
                <input type="date" id="date" name="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                <input type="text" id="search" name="search" placeholder="Mesa ou cliente..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Pendentes</p>
                    <p class="text-xl font-semibold">{{ App\Models\Order::where('status', App\Models\Order::STATUS_PENDING)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Preparando</p>
                    <p class="text-xl font-semibold">{{ App\Models\Order::where('status', App\Models\Order::STATUS_PREPARING)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Prontos</p>
                    <p class="text-xl font-semibold">{{ App\Models\Order::where('status', App\Models\Order::STATUS_READY)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gray-100 text-gray-800 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Entregues hoje</p>
                    <p class="text-xl font-semibold">{{ App\Models\Order::where('status', App\Models\Order::STATUS_DELIVERED)->whereDate('updated_at', today())->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="hidden md:flex border-b border-gray-200 bg-gray-50 text-gray-700 font-medium text-sm">
            <div class="w-16 py-3 px-4">ID</div>
            <div class="w-24 py-3 px-4">Mesa</div>
            <div class="w-1/5 py-3 px-4">Cliente</div>
            <div class="w-24 py-3 px-4">Total</div>
            <div class="w-32 py-3 px-4">Status</div>
            <div class="w-24 py-3 px-4">Data</div>
            <div class="flex-1 py-3 px-4 text-right">Ações</div>
        </div>

        @forelse($orders as $order)
            <div class="hidden md:flex items-center border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150">
                <div class="w-16 py-4 px-4 font-medium text-amber-600">#{{ $order->id }}</div>
                <div class="w-24 py-4 px-4">{{ $order->table_number }}</div>
                <div class="w-1/5 py-4 px-4">
                    {{ $order->customer_name ?: 'Visitante' }}
                    @if($order->user)
                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                    @endif
                </div>
                <div class="w-24 py-4 px-4 font-semibold">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</div>
                <div class="w-32 py-4 px-4">
                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium 
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
                <div class="w-24 py-4 px-4 text-gray-500 text-sm">{{ $order->created_at->format('d/m/Y') }}</div>
                <div class="flex-1 py-4 px-4 text-right space-x-2">
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <div class="relative inline-block w-32">
                            <select name="status" onchange="this.form.submit()" class="appearance-none w-full bg-white border rounded-md py-1.5 pl-3 pr-8 text-sm text-gray-700 focus:outline-none focus:ring-amber-500 focus:border-amber-500">
                                <option value="{{ App\Models\Order::STATUS_PENDING }}" {{ $order->status === App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>Pendente</option>
                                <option value="{{ App\Models\Order::STATUS_PREPARING }}" {{ $order->status === App\Models\Order::STATUS_PREPARING ? 'selected' : '' }}>Preparando</option>
                                <option value="{{ App\Models\Order::STATUS_READY }}" {{ $order->status === App\Models\Order::STATUS_READY ? 'selected' : '' }}>Pronto</option>
                                <option value="{{ App\Models\Order::STATUS_DELIVERED }}" {{ $order->status === App\Models\Order::STATUS_DELIVERED ? 'selected' : '' }}>Entregue</option>
                                <option value="{{ App\Models\Order::STATUS_CANCELED }}" {{ $order->status === App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route('admin.orders.show', $order) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-sm inline-flex items-center transition-colors">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Ver
                    </a>
                    
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-sm inline-flex items-center transition-colors">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Excluir
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:hidden border-b border-gray-200 py-4 px-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <span class="inline-block font-medium text-amber-600">#{{ $order->id }}</span>
                        <span class="inline-block ml-2 text-gray-500 text-sm">{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium 
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
                <div class="mb-2">
                    <div class="font-medium">{{ $order->table_number }}</div>
                    <div class="text-gray-700">{{ $order->customer_name ?: 'Visitante' }}</div>
                </div>
                <div class="mb-3 font-semibold text-lg">
                    R$ {{ number_format($order->total_amount, 2, ',', '.') }}
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.orders.show', $order) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded text-sm inline-flex items-center transition-colors flex-grow justify-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Detalhes
                    </a>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex-grow">
                        @csrf
                        @method('PATCH')
                        <div class="relative w-full">
                            <select name="status" onchange="this.form.submit()" class="appearance-none w-full bg-white border rounded-md py-1.5 pl-3 pr-8 text-sm text-gray-700 focus:outline-none focus:ring-amber-500 focus:border-amber-500">
                                <option value="{{ App\Models\Order::STATUS_PENDING }}" {{ $order->status === App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>Pendente</option>
                                <option value="{{ App\Models\Order::STATUS_PREPARING }}" {{ $order->status === App\Models\Order::STATUS_PREPARING ? 'selected' : '' }}>Preparando</option>
                                <option value="{{ App\Models\Order::STATUS_READY }}" {{ $order->status === App\Models\Order::STATUS_READY ? 'selected' : '' }}>Pronto</option>
                                <option value="{{ App\Models\Order::STATUS_DELIVERED }}" {{ $order->status === App\Models\Order::STATUS_DELIVERED ? 'selected' : '' }}>Entregue</option>
                                <option value="{{ App\Models\Order::STATUS_CANCELED }}" {{ $order->status === App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                    
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline-flex" onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-3 rounded text-sm inline-flex items-center transition-colors justify-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum pedido encontrado</h3>
                <p class="mt-1 text-gray-500">Comece criando um novo pedido para seus clientes.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.orders.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Novo Pedido
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const date = urlParams.get('date');
        const search = urlParams.get('search');
        
        if (status) {
            document.getElementById('status').value = status;
        }
        
        if (date) {
            document.getElementById('date').value = date;
        }
        
        if (search) {
            document.getElementById('search').value = search;
        }
    });
</script>
@endpush
@endsection 