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
// INIT
// --------------------------
console.log("📦 Cart cargado:", getCart());
console.log("⭐ Wishlist cargado:", getWishlist());
