toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-bottom-right",
    timeOut: "3000",
};
window.addProductToCart = function (event) {
    event.preventDefault();

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
            console.log(xhr.responseText);
            toastr.error("حدث خطأ أثناء الإضافة إلى السلة.");
        }
    });
};

window.addProductToWishlist = function (event) {
    event.preventDefault();

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
            console.log(xhr.responseText);
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