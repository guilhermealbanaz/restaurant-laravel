<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Cardápio Digital</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">
    <div id="app" class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-r from-amber-600 to-red-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <a href="{{ route('menu.index') }}" class="font-playfair text-2xl md:text-3xl font-bold">Cardápio Digital</a>
                    </div>
                    <div class="flex items-center">
                        @if(isset($tableNumber))
                        <div class="mr-6 text-sm md:text-base">
                            <span class="font-semibold">Mesa:</span> {{ $tableNumber }}
                        </div>
                        @endif
                        
                        <button type="button" class="text-white p-2 rounded-full hover:bg-white/10 relative" id="cart-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        <div id="cart-sidebar" class="fixed top-0 right-0 w-full md:w-96 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex flex-col">
            <div class="p-4 bg-gradient-to-r from-amber-600 to-red-600 text-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold">Seu Pedido</h2>
                    <button id="close-cart" class="p-2 rounded-full hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div id="cart-items" class="flex-1 overflow-y-auto p-4">
                <!-- os itens do carrinho vao ser inseridos aqui via js -->
                <div class="text-center text-gray-500 py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="mt-4">Seu carrinho está vazio</p>
                </div>
            </div>
            
            <div class="border-t p-4 bg-gray-50">
                <div class="flex justify-between mb-4">
                    <span class="font-bold">Total:</span>
                    <span id="cart-total" class="font-bold">R$ 0,00</span>
                </div>
                
                <button id="checkout-button" class="w-full py-3 bg-gradient-to-r from-amber-600 to-red-600 text-white font-bold rounded-lg shadow hover:from-amber-700 hover:to-red-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Finalizar Pedido
                </button>
                
                <form id="customer-info" class="mt-4 hidden">
                    <div class="mb-3">
                        <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-1">Seu Nome</label>
                        <input type="text" id="customer-name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Digite seu nome">
                    </div>
                    
                    <div class="mb-3">
                        <label for="order-notes" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                        <textarea id="order-notes" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Alguma observação especial?"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-700">
                        Confirmar Pedido
                    </button>
                </form>
            </div>
        </div>
        
        <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <footer class="bg-gray-800 text-white">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartButton = document.getElementById('cart-button');
            const cartSidebar = document.getElementById('cart-sidebar');
            const closeCart = document.getElementById('close-cart');
            const cartOverlay = document.getElementById('cart-overlay');
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const checkoutButton = document.getElementById('checkout-button');
            const customerInfo = document.getElementById('customer-info');
            
            cartButton.addEventListener('click', function() {
                cartSidebar.classList.remove('translate-x-full');
                cartOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                
                // atualizar os itens do carrinho quando for aberto
                updateCartDisplay();
            });
            
            // fechar carrinho
            const closeCartFunction = function() {
                cartSidebar.classList.add('translate-x-full');
                cartOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };
            
            closeCart.addEventListener('click', closeCartFunction);
            cartOverlay.addEventListener('click', closeCartFunction);
            
            // botão de checkout
            checkoutButton.addEventListener('click', function() {
                checkoutButton.classList.add('hidden');
                customerInfo.classList.remove('hidden');
            });
            
            // inicializa o carrinho no localStorage se ainda não existir
            if (!localStorage.getItem('cart')) {
                localStorage.setItem('cart', JSON.stringify([]));
            }
            
            // atualiza a contagem inicial de itens no carrinho
            updateCartCount();
            
            // função para adicionar um item ao carrinho
            window.addToCart = function(dishId, dishName, dishPrice) {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                // verifica se o item já está no carrinho
                const existingItemIndex = cart.findIndex(item => item.id === dishId);
                
                if (existingItemIndex !== -1) {
                    // se o item já existe, incrementa a quantidade
                    cart[existingItemIndex].quantity += 1;
                } else {
                    // se é um novo item, adiciona ao carrinho
                    cart.push({
                        id: dishId,
                        name: dishName,
                        price: dishPrice,
                        quantity: 1
                    });
                }
                
                // salva o carrinho atualizado no localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
                
                // atualiza a contagem e exibe os itens
                updateCartCount();
                
                return cart.length;
            };
            
            // função para remover um item do carrinho
            window.removeFromCart = function(dishId) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                cart = cart.filter(item => item.id !== dishId);
                
                localStorage.setItem('cart', JSON.stringify(cart));
                
                updateCartCount();
                updateCartDisplay();
            };
            
            window.updateCartItemQuantity = function(dishId, newQuantity) {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                // encontra o item e atualiza a quantidade
                const itemIndex = cart.findIndex(item => item.id === dishId);
                
                if (itemIndex !== -1) {
                    if (newQuantity <= 0) {
                        // se a quantidade for zero ou menor, remove o item
                        window.removeFromCart(dishId);
                    } else {
                        cart[itemIndex].quantity = newQuantity;
                        localStorage.setItem('cart', JSON.stringify(cart));
                        updateCartCount();
                        updateCartDisplay();
                    }
                }
            };
            
            // função para atualizar a contagem de itens no carrinho
            function updateCartCount() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
                cartCount.textContent = totalItems;
                
                // ativa/desativa o botão de checkout
                checkoutButton.disabled = totalItems === 0;
            }
            
            // função para exibir os itens do carrinho
            function updateCartDisplay() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                // limpa o conteúdo atual
                cartItems.innerHTML = '';
                
                if (cart.length === 0) {
                    // se o carrinho ta vazio mostra mensagem
                    cartItems.innerHTML = `
                        <div class="text-center text-gray-500 py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="mt-4">Seu carrinho está vazio</p>
                        </div>
                    `;
                    cartTotal.textContent = 'R$ 0,00';
                    return;
                }
                
                let totalPrice = 0;
                
                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    totalPrice += itemTotal;
                    
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex justify-between items-start border-b border-gray-200 py-4';
                    itemElement.innerHTML = `
                        <div class="flex-1">
                            <h3 class="text-md font-medium">${item.name}</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-gray-600">R$ ${item.price.toFixed(2).replace('.', ',')}</span>
                                <span class="mx-2 text-gray-400">×</span>
                                <div class="flex items-center">
                                    <button type="button" class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300" onclick="updateCartItemQuantity('${item.id}', ${item.quantity - 1})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <span class="mx-2">${item.quantity}</span>
                                    <button type="button" class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300" onclick="updateCartItemQuantity('${item.id}', ${item.quantity + 1})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="font-medium">R$ ${itemTotal.toFixed(2).replace('.', ',')}</span>
                            <button type="button" class="ml-2 text-gray-400 hover:text-red-600" onclick="removeFromCart('${item.id}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    `;
                    
                    cartItems.appendChild(itemElement);
                });
                
                cartTotal.textContent = `R$ ${totalPrice.toFixed(2).replace('.', ',')}`;
            }
            
            updateCartDisplay();
            
            const customerInfoForm = document.getElementById('customer-info');
            customerInfoForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const customerName = document.getElementById('customer-name').value.trim();
                const orderNotes = document.getElementById('order-notes').value.trim();
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                if (cart.length === 0) {
                    alert('Seu carrinho está vazio. Adicione itens antes de confirmar o pedido.');
                    return;
                }
                
                const items = cart.map(item => ({
                    dish_id: item.id,
                    quantity: item.quantity,
                    notes: null
                }));
                
                const orderData = {
                    table_number: '{{ $tableNumber ?? "Não especificada" }}',
                    customer_name: customerName,
                    notes: orderNotes,
                    items: items
                };
                
                const submitBtn = customerInfoForm.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="inline-block animate-spin mr-2">⟳</span> Processando...';
                
                fetch('{{ route('menu.process-order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            try {
                                return Promise.reject(JSON.parse(text));
                            } catch (e) {
                                return Promise.reject({ message: 'Erro do servidor: ' + text.substring(0, 100) + '...' });
                            }
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // limpa o carrinho
                        localStorage.setItem('cart', JSON.stringify([]));
                        updateCartCount();
                        updateCartDisplay();
                        
                        // fecha o drawer do carrinho
                        closeCartFunction();
                        
                        // exibe mensagem de sucesso
                        const notification = document.createElement('div');
                        notification.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-4 rounded shadow-lg';
                        notification.style.zIndex = '9999';
                        
                        const orderId = data.order && data.order.id ? data.order.id : 'novo';
                        notification.innerHTML = 
                            '<div class="flex items-center">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />' +
                                '</svg>' +
                                '<div>' +
                                    '<h3 class="font-bold text-lg">Pedido Confirmado!</h3>' +
                                    '<p>Seu pedido #' + orderId + ' foi realizado com sucesso.</p>' +
                                '</div>' +
                            '</div>';
                        document.body.appendChild(notification);
                        
                        // remove a notificação após 6 segundos
                        setTimeout(() => {
                            notification.remove();
                        }, 6000);
                        
                        // reseta o formulário
                        customerInfoForm.reset();
                        customerInfoForm.classList.add('hidden');
                        checkoutButton.classList.remove('hidden');
                    } else {
                        throw new Error(data.message || 'Erro ao processar o pedido');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    
                    // exibe mensagem de erro
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 right-4 bg-red-600 text-white px-6 py-4 rounded shadow-lg';
                    notification.style.zIndex = '9999';
                    
                    const errorMessage = error.message || 'Erro desconhecido ao processar pedido';
                    notification.innerHTML = 
                        '<div class="flex items-center">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />' +
                            '</svg>' +
                            '<div>' +
                                '<h3 class="font-bold text-lg">Erro!</h3>' +
                                '<p>' + errorMessage + '</p>' +
                            '</div>' +
                        '</div>';
                    document.body.appendChild(notification);
                    
                    // remove a notificação após 6 segundos
                    setTimeout(() => {
                        notification.remove();
                    }, 6000);
                })
                .finally(() => {
                    // restaura o botão
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html> 