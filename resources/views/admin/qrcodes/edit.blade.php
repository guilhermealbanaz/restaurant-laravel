@extends('layouts.admin')

@section('title', 'Editar QR Code')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center my-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">
                Editar QR Code
            </h2>
            <p class="text-gray-600 mt-1">Atualize as informações do QR Code para a mesa {{ $qrCode->table_number }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('admin.qrcodes.show', $qrCode) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Ver Detalhes</span>
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

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <form action="{{ route('admin.qrcodes.update', $qrCode) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                        <p class="font-semibold">Por favor, corrija os seguintes erros:</p>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <label for="table_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Número da Mesa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="table_number" id="table_number" value="{{ old('table_number', $qrCode->table_number) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <p class="mt-1 text-sm text-gray-500">Informe o número ou identificação da mesa (Ex: Mesa 1, Mesa VIP, etc.)</p>
                </div>

                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="active" value="1" {{ old('active', $qrCode->active) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="active" class="ml-2 block text-sm font-medium text-gray-700">
                            QR Code Ativo
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 ml-6">Um QR Code inativo não poderá ser utilizado pelos clientes</p>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.qrcodes.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Cancelar
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            <span>Atualizar QR Code</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Excluir QR Code</h3>
            <p class="mt-1 text-sm text-gray-500">
                Atenção: Esta ação não pode ser desfeita. Todos os dados associados a este QR Code serão removidos permanentemente.
            </p>
        </div>
        <div class="p-6 bg-gray-50">
            <form action="{{ route('admin.qrcodes.destroy', $qrCode) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este QR Code? Esta ação não pode ser desfeita.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Excluir QR Code</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 