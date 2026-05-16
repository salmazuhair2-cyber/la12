window.addProductToCart = function (event) {
    event.preventDefault();

    if (typeof IS_LOGGED_IN === 'undefined' || !IS_LOGGED_IN) {
        showLoginModal('/login');
        return;
    }

    const productId = $(event.currentTarget)
        .closest('[data-product-id]')
        .data('product-id');

    $.ajax({
        url: '/cart/add',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: productId
        },
        success: function (response) {
            $("#cart-content").load(window.location.href + " #cart-content");
            toastr.success(response.message || "تمت الإضافة إلى السلة.");
        },
        error: function (xhr) {
            toastr.error("حدث خطأ أثناء الإضافة إلى السلة.");
        }
    });
};

window.addProductToWishlist = function (event) {
    event.preventDefault();

    if (typeof IS_LOGGED_IN === 'undefined' || !IS_LOGGED_IN) {
        showLoginModal('/login');
        return;
    }

    const productId = $(event.currentTarget).data('product-id');

    $.ajax({
        url: '/wishlist/add',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: productId
        },
        success: function (response) {
            $("#wishlist-content").load(window.location.href + " #wishlist-content");
            toastr.success(response.message || "تمت الإضافة إلى المفضلة.");
        },
        error: function (xhr) {
            toastr.error("حدث خطأ أثناء معالجة الطلب.");
        }
    });
};

window.removeFromWishlist = function (itemId) {
    $.ajax({
        url: '/wishlist/remove',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: itemId
        },
        success: function (response) {
            $("#wishlist-content").load(window.location.href + " #wishlist-content");
            $('#wishlist-table').load(window.location.href + ' #wishlist-table');
            toastr.success(response.message || "تمت إزالة المنتج من المفضلة.");
        },
        error: function () {
            toastr.error("حدث خطأ أثناء إزالة المنتج من المفضلة.");
        }
    });
};

window.removeFromCart = function (itemId) {
    $.ajax({
        url: '/cart/remove',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: itemId
        },
        success: function (response) {
            $("#cart-content").load(window.location.href + " #cart-content");
            $('#cart-table').load(window.location.href + ' #cart-table');
            toastr.success(response.message || "تمت إزالة المنتج من السلة.");
        },
        error: function () {
            toastr.error("حدث خطأ أثناء إزالة المنتج من السلة.");
        }
    });
};

window.updateQuantity = function (productId, change) {
    $.ajax({
        url: '/cart/update',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: productId,
            change: change
        },
        success: function (response) {
            $('#cart-content').load(window.location.href + ' #cart-content');
            $('#cart-table').load(window.location.href + ' #cart-table');
            toastr.success(response.message || "تم تحديث الكمية.");
        },
        error: function () {
            toastr.error("حدث خطأ أثناء تحديث الكمية.");
        }
    });
};

window.showTab = function (tabId) {
    document.querySelectorAll(".tab-button").forEach((button) => {
        button.classList.remove("active");
    });
    event.target.classList.add("active");
    document.querySelectorAll(".tab-content").forEach((content) => {
        content.style.display = "none";
    });
    document.getElementById(tabId).style.display = "block";
};

function showLoginModal(loginUrl) {
    if ($('#login-modal').length) $('#login-modal').remove();

    $('body').append(`
        <div id="login-modal" style="
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); z-index: 99999;
            display: flex; align-items: center; justify-content: center;">
            <div style="
                background: white; border-radius: 20px; padding: 40px;
                text-align: center; max-width: 420px; width: 90%;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                animation: popIn 0.3s ease;">
                <div style="font-size: 50px; margin-bottom: 15px;">🔐</div>
                <h2 style="color: #242323; margin-bottom: 10px; font-size: 24px;">يرجى تسجيل الدخول</h2>
                <p style="color: #777; margin-bottom: 25px; font-size: 16px;">
                    قم بتسجيل الدخول لإضافة المنتجات إلى سلتك أو قائمة المفضلة
                </p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <a href="${loginUrl}" style="
                        background: linear-gradient(135deg, #fa1a8a, #3ec4f9);
                        color: white; padding: 12px 30px; border-radius: 25px;
                        text-decoration: none; font-weight: bold; font-size: 16px;
                        transition: transform 0.2s;">
                        تسجيل الدخول
                    </a>
                    <button onclick="$('#login-modal').remove()" style="
                        background: #f0f0f0; color: #555; padding: 12px 30px;
                        border-radius: 25px; border: none; cursor: pointer;
                        font-weight: bold; font-size: 16px;">
                        لاحقاً
                    </button>
                </div>
            </div>
        </div>
        <style>
            @keyframes popIn {
                from { transform: scale(0.8); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
        </style>
    `);
}