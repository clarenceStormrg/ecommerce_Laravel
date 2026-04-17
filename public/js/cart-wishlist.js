// ==========================
// CART + WISHLIST LOCALSTORAGE
// ==========================

// Obtener carrito
function getCart() {
    return JSON.parse(localStorage.getItem("cart")) || [];
}

// Guardar carrito
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Obtener wishlist
function getWishlist() {
    return JSON.parse(localStorage.getItem("wishlist")) || [];
}

// Guardar wishlist
function saveWishlist(wishlist) {
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
}

// --------------------------
// CART FUNCTIONS
// --------------------------
function addToCart(productId, qty, price, image, url) {

    qty = parseInt(qty) || 1;
    price = parseFloat(price) || 0;

    let cart = getCart();

    let item = cart.find(p => p.id === productId);

    if (item) {
        item.qty += qty;
    } else {
        cart.push({
            id: productId,
            image: image,
            price: price,
            qty: qty,
            url: url
        });
    }

    saveCart(cart);

    console.log("🛒 Carrito actualizado:", cart);
}

function updateCartQty(productId, qty) {

    qty = parseInt(qty) || 1;

    let cart = getCart();

    let item = cart.find(p => p.id === productId);

    if (item) {
        item.qty = qty;
    }

    saveCart(cart);

    console.log("🛒 Cantidad actualizada:", cart);
}

function removeFromCart(productId) {
    let cart = getCart().filter(p => p.id !== productId);

    saveCart(cart);

    console.log("🛒 Producto eliminado:", cart);
}

// --------------------------
// WISHLIST FUNCTIONS
// --------------------------
function toggleWishlist(productId, price, image, url) {

    price = parseFloat(price) || 0;

    let wishlist = getWishlist();

    let exists = wishlist.find(p => p.id === productId);

    if (exists) {
        wishlist = wishlist.filter(p => p.id !== productId);
        console.log("💔 Eliminado de wishlist:", wishlist);
    } else {
        wishlist.push({
            id: productId,
            image: image,
            price: price,
            url: url
        });

        console.log("❤️ Agregado a wishlist:", wishlist);
    }

    saveWishlist(wishlist);
}

// --------------------------
// QTY CONTROL
// --------------------------
function changeQty(productId, change) {
    let input = document.getElementById('qty-' + productId);

    if (!input) return;

    let current = parseInt(input.value) || 1;
    let newValue = current + change;

    if (newValue < 1) newValue = 1;

    input.value = newValue;
}

// --------------------------
// QUICK VIEW
// --------------------------
function openQuickView(productId) {

    let container = document.getElementById("quickViewContent");
    container.innerHTML = "<h5>Cargando producto...</h5>";

    fetch(`/quick-view/${productId}`)
        .then(res => res.json())
        .then(product => {

            container.innerHTML = `
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <img src="${product.image}" class="img-fluid" alt="${product.name}">
                    </div>
                    <div class="col-md-7 text-start">
                        <h3>${product.name}</h3>
                        <p>${product.description}</p>
                        <h4 class="theme-color">S/ ${product.discount_price ?? product.price}</h4>
                        <a href="${product.url}" class="btn theme-bg-color view-button icon text-white fw-bold btn-md mt-3">
                            Ver producto completo
                        </a>
                    </div>
                </div>
            `;
        })
        .catch(() => {
            container.innerHTML = "<h5>Error cargando el producto</h5>";
        });
}

// --------------------------
// INIT
// --------------------------
console.log("📦 Cart cargado:", getCart());
console.log("⭐ Wishlist cargado:", getWishlist());
