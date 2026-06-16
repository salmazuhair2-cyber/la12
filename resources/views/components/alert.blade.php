@if(session('order_success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '{{ session("order_success.title") }}',
            html: '{{ session("order_success.message") }}<br><br><strong>Order #{{ session("order_success.order_id") }}</strong>',
            confirmButtonText: 'Continue Shopping',
            confirmButtonColor: '#ff3496',
        });
    });
</script>
@endif