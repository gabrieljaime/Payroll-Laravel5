@if (session()->has('flash_notification.message'))
<script>
    swal({
                title: "Generando Liquidación",
                text: "{!! session('flash_notification.message') !!}." +
                "<p><br><br></p><h3><strong> Espere por Favor</strong></h3>",
                html: true,
                type: "info",
                timer:  "{!! session('flash_notification.time') !!}",
                showConfirmButton: false
            },
            function () {
                setTimeout(function () {
                    swal("Liquidación Finalizada", "", "success"
                    );
                }, 2000);
            }
    );
</script>
@endif

