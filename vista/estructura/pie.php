<div class="col-12 bg-dark text-white text-center border border-dark shadow" id="pie" name="pie">
    <h2>Este es el pie</h2>
</div>

</div>
<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#descripcion'), {
            initialData: 'Esta es una descripción genérica, si lo necesita la puede cambiar.'
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script src="/FAI-1513TPE/vista/js/jquery-3.5.1.slim.min.js"></script>
<script src="/FAI-1513TPE/vista/js/popper.min.js"></script>
<script src="/FAI-1513TPE/vista/js/bootstrap/bootstrap.min.js"></script>
<script src="/FAI-1513TPE/vista/js/bootstrap/bootstrapValidator.min.js"></script>
<script src="/FAI-1513TPE/vista/js/bootstrap/validator.js"></script>
<script src="/FAI-1513TPE/vista/js/funciones.js"></script>

</body>

</html>