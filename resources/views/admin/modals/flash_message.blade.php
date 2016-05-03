@if (session()->has('flash_notification.message'))
<script>
    swal({
                title: "{!! session('flash_notification.title') !!}",
                text: "{!! session('flash_notification.message') !!}",
                html: true,
                type: "{!! session('flash_notification.level') !!}",
                @if (session('flash_notification.time')!=0)
                timer:  "{!! session('flash_notification.time') !!}",
                @endif
                showConfirmButton: @if (session('flash_notification.time')==0)
                                        true,
                                    @else false,
                                    @endif
            }
    );
</script>
@endif

