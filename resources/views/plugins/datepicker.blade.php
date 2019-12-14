@push('css')
<link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.min.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.es.min.js')}}"></script>
<script>
    $(function () {
        cargar_datepicker();
    });
    function cargar_datepicker()
    {
        var campos_fecha = $(".datepicker");
        var campos_fecha_mes = $(".datepicker_mes");
        var campos_fecha_anios = $(".datepicker_anios");
        var campos_fecha_decadas = $(".datepicker_decadas");
        var campos_fecha_year_meses=$(".datepicker_mes_year");
       

        if (campos_fecha.length > 0) {
            campos_fecha.datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                todayHighlight: true,
            });
        }
        if (campos_fecha_mes.length > 0) {
            campos_fecha_mes.datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                todayHighlight: true,
                startView: 1,
            });
        }
        if (campos_fecha_anios.length > 0) {
            campos_fecha_anios.datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                todayHighlight: true,
                startView: 2,
            });
        }
        if (campos_fecha_decadas.length > 0) {
            campos_fecha_decadas.datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                todayHighlight: true,
                startView: 3,
            });
        }

        if (campos_fecha_year_meses.length > 0) {
            campos_fecha_year_meses.datepicker({
                format: "yyyy-mm",
                startView:2, 
                minViewMode: "months",
                autoclose: true
            });
        }
    }
</script>
@endpush