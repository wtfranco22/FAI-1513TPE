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
