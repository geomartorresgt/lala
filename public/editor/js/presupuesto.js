$(document).ready(function() {
    const presupuesto_id = localStorage.getItem("aux_presupuesto_id");
    var $collapsePresupuesto = $('#collapsePresupuesto');

    // al abrir el collapse
    $collapsePresupuesto.on('show.bs.collapse', function (e) {
        var url = window.location.href.replace('editor/', `admin/presupuestos/${presupuesto_id}`)
    
        $.ajax({
            type:'GET',
            url: url,
            data:{ presupuesto_id: presupuesto_id },
            dataType: 'json',
            success:function(data){
                if (data.id == presupuesto_id) {
                    showPresupuesto(data)
                }
            }
        });
    })

    function showPresupuesto(presupuesto) {
        var $contentMuebles = $collapsePresupuesto.find('#content-muebles');
        var $subtotalPresupuesto = $collapsePresupuesto.find('#subtotal_presupuesto');
        var $descuentoPorcentajePresupuesto = $collapsePresupuesto.find('#descuento_porcentaje');
        var $descuentoPresupuesto = $collapsePresupuesto.find('#descuento_presupuesto');
        var $totalPresupuesto = $collapsePresupuesto.find('#total_presupuesto');
        var data = '';

        // limpiando el collapse
        $contentMuebles.html(data);
        
        data = presupuesto.muebles.map( data => {
            return muebleTemplate(data.mueble)
        });

        // add data in collapse
        $contentMuebles.html(data);
        $subtotalPresupuesto.html(presupuesto.subtotal);
        $descuentoPorcentajePresupuesto.html(presupuesto.descuento)
        $descuentoPresupuesto.html(presupuesto.descuento_dinero);
        $totalPresupuesto.html(presupuesto.total);

    }

    function muebleTemplate(mueble){
        return `
            <div class="col-md-2 text-left">
                <div class="thumbnail">
                    <img src="${mueble.foto_url}" alt="Mueble">
                    <div class="caption">
                        <h6 class="font-weight-bold">${mueble.nombre}</h6>
                        <p>$ ${mueble.precio}</p>
                    </div>
                </div>
            </div>
        `;
    }
});