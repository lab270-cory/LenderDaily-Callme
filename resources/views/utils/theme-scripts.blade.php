{{--jQuery--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        // catching saved event and showing toaster message for saved event
        $(function () {
            // ============= TOASTER HANDLING =====================
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            document.addEventListener('{{SUCCESS}}', function (event) {
                toastr.success(event.detail)
            })

            document.addEventListener('{{ERROR}}', function (event) {
                toastr.error(event.detail)
            })

            document.addEventListener('{{WARN}}', function (event) {
                toastr.warning(event.detail)
            })

            document.addEventListener('{{INFO}}', function (event) {
                toastr.info(event.detail)
            })

            // handling redirect messages
            @if (Session::has('success'))
                document.dispatchEvent(new CustomEvent('{{SUCCESS}}', {detail: '{{Session::get('success')}}'}));
            @endif

            @if (Session::has('error'))
                document.dispatchEvent(new CustomEvent('{{ERROR}}', {detail: '{{Session::get('error')}}'}));
            @endif

            @if (Session::has('info'))
                document.dispatchEvent(new CustomEvent('{{INFO}}', {detail: '{{Session::get('info')}}'}));
            @endif


            // catching saved event and showing toaster message for saved event
            Livewire.on('saved', () => {
                document.dispatchEvent(new CustomEvent('{{SUCCESS}}', {detail: 'Saved Successfully'}));
            })

            // catching loggedOut event and showing toaster message for loggedOut event
            Livewire.on('loggedOut', () => {
                document.dispatchEvent(new CustomEvent('{{SUCCESS}}', {detail: 'Logged Out Successfully'}));
            })

            // catching saved event and showing toaster message for saved event
            Livewire.on('showNotification', (data) => {

                if (data.href) {
                    toastr.info(data.message, 'New Notification', {
                        onclick: () => {
                            window.location.href = data.href
                        }
                    })
                } else {
                    toastr.info(data.message, 'New Notification')
                }
            })

            // ============= TOASTER END =====================
        });
    });
</script>
