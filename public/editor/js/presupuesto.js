$(document).ready(function() {
    const presupuesto_id = localStorage.getItem("aux_presupuesto_id");
    var $collapsePresupuesto = $('#collapsePresupuesto');
    var $divMuebles = $('.div-muebles');

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

        toggleMuebles();
    })

    // al cerrar el collapse
    $collapsePresupuesto.on('hide.bs.collapse', function (e) {
        toggleMuebles();
    })

    // close presupuesto
	$('.close-collapse').click(function(e) {
        $(this).closest('.collapse').collapse('toggle');
	});

    function showPresupuesto(presupuesto) {
        var $contentMuebles = $divMuebles.find('#content-muebles');
        var $subtotalPresupuesto = $collapsePresupuesto.find('#subtotal_presupuesto');
        var $descuentoPresupuesto = $collapsePresupuesto.find('#descuento_presupuesto');
        var $totalPresupuesto = $collapsePresupuesto.find('#total_presupuesto');
        var data = '';

        $('#nombre_cliente').html(presupuesto.nombre_cliente);

        // limpiando el collapse
        $contentMuebles.html(data);
        
        data = presupuesto.muebles.map( data => {
            return muebleTemplate(data.mueble)
        });

        // add data in collapse
        $contentMuebles.html(data);
        $subtotalPresupuesto.html(`U$S ${presupuesto.subtotal}`);
        $descuentoPresupuesto.html(`U$S ${presupuesto.descuento_dinero}`);
        $totalPresupuesto.html(`U$S ${presupuesto.total}`);

    }

    function toggleMuebles() {
        var $divMuebles = $('.div-muebles');
        var $contentCanvas = $('.content-canvas');
        $divMuebles.toggleClass('show');

        if ($divMuebles.hasClass('show') ) {
            $contentCanvas.removeClass('show-100')
            $contentCanvas.addClass('show-85')
        } else {
            $contentCanvas.removeClass('show-85')
            $contentCanvas.addClass('show-100')
        }

    }

    function muebleTemplate(mueble){

        return `
            <div class="col-md-12 text-left border-b-1" style="padding-top: 1rem;">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" width="40" src="${mueble.foto_url}" alt="Mueble" >
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">${mueble.nombre}</h6>
                        <p style="margin:0;">${mueble.dimensiones}</p>
                        <p style="margin:0;">U$S ${mueble.precio}</p>
                    </div>
                </div>
            </div>
        `;
    }
});