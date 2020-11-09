<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-edit" style="font-size: 30px;"></i> Editar datos del paciente <strong>"<?php echo $datosEditarPaciente->nombrep; ?> <?php echo $datosEditarPaciente->app; ?> <?php echo $datosEditarPaciente->amp; ?>" </strong></h1>
  <p class="mb-4">Formulario para editar los datos del paciente.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el formulario.</h6> 
      <br>

      <form method="post">
  <input type="hidden" class="form-control" name="idPaciente" id="idPaciente" value="<?php echo $datosEditarPaciente->idPaciente; ?>" required>
  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Nombre:</label>
      <input type="text" class="form-control" id="nombrePaciente" placeholder="Nombre" value="<?php echo $datosEditarPaciente->nombrep; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Apellido paterno:</label>
      <input type="text" class="form-control" id="apPaciente" placeholder="Apellido paterno" value="<?php echo $datosEditarPaciente->app; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Apellido materno:</label>
      <input type="text" class="form-control" id="amPaciente" placeholder="Apellido materno" value="<?php echo $datosEditarPaciente->amp; ?>" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Fecha de nacimiento:</label>
      <input type="date" class="form-control" id="fechaNacPaciente" placeholder="Fecha de nacimiento" value="<?php echo $datosEditarPaciente->fechaNac; ?>" required> 
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Estatura:</label>
      <input type="text" class="form-control" id="estaturaPaciente" placeholder="Estatura" value="<?php echo $datosEditarPaciente->estatura; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Ocupación:</label>
      <input type="text" class="form-control" id="ocupacionPaciente" placeholder="Ocupación" value="<?php echo $datosEditarPaciente->ocupacion; ?>" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col">
      <label for="inputEmail4">*Correo:</label>
      <input type="email" class="form-control" id="correoPaciente" placeholder="Correo" value="<?php echo $datosEditarPaciente->correop; ?>" required> 
    </div>
    <div class="form-group col">
      <label for="inputPassword4">*Dirección:</label>
      <input type="text" class="form-control" id="direccionPaciente" placeholder="Dirección" value="<?php echo $datosEditarPaciente->direccionp; ?>" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Ciudad:</label>
      <input type="text" class="form-control" id="ciudadPaciente" placeholder="Ciudad" value="<?php echo $datosEditarPaciente->ciudad; ?>" required> 
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Teléfono:</label>
      <input type="text" class="form-control" id="telefonoPaciente" placeholder="Teléfono" value="<?php echo $datosEditarPaciente->telefonop; ?>" required>
    </div>
  </div>
  <div class="col-6 col-sm-12">
  <div class="col text-center">
    <button  id="editarPaciente" type="submit" class="btn btn-outline-warning btn-rounded waves-effect"><i class="fas fa-edit"></i> Actualizar información</button>
  </div>
</div>
</form>
</div>
</div>

</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





