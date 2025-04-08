<x-guest-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="py-4 px-6 bg-gradient-to-r from-amber-600 to-red-600 text-white">
                <h2 class="text-2xl font-bold">Confirmar Senha</h2>
                <p class="text-sm">Por favor, confirme sua senha antes de continuar</p>
            </div>
            
            <div class="py-4 px-6">
                <div class="mb-4 text-sm text-gray-600">
                    Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
                        <input id="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" type="password" name="password" required autocomplete="current-password" />
                        
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Confirmar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>