<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <!-- vai ficar assim por enquanto até conseguir fazer api funcionar -->
                    <img id="qrcode-image" src="#" alt="QR Code para Mesa {{ $qrCode->table_number }}" class="w-64 h-64" style="display: none;">
                    <div id="qrcode-loading" class="qrcode-placeholder">
                        <div class="text-center">
                            <svg aria-hidden="true" class="w-12 h-12 mx-auto mb-2 text-gray-300 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <p class="text-gray-500">Carregando QR Code...</p>
                        </div>
                    </div>
                    <div id="qrcode-error" class="qrcode-placeholder" style="display: none;">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-gray-500">Erro ao carregar QR Code</p>
                            <a href="{{ route('admin.qrcodes.show', $qrCode) }}" class="text-sm text-blue-600 block mt-2">Volte e tente novamente</a>
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

    <script>
        // carregar qr code via ajax com base64
        document.addEventListener('DOMContentLoaded', function() {
            const qrImage = document.getElementById('qrcode-image');
            const qrLoading = document.getElementById('qrcode-loading');
            const qrError = document.getElementById('qrcode-error');
            
            // função para carregar o qr code
            function loadQrCode() {
                // primeiro tenta o método base64 via ajax
                fetch('{{ route('admin.qrcodes.generate_base64', $qrCode) }}')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Resposta não foi OK');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // usar o base64 como src da imagem
                            qrImage.src = data.base64;
                            qrImage.style.display = 'block';
                            qrLoading.style.display = 'none';
                            qrError.style.display = 'none';
                            
                            // atualizar url se necessário
                            const menuUrl = document.getElementById('menu-url');
                            if (menuUrl && data.url) {
                                menuUrl.textContent = data.url;
                            }
                        } else {
                            throw new Error(data.message || 'Erro desconhecido');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao carregar QR code:', error);
                        
                        // Tenta o método tradicional como fallback
                        // qrImage.src = '{{ url(route('admin.qrcodes.generate', $qrCode, false)) }}';
                        // qrImage.onload = function() {
                        //     qrImage.style.display = 'block';
                        //     qrLoading.style.display = 'none';
                        //     qrError.style.display = 'none';
                        // };
                        // qrImage.onerror = function() {
                        //     qrImage.style.display = 'none';
                        //     qrLoading.style.display = 'none';
                        //     qrError.style.display = 'flex';
                        // };
                    });
            }
            
            // tenta carregar o qr code
            loadQrCode();
        });
    </script>
</body>
</html>
