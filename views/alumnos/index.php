<h1 class="text-center">Formulario de Alumnos</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioAlumnos">
        <input type="Hidden" name="alumno_id" id="alumno_id">
        <div class="row mb-3">
            <div class="col">
                <label for="alumno_nombre">Nombre del Oficial </label>
                <input type="text" name="alumno_nombre" id="alumno_nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alumno_apellido">Apellido del Oficial </label>
                <input type="text" name="alumno_apellido" id="alumno_apellido" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alumno_nacionalidad">Nacionalidad del Oficial </label>
                <input type="text" name="alumno_nacionalidad" id="alumno_nacionalidad" class="form-control">
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-12">
                <label for="select">Grados</label>
                <select class="form-control" name="alumno_grado_id" id="alumno_grado_id">


                    <option value="">Seleccione el grado de oficialidad</option>
                    <?php foreach ($grados as $grado) { ?>
                        <option value="<?= $grado['grado_id']  ?>"><?= $grado['grado_nombre']  ?></option>
                    <?php  }  ?>
                </select>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-12">
                <label for="select">Armas</label>
                <select class="form-control" name="alumno_arma_id" id="alumno_arma_id">
                    <option value="">Seleccione un Arma/Servicio</option>

                    <?php foreach ($armas as $arma) { ?>
                        <option value="<?= $arma['arma_id']  ?>"><?= $arma['arma_nombre']  ?></option>
                    <?php  }  ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioAlumnos" id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
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
        <table class="table table-bordered table-hover" id="tablaAlumnos">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>GRADO</th>
                    <th>ARMA</th>
                    <th>NACIONALIDAD</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/alumnos/index.js')  ?>"></script>