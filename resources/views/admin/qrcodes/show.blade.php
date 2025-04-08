@extends('layouts.admin')

@section('title', 'Detalhes do QR Code')

@section('content')
<div class="container px-6 mx-auto">
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center my-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">
                QR Code para Mesa {{ $qrCode->table_number }}
            </h2>
            <p class="text-gray-600 mt-1">Detalhes e ações para este QR Code</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.qrcodes.edit', $qrCode) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    <span>Editar</span>
                </div>
            </a>
            <a href="{{ route('admin.qrcodes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
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
        <!-- Coluna da Esquerda - Detalhes do QR Code -->
        <div class="col-span-1 lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informações do QR Code</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">ID</span>
                            <span class="text-gray-800">{{ $qrCode->id }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Status</span>
                            <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $qrCode->active ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                {{ $qrCode->active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Número da Mesa</span>
                            <span class="text-gray-800">{{ $qrCode->table_number }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Código</span>
                            <span class="text-gray-800">{{ $qrCode->code }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Data de Criação</span>
                            <span class="text-gray-800">{{ $qrCode->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="block text-sm font-semibold text-gray-600">Última Atualização</span>
                            <span class="text-gray-800">{{ $qrCode->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.qrcodes.edit', $qrCode) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <span>Editar</span>
                            </div>
                        </a>
                        <form action="{{ route('admin.qrcodes.destroy', $qrCode) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este QR Code?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Excluir</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna da Direita - QR Code -->
        <div class="col-span-1 lg:col-span-3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">QR Code para Mesa {{ $qrCode->table_number }}</h3>
                    
                    <div class="flex flex-col items-center">
                        <div class="p-4 bg-white rounded-lg shadow-md mb-4">
                            <img src="{{ route('admin.qrcodes.generate', $qrCode) }}" alt="QR Code para Mesa {{ $qrCode->table_number }}" class="w-64 h-64 mx-auto">
                        </div>

                        <div class="text-center mb-6">
                            <p class="text-gray-500 mb-2">Este QR Code direciona para:</p>
                            <p class="text-blue-600 underline">{{ route('menu.table', ['code' => $qrCode->code]) }}</p>
                        </div>

                        <div class="flex space-x-4">
                            <a href="{{ route('admin.qrcodes.print', $qrCode) }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" target="_blank">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Imprimir QR Code</span>
                                </div>
                            </a>
                            <a href="{{ route('admin.qrcodes.generate', $qrCode) }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2" download="qrcode-mesa-{{ $qrCode->table_number }}.png" target="_blank">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Baixar Imagem</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50">
                    <h4 class="font-semibold text-gray-700 mb-3">Instruções de Uso</h4>
                    <ul class="list-disc list-inside text-sm space-y-2 text-gray-600">
                        <li>Imprima este QR Code e coloque-o na mesa {{ $qrCode->table_number }}.</li>
                        <li>Os clientes podem escanear o código com a câmera de seus smartphones para acessar o cardápio digital.</li>
                        <li>Lembre-se de desativar o QR Code se a mesa não estiver disponível para uso.</li>
                        <li>Para melhor durabilidade, plastifique o QR Code impresso.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 