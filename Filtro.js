function buscar_filtro() {
    var piso = $('#piso').val();
    var tipo = $('#tipo').val();
    var capacidad = $('#capacidad').val();

    var parametros = {
        "buscar": "1",
        "piso": piso,
        "tipo": tipo,
        "capacidad": capacidad
    };

    $.post('buscadorAmbientes.php', parametros, function(response) {
        $('#resultado_busqueda').html(response);
    });
}
