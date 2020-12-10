/*
 * Pasamos ID del campo clave como parametro para ocultar o mostrar la contraseña
 */
function mostrarClave(pass) {
    var cambio = document.getElementById(pass);
    if (cambio.type == "password") {
        //si esta oculta mostramos la contraseña
        cambio.type = "text";
        $('#ojo').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        //si no esta oculta, la ocultamos
        cambio.type = "password";
        $('#ojo').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

/*
 * como parametro es 0 o 1 para saber si leer el archivo o el campo nombre para el archivo
 * dependiendo el caso se lee el nombre del archivo y se sugiere la extencion
 */
function sugerirExtension(param) {
    if (param == '0') {
        //en este caso sacamos el nombre del archivo subido y le damos valor a la extension
        var archivo = document.getElementById('archivo').value;
        var nombre = document.getElementById('nombre');
        nombre.value = archivo.split('\\').pop();
    } else {
        //sino le damos valor a traves del campo nombre, este caso ya el archivo esta en BD
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

/**
 * esta funcion se encarga de saber la fortaleza de la clave ingresada
 */
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

/**
 * Se encarga de generar un hash para cada archivo que sera compartido
 */
function generarHash() {
    //realizamos un hash con los milisegundos captados con dategettime
    var enlace = document.getElementById('enlace');
    var cantDias = document.getElementById('dias');
    var cantDescargas = document.getElementById('descargas');
    if (cantDias.value == '' || cantDescargas.value == '') {
        enlace.value = btoa('9007199254740991' + new Date().getTime());
    } else {
        enlace.value = btoa(cantDias.value + cantDescargas.value + new Date().getTime());
    }
}

/**
 * la funcion se encarga de mostrar los div dependiendo del archivo o carpeta
 * elemento nos dice si es una carpeta o es un archivo a realizar una accion
 * url es la url de la nueva carpeta o es el nombre del archivo seleccionado
 * y por ultimo el ID del archivo 
 */
function opciones(elemento, url, identificador) {
    var divcarpeta = document.getElementById('funcioncarpeta');
    var divarchivo = document.getElementById('funcionarchivo');
    if (elemento == 'carpeta') {
        divcarpeta.style.display = 'block';
        divarchivo.style.display = 'none';
        var ubicacion = document.getElementById('ubicacion');
        ubicacion.value = url + '/';
        var nombreArchivo = document.getElementById('ubicacionarchivo');
        nombreArchivo.value = url;
    } else {
        divcarpeta.style.display = 'none';
        divarchivo.style.display = 'block';
        var nombreArchivo = document.getElementById('nombreArchivo');
        nombreArchivo.value = url;
        var ide = document.getElementById('idarchivo');
        ide.value = identificador;
    }
}

/**
 * la funcion se encarga de direccionar segun la accion del archivo
 * y dejar los datos necesarios en la url
 * la accion es ingresada por parametro
 */
function redireccionar(opcion) {
    switch (opcion) {
        case ('creararchivo'):
            var carpeta = document.getElementById('ubicacionarchivo');
            window.location = "armarchivo.php?" + carpeta.value + "#0";
            break;
        case ('modificararchivo'):
            var archivo = document.getElementById('nombreArchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "armarchivo.php?id=" + identificador.value + "&" + archivo.value + "#1";
            break;
        case ('eliminararchivo'):
            var archivo = document.getElementById('nombreArchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "eliminararchivo.php?id=" + identificador.value + "&" + archivo.value;
            break;
        case ('compartirarchivo'):
            var archivo = document.getElementById('nombreArchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "compartirarchivo.php?id=" + identificador.value + "&" + archivo.value;
            break;
        case ('eliminararchivocompartido'):
            var archivo = document.getElementById('nombreArchivo');
            var identificador = document.getElementById('idarchivo');
            window.location = "eliminararchivocompartido.php?id=" + identificador.value + "&" + archivo.value;
            break;
        default:
            alert('EEEEEERRRRRRROOOOOOOOOOOORRRRR');
            break;
    }
}


/**
 * Le permitimos al usuario que copie lo que hay en id=link
 */
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

/**
 * verifica que las 2 claves coincidan y de ser asi se encriptan sino solo devuelve falso
 */
function compararContra() {
    //utilzado al crear la contraseña o modificar la contraseña
    var priCon = document.getElementById('clave');
    var segCon = document.getElementById('clave2');
    var res = priCon.value == segCon.value;
    if (res && segCon != '') {
        encriptarPass('clave');
        encriptarPass('clave2');
    } else {
        var avisar = document.getElementById('aviso');
        avisar.innerHTML = 'No coinciden';
    }
    return res;
}


function encriptarPass(param) {
    //solo utilizado para ingresar a la cuenta
    var contra = document.getElementById(param);
    var ocultar = btoa(contra.value);
    contra.value = ocultar;
    return true;
}