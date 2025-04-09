<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code - Mesa {{ $qrCode->table_number }}</title>
    
    @vite(['resources/css/app.css'])
    
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .print-container {
                page-break-inside: avoid;
            }
            
            .no-print {
                display: none !important;
            }
        }
        
        .qrcode-placeholder {
            width: 256px;
            height: 256px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="no-print flex justify-between mb-8">
            <a href="{{ route('admin.qrcodes.show', $qrCode) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <span>Voltar</span>
                </div>
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Imprimir</span>
                </div>
            </button>
        </div>

        <!-- oq será imprimido -->
        <div class="print-container mx-auto max-w-md bg-white p-8 rounded-lg shadow-md">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Cardápio Digital</h1>
                <p class="text-gray-600 text-lg mt-2">Mesa {{ $qrCode->table_number }}</p>
            </div>
            
            <div class="flex justify-center mb-8">
                <div class="p-4 bg-white border-2 border-gray-300 rounded-lg">
                    <img 
                        src="{{ route('admin.qrcodes.generate', $qrCode) }}" 
                        alt="QR Code para Mesa {{ $qrCode->table_number }}" 
                        class="w-64 h-64" 
                        onerror="this.style.display='none';document.getElementById('qrcode-error').style.display='flex';"
                    >
                    
                    <div id="qrcode-error" class="qrcode-placeholder" style="display: none;">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-500 font-medium">Erro ao carregar QR Code</p>
                            <p class="text-gray-500 mt-1 mb-2 text-sm">Por favor, use o link abaixo:</p>
                            <div class="border-2 border-dashed border-gray-300 rounded p-4 text-center mt-2">
                                <p class="font-bold">Mesa {{ $qrCode->table_number }}</p>
                                <p class="text-sm text-gray-600 mt-2 mb-1">Acesse via:</p>
                                <p class="text-blue-600 text-sm break-all font-medium">{{ route('menu.table', ['code' => $qrCode->code]) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center space-y-2">
                <p class="text-lg font-medium text-gray-700">Escaneie o código QR acima</p>
                <p class="text-gray-600">para acessar o cardápio digital</p>
                <p class="text-gray-600 text-sm mt-4">Ou acesse:</p>
                <p id="menu-url" class="text-blue-600 text-sm break-all">{{ route('menu.table', ['code' => $qrCode->code]) }}</p>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Cardápio Digital - Todos os direitos reservados</p>
            </div>
        </div>
    </div>
</body>
</html>
