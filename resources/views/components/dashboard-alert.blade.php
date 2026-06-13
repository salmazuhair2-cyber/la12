@if(session('alert'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var action = "{{ session('alert.action') }}";
        var message = "{{ session('alert.message') }}";
        var backRoute = "{{ session('alert.back_route') }}";
        var continueRoute = "{{ session('alert.continue_route') }}";

        if (action === 'create') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                showCancelButton: true,
                confirmButtonText: 'Add Another',
                cancelButtonText: 'Back To List',
                confirmButtonColor: '#7380ec',
                cancelButtonColor: '#6c757d',
            }).then(function(result) {
                window.location.href = result.isConfirmed ? continueRoute : backRoute;
            });

        } else if (action === 'update') {
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: message,
                showCancelButton: true,
                confirmButtonText: 'Continue Editing',
                cancelButtonText: 'Back To List',
                confirmButtonColor: '#7380ec',
                cancelButtonColor: '#6c757d',
            }).then(function(result) {
                window.location.href = result.isConfirmed ? continueRoute : backRoute;
            });

        } else if (action === 'delete') {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#7380ec',
            }).then(function() {
                window.location.href = backRoute;
            });
        }
    });
</script>
@endif

{{-- تأكيد الحذف --}}
<script>
    function confirmDelete(formId) {
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#e55353',
            cancelButtonColor: '#6c757d',
        }).then(function(result) {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    function checkCouponExists(code, existingCodes) {
        if (existingCodes.includes(code.toUpperCase())) {
            Swal.fire({
                icon: 'warning',
                title: 'Coupon Already Exists!',
                text: 'A coupon with code "' + code.toUpperCase() + '" already exists.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#7380ec',
            });
            return false;
        }
        return true;
    }
</script>