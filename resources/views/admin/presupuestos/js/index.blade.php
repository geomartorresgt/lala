<script>
    $(document).ready(function() {
        $('#refresh').click(function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $('#fecha_inicio').val('');
            $('#fecha_fin').val('');
        });

        $('#filtro').click(function(e) {
            e.preventDefault();
        });
    });

    function filter() {
        var dataTablePresupuestos = $('#datatable_presupuestos');

        dataTablePresupuestos.DataTable({
            'ajax': {
                "url": '{{url("/admin/presupuestos")}}',
                "type": "GET",
                "dataType": "json",
                "contentType": 'application/json',
                dataSrc: '',
                data:function ( d ) {
                    d.fecha_inicio = $("#fecha_inicial").val();
                    d.fecha_fin = $("#fecha_final").val();

                    d.cliente = $("#cliente").val() == 0 ? null: stop = $("#cliente").val();
                    d.sucursal = $("#sucursal").val() == 0 ? null: stop = $("#sucursal").val();
                    d.zona = $("#zona").val() == 0 ? null: stop = $("#zona").val();
                },
            },
        })
    }
</script>
