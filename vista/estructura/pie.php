</div>
</div>
</div>

<div class="bg-dark text-white text-center border border-dark" id="pie" name="pie">
    <h3>Este es el pie</h3>
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

<script src="../../js/jquery-3.5.1.slim.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap/bootstrap.min.js"></script>
<script src="../../js/bootstrap/bootstrapValidator.min.js"></script>
<script src="../../js/bootstrap/validator.js"></script>
<script src="../../js/funciones.js"></script>

</body>

</html>