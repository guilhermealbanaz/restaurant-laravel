<x-guest-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="py-4 px-6 bg-gradient-to-r from-amber-600 to-red-600 text-white">
                <h2 class="text-2xl font-bold">Login</h2>
                <p class="text-sm">Acesse sua conta</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="py-4 px-6">
                @csrf
                
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
                    <input id="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" type="password" name="password" required autocomplete="current-password" />
                    
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-600 shadow-sm focus:border-amber-300 focus:ring focus:ring-amber-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mb-4">
                    @if (Route::has('password.request'))
                        <a class="inline-block align-baseline text-sm text-amber-600 hover:text-amber-800" href="{{ route('password.request') }}">
                            Esqueceu sua senha?
                        </a>
                    @endif

                    <button type="submit" class="bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Entrar
                    </button>
                </div>
                
                @if (Route::has('register'))
                    <div class="text-center mt-6 border-t pt-4">
                        <p class="text-sm text-gray-600">
                            Não tem uma conta? 
                            <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-800 font-semibold">
                                Registre-se
                            </a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout> 