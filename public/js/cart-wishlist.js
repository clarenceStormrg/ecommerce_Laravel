// ==========================
// CART LOCAL STORAGE
// ==========================

// Obtener carrito
function getCart() {
    return JSON.parse(localStorage.getItem("cart")) || [];
}

// Guardar carrito
function saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// --------------------------
// CART FUNCTIONS
// --------------------------
function addToCart(productId, qty, price, image, url) {
    qty = parseInt(qty) || 1;
    price = parseFloat(price) || 0;

    let cart = getCart();

    let item = cart.find((p) => p.id === productId);

    if (item) {
        item.qty += qty;
    } else {
        cart.push({
            id: productId,
            image: image,
            price: price,
            qty: qty,
            url: url,
        });
    }

    saveCart(cart);

    console.log("🛒 Carrito actualizado:", cart);
}

function updateCartQty(productId, qty) {
    qty = parseInt(qty) || 1;

    let cart = getCart();

    let item = cart.find((p) => p.id === productId);

    if (item) {
        item.qty = qty;
    }

    saveCart(cart);

    console.log("🛒 Cantidad actualizada:", cart);
}

function removeFromCart(productId) {
    let cart = getCart().filter((p) => p.id !== productId);

    saveCart(cart);

    console.log("🛒 Producto eliminado:", cart);
}

// --------------------------
// QTY CONTROL
// --------------------------
function changeQty(productId, change) {
    let input = document.getElementById("qty-" + productId);
    if (!input) return;

    let current = parseInt(input.value) || 1;
    let newValue = current + change;

    if (newValue < 1) newValue = 1;

    input.value = newValue;

    updateCartQty(productId, newValue);
}

// --------------------------
// QUICK VIEW
// --------------------------
function openQuickView(productId) {
    let container = document.getElementById("quickViewContent");
    container.innerHTML = "<h5>Cargando producto...</h5>";

    fetch(`/quick-view/${productId}`)
        .then((res) => res.json())
        .then((product) => {
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

// ==========================
// WISHLIST DB (Laravel)
// ==========================

async function toggleWishlistDB(productId) {
    try {
        let response = await fetch(`/wishlist/toggle/${productId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
            },
        });

        if (response.status === 401) {
            window.location.href = "/login";
            return null; // 👈 IMPORTANTE
        }

        let data = await response.json();

        console.log("❤️ Wishlist DB:", data);

        return data; // 👈 ASEGURAR RETURN SIEMPRE
    } catch (error) {
        console.error("Wishlist Error:", error);
        return null; // 👈 EVITAS CRASH
    }
}

async function toggleWishlistDBRemove(productId) {
    try {
        let res = await fetch(`/wishlist/toggle/${productId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
            },
        });

        let data = await res.json();

        if (data.status === "removed") {
            let button = document.querySelector(
                `.wishlist-btn[data-product-id="${productId}"]`,
            );

            if (button) {
                let card = button.closest(".product-box-contain");
                if (card) card.remove();
            }
        }
    } catch (error) {
        console.error("Wishlist Error:", error);
    }
}

function updateWishlistUI(btn, status) {
    let text = btn.querySelector(".wishlist-text");

    if (status === "added") {
        btn.classList.add("active");
        if (text) text.innerText = "Quitar de favoritos";
    } else {
        btn.classList.remove("active");
        if (text) text.innerText = "Add To Wishlist";
    }
}

// ==========================
// EVENTOS AUTOMÁTICOS
// ==========================

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".wishlist-btn").forEach((btn) => {
        btn.addEventListener("click", async function (e) {
            e.preventDefault();

            let productId = this.dataset.productId;

            // 📌 Vista wishlist (eliminar del DOM)
            if (window.location.pathname === "/wishlist") {
                toggleWishlistDBRemove(productId);
                return;
            }

            // 📌 Otras vistas (home, product, etc.)
            let data = await toggleWishlistDB(productId);

            updateWishlistUI(this, data.status);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".addcart-button").forEach((btn) => {
        btn.addEventListener("click", function () {
            let parent = this.closest(".add-to-cart-box");

            if (!parent) return;

            let qtyBox = parent.querySelector(".qty-box");
            if (qtyBox) {
                qtyBox.style.display = "block";
            }

            this.style.display = "none";
        });
    });
});
