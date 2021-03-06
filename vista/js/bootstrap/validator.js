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
        correo: {
            validators: {
                notEmpty: {
                    message: 'ingrese correo'
                },
                regexp: {
                    regexp: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/,
                    message: 'correo invalido'
                }
            },
        },
        nombre: {
            validators: {
                notEmpty: {
                    message: 'ingrese nombre'
                },
                regexp: {
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚñ\s]+$/,
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
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚñ\s]+$/,
                    message: 'apellido invalido'
                },
            },
        },
        clave: {
            validators: {
                notEmpty: {
                    message: 'Ingrese contraseña'
                },
                different: {
                    field: 'login',
                    message: 'No debe ser igual al login'
                },
                identical: {
                    field: 'clave2',
                    message: 'No coinciden'
                },
            }
        },
        clave2: {
            validators: {
                notEmpty: {
                    message: 'confirmar clave'
                },
                identical: {
                    field: 'clave',
                    message: 'No coinciden'
                },
            },
        },
    }
});
$('#recuperarCuenta').bootstrapValidator({
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
                    message: 'ingrese su login'
                },
            },
        },
        correo: {
            validators: {
                notEmpty: {
                    message: 'ingrese correo'
                },
                regexp: {
                    regexp: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/,
                    message: 'correo invalido'
                }
            },
        },
    }
});
$('#perfilCuenta').bootstrapValidator({
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
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚñ\s]+$/,
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
                    regexp: /^[a-zA-ZáéíóúAÉÍÓÚñ\s]+$/,
                    message: 'apellido invalido'
                },
            },
        },
        clave: {
            validators: {
                different: {
                    field: 'login',
                    message: 'No debe ser igual al login'
                },
                identical: {
                    field: 'clave2',
                    message: 'No coinciden'
                },
            }
        },
        clave2: {
            validators: {
                identical: {
                    field: 'clave',
                    message: 'No coinciden'
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