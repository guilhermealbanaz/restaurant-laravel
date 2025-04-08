<x-guest-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="py-4 px-6 bg-gradient-to-r from-amber-600 to-red-600 text-white">
                <h2 class="text-2xl font-bold">Esqueceu sua senha?</h2>
                <p class="text-sm">Informe seu email para receber um link de redefinição</p>
            </div>
            
            <div class="py-4 px-6">
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus />
                        
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <a href="{{ route('login') }}" class="inline-block align-baseline text-sm text-amber-600 hover:text-amber-800">
                            Voltar para o login
                        </a>
                        
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Enviar link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>