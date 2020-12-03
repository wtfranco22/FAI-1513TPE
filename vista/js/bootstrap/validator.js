$('#ingresarCuenta').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        usuario: {
            validators: {
                notEmpty: {
                    message: 'ingrese su login'
                },
            },
        },
        clave: {
            validators: {
                notEmpty: {
                    message: 'ingrese su contraseña'
                },
            },
        },
    }
});

$('#crearCuenta').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        login: {
            validators: {
                notEmpty: {
                    message: 'ingrese login'
                },
            },
        },
        nombre: {
            validators: {
                notEmpty: {
                    message: 'ingrese nombre'
                },
                regexp: {
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚ]+$/,
                    message: 'nombre invalido'
                },
            },
        },
        apellido: {
            validators: {
                notEmpty: {
                    message: 'ingrese apellido'
                },
                regexp: {
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚ]+$/,
                    message: 'apellido invalido'
                },
            },
        },
        clave: {
            validators: {
                notEmpty: {
                    message: 'ingrese clave'
                },
            },
        },
        clave2: {
            validators: {
                notEmpty: {
                    message: 'confirmar clave'
                },
            },
        },
    }
});
$('#crearCuenta').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        login: {
            validators: {
                notEmpty: {
                    message: 'ingrese login'
                },
            },
        },
        nombre: {
            validators: {
                notEmpty: {
                    message: 'ingrese nombre'
                },
                regexp: {
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚ]+$/,
                    message: 'nombre invalido'
                },
            },
        },
        apellido: {
            validators: {
                notEmpty: {
                    message: 'ingrese apellido'
                },
                regexp: {
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚ]+$/,
                    message: 'apellido invalido'
                },
            },
        },
    }
});
$('#armarchivo').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Debe contener un nombre el archivo'
                },
            },
        },
        descripcion: {
            validators: {
                notEmpty: {
                    message: 'Debe tener una descripción',
                },
            },
        },
        usuario: {
            validators: {
                notEmpty: {
                    message: 'Debe elegir el usuario',
                },
            },
        },
        tipo: {
            validators: {
                notEmpty: {
                    message: 'Debe elegir el tipo de archivo',
                },
            },
        },
    }
});
$('#compartirarchivo').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        archivo: {
            validators: {
                notEmpty: {
                    message: 'Debe elegir un archivo'
                },
                file: {
                    maxSize: 20971520,
                    message: 'archivo demasiado grande, Max 20MB'
                },
            },
        },
        usuario: {
            validators: {
                notEmpty: {
                    message: 'Debe elegir el usuario',
                },
            },
        },
    }
});
$('#eliminararchivocompartido').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Debe contener un nombre el archivo'
                },

            },
        },
        motivo: {
            validators: {
                notEmpty: {
                    message: 'Debe escribir el motivo',
                },
            },
        },
        usuario: {
            validators: {
                notEmpty: {
                    message: 'Debe seleccionar el usuario',
                },
            },
        },
    },
});
$('#eliminararchivo').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-thumbs-down',
        validating: 'fa fa-thumbs-down'
    },
    fields: {
        nombre: {
            validators: {
                notEmpty: {
                    message: 'Debe contener un nombre el archivo'
                },
            },
        },
        motivo: {
            validators: {
                notEmpty: {
                    message: 'Debe escribir el motivo',
                },
            },
        },
        usuario: {
            validators: {
                notEmpty: {
                    message: 'Debe seleccionar el usuario',
                },
            },
        },
    },
});