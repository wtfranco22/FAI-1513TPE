function mostrarClave() {
    var cambio = document.getElementById("clave");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('#ojo').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('#ojo').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

function sugerirExtension() {
    var archivo = document.getElementById('archivo').value;
    var nombre = document.getElementById('nombre');
    nombre.value = (archivo.split('\\').pop()).split('.', 1);
    var extension = archivo.split('.').pop();
    switch (extension) {
        case ('jpg'):
            document.getElementById('img').checked = true;
            break;
        case ('png'):
            document.getElementById('img').checked = true;
            break;
        case ('gif'):
            document.getElementById('img').checked = true;
            break;
        case ('txt'):
            document.getElementById('doc').checked = true;
            break;
        case ('doc'):
            document.getElementById('doc').checked = true;
            break;
        case ('docx'):
            document.getElementById('doc').checked = true;
            break;
        case ('zip'):
            document.getElementById('zip').checked = true;
            break;
        case ('rar'):
            document.getElementById('zip').checked = true;
            break;
        case ('pdf'):
            document.getElementById('pdf').checked = true;
            break;
        case ('xls'):
            document.getElementById('xls').checked = true;
            break;
        case ('xlsx'):
            document.getElementById('xls').checked = true;
            break;
        default: setRadioOff();
    }
}

function fortaleza() {
    var contra = document.getElementById('clave');
    if (contra.value.length < 6 || /^[a-zA-Z\s]+$/.test(contra.value) || /^[\d\s]+$/.test(contra.value)) {
        contra.style.border = '5px solid red';
        document.getElementById('aviso').innerText = 'Debil';
    } else if (/^[A-Za-z0-9\s]+$/.test(contra.value)) {
        contra.style.border = '5px solid yellow';
        document.getElementById('aviso').innerText = 'Normal';
    } else {
        contra.style.border = '5px solid green';
        document.getElementById('aviso').innerText = 'Fuerte';
    }
}

function generarHash() {
    var enlace = document.getElementById('enlace');
    var cantDias = document.getElementById('dias');
    var cantDescargas = document.getElementById('descargas');
    if (cantDias.value == '' || cantDescargas.value == '') {
        enlace.value = "9007199254740991";
    } else {
        enlace.value = cantDias.value + cantDescargas.value;
    }
}

function opciones(elemento, url) {
    var divcarpeta = document.getElementById('funcioncarpeta');
    var divarchivo = document.getElementById('funcionarchivo');
    if (elemento == 'carpeta') {
        divcarpeta.style.display = 'block';
        divarchivo.style.display = 'none';
        var ubicacion = document.getElementById('ubicacion');
        ubicacion.value = url + '/';
        var ubicacionarchivo = document.getElementById('ubicacionarchivo');
        ubicacionarchivo.value = url;
    } else {
        divcarpeta.style.display = 'none';
        divarchivo.style.display = 'block';
        var ubicacionarchivo = document.getElementById('ubicacionmodarchivo');
        ubicacionarchivo.value = url;
    }
}

function redireccionar(opcion) {
    switch (opcion) {
        case ('creararchivo'):
            var carpeta = document.getElementById('ubicacionarchivo');
            window.location = "http://localhost/FAI-1513TPE/vista/contenido/armarchivo.php?" + carpeta.value + "#0";
            break;
        case ('modificararchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            window.location = "http://localhost/FAI-1513TPE/vista/contenido/armarchivo.php?" + archivo.value + "#1";
            break;
        case ('eliminararchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            window.location = "http://localhost/FAI-1513TPE/vista/contenido/eliminararchivo.php?" + archivo.value;
            break;
        case ('compartirarchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            window.location = "http://localhost/FAI-1513TPE/vista/contenido/compartirarchivo.php?";
            break;
        case ('eliminararchivocompartido'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            window.location = "http://localhost/FAI-1513TPE/vista/contenido/eliminararchivocompartido.php?" + archivo.value;
            break;
        default:
            alert('EEEEEERRRRRRROOOOOOOOOOOORRRRR');
            break;
    }
}