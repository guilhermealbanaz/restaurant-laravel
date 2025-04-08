@extends('layouts.admin')

@section('title', 'Criar Novo QR Code')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center my-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700">
                Criar Novo QR Code
            </h2>
            <p class="text-gray-600 mt-1">Adicione um novo QR Code para uma mesa do restaurante</p>
        </div>
        <div class="mt-4 md:mt-0">
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
            <form action="{{ route('admin.qrcodes.store') }}" method="POST">
                @csrf

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
                    <input type="text" name="table_number" id="table_number" value="{{ old('table_number') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <p class="mt-1 text-sm text-gray-500">Informe o número ou identificação da mesa (Ex: Mesa 1, Mesa VIP, etc.)</p>
                </div>

                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
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
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span>Criar QR Code</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded-r-lg shadow-md">
        <h3 class="font-semibold mb-2">Informações sobre QR Codes</h3>
        <ul class="list-disc list-inside text-sm space-y-1">
            <li>Após criar o QR Code, você poderá visualizá-lo e imprimi-lo para uso na mesa.</li>
            <li>Os clientes poderão escanear o QR Code para acessar o cardápio digital diretamente em seus smartphones.</li>
            <li>O sistema gera um código único para cada mesa, garantindo a segurança e o rastreamento dos pedidos.</li>
            <li>Você pode desativar um QR Code a qualquer momento, caso uma mesa esteja temporariamente indisponível.</li>
        </ul>
    </div>
</div>
@endsection 