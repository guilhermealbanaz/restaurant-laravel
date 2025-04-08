<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cardápio Digital') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-r from-amber-600 to-red-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('menu.index') }}" class="font-playfair text-2xl md:text-3xl font-bold">Cardápio Digital</a>
                </div>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>
        
        <footer class="bg-gray-800 text-white mt-auto">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h3 class="font-playfair text-xl font-bold">Cardápio Digital</h3>
                        <p class="text-gray-400 text-sm mt-1">Modernizando a experiência gastronômica</p>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white mb-2 md:mb-0">Sobre Nós</a>
                        <a href="#" class="text-gray-300 hover:text-white mb-2 md:mb-0">Contato</a>
                        <a href="#" class="text-gray-300 hover:text-white">Política de Privacidade</a>
                    </div>
                </div>
                <div class="mt-6 text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Cardápio Digital. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</body>
</html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cardápio Digital') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-r from-amber-600 to-red-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('menu.index') }}" class="font-playfair text-2xl md:text-3xl font-bold">Cardápio Digital</a>
                </div>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>
        
        <footer class="bg-gray-800 text-white mt-auto">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h3 class="font-playfair text-xl font-bold">Cardápio Digital</h3>
                        <p class="text-gray-400 text-sm mt-1">Modernizando a experiência gastronômica</p>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white mb-2 md:mb-0">Sobre Nós</a>
                        <a href="#" class="text-gray-300 hover:text-white mb-2 md:mb-0">Contato</a>
                        <a href="#" class="text-gray-300 hover:text-white">Política de Privacidade</a>
                    </div>
                </div>
                <div class="mt-6 text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Cardápio Digital. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</body>
</html> 