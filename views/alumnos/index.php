<?php
$alumnos;
//var_dump($unidades);

?>


<div class="row text-center">
    <div class="col">
        <h1>ALUMNOS</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formUsuario" class="col-lg-5 border rounded bg-light p-3">
        <!-- <input type="hidden" name="id" id="id"> -->
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <label for="nombre">CATALOGO</label>
                <input type="number" name="catalogo" id="catalogo" class="form-control" placeholder="Ingrese un catalogo" style="text-transform:uppercase">
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-12-">
                <label for="text">Nuevo Usuario</label>
                <input type="text" disabled name="persona" id="persona" class="form-control" placeholder="Grado, Nombres, Apellidos" style="text-transform:uppercase">
            </div>
        </div>
        <div class="row mb-4 mt-3">
        <div class="col-lg-12">
            <label for="select">UNIDADES</label>
            <select class="form-control" name="unidad" id="unidad">
                <option value="">Seleccione una Unidad</option>

                <?php foreach ($unidades as $unidad) : ?>

                    <option style="font-weight:bold" value="<?= $unidad['dependencia'] ?>"><?= utf8_decode($unidad['unidad']) ?></option>
                <?php endforeach ?>
            </select>
        </div>
                </div>
        <div class="row mb-4 mt-3">
        <div class="col-lg-12">
            <label for="select">SUB-UNIDADES</label>
            <select class="form-control" name="subunidad" id="subunidad">
            <option value="0">Selecccione una Sub-Unidad</option>

               
            </select>
        </div>

                </div>



        <div class="row mb-3 mt-2">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>

        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10 text-center">
        <table id="UsuariosTabla" class="table table-bordered table-hover w-100 ">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>CATALOGO</th>
                    <th>NOMBRES</th>
                    <th>SUB-UNIDAD</th>
                    <th>ACCION</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script src="build/js/usuarios/Index.js"></script>