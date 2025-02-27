<header>

    <div class="header-main">

        <div class="container">

            <a href="#" class="header-logo">
                <img src="{{ asset('assets/site/images/logo/logo.svg') }}" alt="Anon's logo" width="120" height="36">
            </a>

            <div class="header-search-container">

                <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

                <button class="search-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

            </div>
            <div class="header-user-actions">
                <a href="{{route('cart.show')}}" class="action-btn" id="cart-btn">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="count" id="cart-count">{{Cart::instance('cart')->content()->count()}}</span>
                </a>

                <button class="action-btn" id="favorites-btn">
                    <ion-icon name="heart-outline"></ion-icon>
                    <span class="count" id="favorites-count">0</span>
                </button>


                </div>
            </div>
            <style>
                .dropdown-content {
                    display: none;
                    position: absolute;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    border: 1px solid var(--cultured);
                    z-index: 1000;
                    top: 95px;
                    right: 200px;
                    padding: 25px;
                    width: 400px;
                }

                .dropdown-content ul {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .dropdown-content li {
                    margin-bottom: 10px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .action-btn {
                    background: none;
                    border: none;
                    cursor: pointer;
                    position: relative;
                }

                .product {
                    margin-bottom: 20px;
                }

                button.add-to-cart,
                button.add-to-favorites {
                    margin-top: 10px;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const cartBtn = document.getElementById('cart-btn');
                    const favoritesBtn = document.getElementById('favorites-btn');
                    const cartDropdown = document.getElementById('cart-dropdown');
                    const favoritesDropdown = document.getElementById('favorites-dropdown');
                    const cartItemsList = document.getElementById('cart-items');
                    const cartCount = document.getElementById('cart-count');
                    const favoriteItemsList = document.getElementById('favorite-items');
                    const favoritesCount = document.getElementById('favorites-count');
                    let cart = [];
                    let favorites = [];
                    cartBtn.addEventListener('click', () => {
                        cartDropdown.style.display = cartDropdown.style.display === 'block' ? 'none' : 'block';
                        favoritesDropdown.style.display = 'none';
                    });
                    favoritesBtn.addEventListener('click', () => {
                        favoritesDropdown.style.display = favoritesDropdown.style.display === 'block' ? 'none' :
                            'block';
                        cartDropdown.style.display = 'none';
                    });
                    document.addEventListener('click', (event) => {
                        if (!event.target.closest('.header-user-actions')) {
                            cartDropdown.style.display = 'none';
                            favoritesDropdown.style.display = 'none';
                        }
                    });
                    document.querySelectorAll('.add-to-cart').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const product = e.target.dataset.product;
                            const price = parseFloat(e.target.dataset.price);
                            const existingProduct = cart.find(item => item.product === product);
                            if (existingProduct) {
                                existingProduct.quantity += 1;
                            } else {
                                cart.push({
                                    product,
                                    price,
                                    quantity: 1
                                });
                            }

                            updateCart();
                        });
                    });
                    document.querySelectorAll('.add-to-favorites').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const product = e.target.dataset.product;

                            if (!favorites.includes(product)) {
                                favorites.push(product);
                                updateFavorites();
                            }
                        });
                    });

                    cartItemsList.addEventListener('click', (e) => {
                        if (e.target.classList.contains('remove-item')) {
                            const product = e.target.dataset.product;
                            cart = cart.filter(item => item.product !== product);
                            updateCart();
                        }
                    });

                    cartItemsList.addEventListener('change', (e) => {
                        if (e.target.classList.contains('quantity-input')) {
                            const product = e.target.dataset.product;
                            const newQuantity = parseInt(e.target.value);
                            const cartItem = cart.find(item => item.product === product);
                            if (cartItem) {
                                cartItem.quantity = newQuantity;
                                if (newQuantity <= 0) {
                                    cart = cart.filter(item => item.product !== product);
                                }
                                updateCart();
                            }
                        }
                    });
                    document.getElementById('checkout-btn')?.addEventListener('click', () => {
                        alert('Proceeding to checkout!');
                    });

                    function updateCart() {
                        cartItemsList.innerHTML = '';
                        let totalItems = 0;

                        cart.forEach(item => {
                            totalItems += item.quantity;

                            const li = document.createElement('li');
                            li.innerHTML = `${item.product} - $${item.price} x
                            <input type="number" class="quantity-input" data-product="${item.product}" value="${item.quantity}" min="1">
                            <button class="remove-item" data-product="${item.product}">X</button>`;

                            cartItemsList.appendChild(li);
                        });

                        cartCount.textContent = totalItems;
                        if (totalItems === 0) {
                            cartItemsList.innerHTML = '<li>Cart is empty</li>';
                        }
                    }

                    function updateFavorites() {
                        favoriteItemsList.innerHTML = '';

                        favorites.forEach(product => {
                            const li = document.createElement('li');
                            li.textContent = product;
                            favoriteItemsList.appendChild(li);
                        });

                        favoritesCount.textContent = favorites.length;
                        if (favorites.length === 0) {
                            favoriteItemsList.innerHTML = '<li>No favorites added</li>';
                        }
                    }
                });
            </script>
        </div>

    </div>

    <nav class="desktop-navigation-menu">

        <div class="container">

            <ul class="desktop-menu-category-list">

                <li class="menu-category">
                    <a href="#" class="menu-title">Home</a>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Categories</a>

                    <div class="dropdown-panel">

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Electronics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Desktop</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Laptop</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Camera</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Tablet</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Headphone</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/electronics-banner-1.jpg" alt="headphone collection"
                                        width="250" height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Men's</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Formal</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Casual</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Sports</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Jacket</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Sunglasses</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/mens-banner.jpg" alt="men's fashion" width="250"
                                        height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Women's</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Formal</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Casual</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Perfume</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Cosmetics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Bags</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/womens-banner.jpg" alt="women's fashion" width="250"
                                        height="119">
                                </a>
                            </li>

                        </ul>

                        <ul class="dropdown-panel-list">

                            <li class="menu-title">
                                <a href="#">Electronics</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Smart Watch</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Smart TV</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Keyboard</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Mouse</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">Microphone</a>
                            </li>

                            <li class="panel-list-item">
                                <a href="#">
                                    <img src="./assets/images/electronics-banner-2.jpg" alt="mouse collection"
                                        width="250" height="119">
                                </a>
                            </li>

                        </ul>

                    </div>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Men's</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Shirt</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Shorts & Jeans</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Safety Shoes</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Wallet</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Women's</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Dress & Frock</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Earrings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Necklace</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Makeup Kit</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Jewelry</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Earrings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Couple Rings</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Necklace</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Bracelets</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-category">
                    <a href="#" class="menu-title">Perfume</a>

                    <ul class="dropdown-list">

                        <li class="dropdown-item">
                            <a href="#">Clothes Perfume</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Deodorant</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Flower Fragrance</a>
                        </li>

                        <li class="dropdown-item">
                            <a href="#">Air Freshener</a>
                        </li>

                    </ul>
                </li>





            </ul>

        </div>

    </nav>

    <div class="mobile-bottom-navigation">

        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
        </button>

        <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>

            <span class="count">0</span>
        </button>

        <button class="action-btn">
            <ion-icon name="home-outline"></ion-icon>
        </button>

        <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>

            <span class="count">0</span>
        </button>

        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="grid-outline"></ion-icon>
        </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

        <div class="menu-top">
            <h2 class="menu-title">Menu</h2>

            <button class="menu-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>

        <ul class="mobile-menu-category-list">

            <li class="menu-category">
                <a href="#" class="menu-title">Home</a>
            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Men's</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Shirt</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Shorts & Jeans</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Safety Shoes</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Wallet</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Women's</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Dress & Frock</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Earrings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Necklace</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Makeup Kit</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Jewelry</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Earrings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Couple Rings</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Necklace</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Bracelets</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">

                <button class="accordion-menu" data-accordion-btn>
                    <p class="menu-title">Perfume</p>

                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>

                <ul class="submenu-category-list" data-accordion>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Clothes Perfume</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Deodorant</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Flower Fragrance</a>
                    </li>

                    <li class="submenu-category">
                        <a href="#" class="submenu-title">Air Freshener</a>
                    </li>

                </ul>

            </li>

            <li class="menu-category">
                <a href="#" class="menu-title">Blog</a>
            </li>

            <li class="menu-category">
                <a href="#" class="menu-title">Hot Offers</a>
            </li>

        </ul>

        <div class="menu-bottom">

            <ul class="menu-category-list">

                <li class="menu-category">

                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Language</p>

                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>

                    <ul class="submenu-category-list" data-accordion>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">English</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">Espa&ntilde;ol</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">Fren&ccedil;h</a>
                        </li>

                    </ul>

                </li>

                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Currency</p>
                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>

                    <ul class="submenu-category-list" data-accordion>
                        <li class="submenu-category">
                            <a href="#" class="submenu-title">USD &dollar;</a>
                        </li>

                        <li class="submenu-category">
                            <a href="#" class="submenu-title">EUR &euro;</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul class="menu-social-container">

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>

                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>

            </ul>

        </div>

    </nav>

</header>
