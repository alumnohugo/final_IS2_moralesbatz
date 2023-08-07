<h1 class="text-center">Formulario de Calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioCalificaciones">
        <input type="text" name="calificacion_id" id="calificacion_id">
        <div class="row mb-4 mt-3">
            <div class="col-lg-12">
                <label for="select">Alumnos  </label>
                <select class="form-control" name="calificacion_asignacion" id="calificacion_asignacion">
                    <option value="">Seleccione una asignación </option>
                    <?php foreach ($asignaciones as $asignacion) { ?>
                        <option value="<?= $asignacion['asig_id'] ?>">
                            <?= $asignacion['alumno_nombre'] ?> 
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-12">
                <label for="select">Materias </label>
                <select class="form-control" name="calificacion_asignacion" id="calificacion_asignacion">
                    <option value="">Seleccione una asignación </option>
                    <?php foreach ($asignaciones as $asignacion) { ?>
                        <option value="<?= $asignacion['asig_id'] ?>">
                            <?= $asignacion['materia_asignada'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="calificacion_punteo">Punteo</label>
                <input type="text" name="calificacion_punteo" id="calificacion_punteo" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="calificacion_resultado">Resultado</label>
                <input type="text" name="calificacion_resultado" id="calificacion_resultado" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioCalificaciones" id="btnGuardar" data-saludo="hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
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
        <h2>Listado de calificaciones</h2>
        <table class="table table-bordered table-hover" id="tablaCalificaciones">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>ALUMNO</th>
                    <th>MATERIA</th>
                    <th>PUNTEO</th>
                    <th>RESULTADO</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/calificaciones/index.js')  ?>"></script>