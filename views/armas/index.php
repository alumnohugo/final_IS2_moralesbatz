<h1 class="text-center">Formulario de grados</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioArmas">
        <input type="Hidden" name="arma_id" id="arma_id">
        <div class="row mb-3">
            <div class="col">
                <label for="arma_nombre">Arma/Servicio del Oficial </label>
                <input type="text" name="arma_nombre" id="arma_nombre" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioArmas" id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-8">
        <h2>Listado de Armas/Servicios</h2>
        <table class="table table-bordered table-hover" id="tablaArmas">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>GRADO</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/armas/index.js')  ?>"></script>