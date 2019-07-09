@push('css')

<link rel="stylesheet" href="{{asset("plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css")}}">
@endpush

@push('js')
<script src="{{asset("js/pages/uiTables.js")}}"></script>

<script src="{{asset("plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js")}}"></script>

<script>
    $(function () {
        UiTables.init();
        $.fn.dataTable.ext.errMode = 'none';

        var config_datatable = {
            'responsive': true,
            "language": {
                infoEmpty: 'Sin registros disponibles',
            },
        }

        $.extend($.fn.dataTable.defaults, config_datatable);
    });
</script>
@endpush
