<x-guest-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="py-4 px-6 bg-gradient-to-r from-amber-600 to-red-600 text-white">
                <h2 class="text-2xl font-bold">Verificar Email</h2>
                <p class="text-sm">Verifique seu endereço de email para acessar</p>
            </div>
            
            <div class="py-4 px-6">
                <div class="mb-4 text-sm text-gray-600">
                    Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de email clicando no link que acabamos de enviar para você? Se você não recebeu o email, teremos prazer em enviar outro.
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-sm font-medium text-green-600">
                        Um novo link de verificação foi enviado para o endereço de email fornecido durante o registro.
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit" class="bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Reenviar Email de Verificação
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>