function mostrarClave(pass) {
    var cambio = document.getElementById(pass);
    if (cambio.type == "password") {
        cambio.type = "text";
        $('#ojo').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('#ojo').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

function sugerirExtension(param) {
    if (param == '0') {
        var archivo = document.getElementById('archivo').value;
        var nombre = document.getElementById('nombre');
        nombre.value = archivo.split('\\').pop();
    } else {
        var nombre = document.getElementById('nombre');
    }
    var extension = nombre.value.split('.').pop();
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
        default:
            setRadioOff();
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
        enlace.value = btoa('9007199254740991' + new Date().getTime());
    } else {
        enlace.value = btoa(cantDias.value + cantDescargas.value + new Date().getTime());
    }
}

function opciones(elemento, url, identificador) {
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
        var ide = document.getElementById('idarchivo');
        ide.value = identificador;
    }
}

function redireccionar(opcion) {
    switch (opcion) {
        case ('creararchivo'):
            var carpeta = document.getElementById('ubicacionarchivo');
            window.location = "armarchivo.php?" + carpeta.value + "#0";
            break;
        case ('modificararchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "armarchivo.php?id=" + identificador.value + "&" + archivo.value + "#1";
            break;
        case ('eliminararchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "eliminararchivo.php?id=" + identificador.value + "&" + archivo.value;
            break;
        case ('compartirarchivo'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "compartirarchivo.php?id=" + identificador.value + "&" + archivo.value;
            break;
        case ('eliminararchivocompartido'):
            var archivo = document.getElementById('ubicacionmodarchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "eliminararchivocompartido.php?id=" + identificador.value + "&" + archivo.value;
            break;
        default:
            alert('EEEEEERRRRRRROOOOOOOOOOOORRRRR');
            break;
    }
}

function encriptarPass(param) {
    var contra = document.getElementById(param);
    var ocultar = btoa(contra.value);
    contra.value = ocultar;
}

function copiarLink() {
    var enlace = document.getElementById('link');
    var inputDeCopiado = document.createElement('input');
    inputDeCopiado.setAttribute("value", enlace.value);
    document.body.appendChild(inputDeCopiado);
    inputDeCopiado.select(enlace.value);
    document.execCommand('copy');
    document.body.removeChild(inputDeCopiado);
    alert('copiado');
}

function compararContra() {
    var priCon = document.getElementById('clave');
    var segCon = document.getElementById('clave2');
    var res = priCon.value == segCon.value;
    if (!res) {
        var avisar = document.getElementById('aviso');
        avisar.innerHTML = 'No coinciden';
    }
    return res;
}