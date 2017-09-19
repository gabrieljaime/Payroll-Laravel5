{!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}
{!! Html::script('assets/plugins/datepicker/locales/bootstrap-datepicker.es.js') !!}

<script type="text/javascript">

    $(document).ready(function () {
        // select2 style
        $('#legajo').select2({
            placeholder: "Seleccione"
        });
        $('#fecha_pago').datepicker({
            autoclose: true,
            language:'es',
            todayBtn: 'linked',
            todayHighlight:true,
            format:'dd/mm/yyyy'
        });
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            increaseArea: '20%' // optional
        });
        $('#legajo').addClass('form-control select2');
        $('#legajo').val(null).trigger("change");
        $('#todos').on('ifChecked', function () {
            $("#legajo > option").removeAttr("selected");// Select All Options
            $("#legajo").trigger("change");// Trigger change to select 2
            $("#legajo").prop("disabled", true);
        });
        $('#todos').on('ifUnchecked', function () {
            $("#legajo").prop("disabled", false);
            $("#legajo > option").removeAttr("selected");
            $("#legajo").trigger("change");// Trigger change to select 2
        });


        //iCheck for checkbox and radio inputs

    });
</script>
