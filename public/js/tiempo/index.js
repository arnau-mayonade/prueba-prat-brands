$("#buscar").click(function (e) {
    obtenerTiempoApiAemet(e);
});

$('#tiempo-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
        obtenerTiempoApiAemet(e);
    }
});

function obtenerTiempoApiAemet(e){
    e.preventDefault();
    var municipio = $('#municipio').val();
    var csrf = document.querySelector('meta[name="csrf-token"]').content;
    var data={municipio:municipio,_token:csrf};
    let route = "/getTiempoAemet";
    $.ajax({
        type: "POST",
        url: route,
        data: data,
        success: function (datos) {
            $("#cuerpo-tabla").html("");
            datos.forEach(function (dato, index) {
                $("#cuerpo-tabla").append("<tr><td>"+ dato.dia +"</td><td>"+dato.estadoCielo+"</td><td>"+dato.temperaturaMin+" - "+dato.temperaturaMax +"</td><td>"+dato.vientoVelocidad +" - "+ dato.vientoDireccion +"</td><td>"+dato.humedadMin +" - "+ dato.humedadMax +"</td><td>"+ dato.probPrecipitacion +"</td><td>"+ dato.cotaNieve +"</td></tr>");
            });

            $("#contenedor-principal").show();
        },
        error:function (xhr, ajaxOptions, thrownError){
            if(xhr.status == "404"){
                alert("No se ha encontrado el municipio");
                $('#municipio').val("");
                $("#cuerpo-tabla").html("");
            }
        }
    });
}
