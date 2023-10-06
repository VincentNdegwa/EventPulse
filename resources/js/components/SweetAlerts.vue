<script>
export default {
    methods: {
        showMessage(message) {
            this.$swal(message);
        },
        showConfirm(message) {
            this.$swal({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                return result.value
            });

        }, showNotification(message) {
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: 'success',
                title: message
            });
        }, showNotificationError(message) {
            this.$swal({
                toast: true,
                showConfirmButton: false,
                position: "top-end",
                timer: 5000,
                icon: "error",
                title: message
            })
        }
    }
}
</script>
