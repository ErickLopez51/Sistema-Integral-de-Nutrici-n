<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-edit" style="font-size: 30px;"></i> Editar datos del nutriologo <strong>"<?php echo $datosEditarNutriologo->nombre; ?> <?php echo $datosEditarNutriologo->ap; ?> <?php echo $datosEditarNutriologo->am; ?>" </strong></h1>
  <p class="mb-4">Formulario para editar los datos del nutriólogo.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el formulario.</h6> 
      <br>

      <form method="post">
  <input type="hidden" class="form-control" name="idUsuario" id="idUsuario" value="<?php echo $datosEditarNutriologo->idUsuario; ?>" required>
  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Nombre:</label>
      <input type="text" class="form-control" id="nombreNutriologo" placeholder="Nombre" value="<?php echo $datosEditarNutriologo->nombre; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Apellido paterno:</label>
      <input type="text" class="form-control" id="apNutriologo" placeholder="Apellido paterno" value="<?php echo $datosEditarNutriologo->ap; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Apellido materno:</label>
      <input type="text" class="form-control" id="amNutriologo" placeholder="Apellido materno" value="<?php echo $datosEditarNutriologo->am; ?>" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Correo:</label>
      <input type="email" class="form-control" id="correoNutriologo" placeholder="Correo" value="<?php echo $datosEditarNutriologo->correo; ?>" required> 
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Dirección:</label>
      <input type="text" class="form-control" id="direccionNutriologo" placeholder="Dirección" value="<?php echo $datosEditarNutriologo->direccion; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Teléfono:</label>
      <input type="text" class="form-control" id="telefonoNutriologo" placeholder="Teléfono" value="<?php echo $datosEditarNutriologo->telefono; ?>" required>
    </div>
  </div>
  <div class="col-6 col-sm-12">
  <div class="col text-center">
    <button  id="editarUsuario" type="submit" class="btn btn-outline-warning btn-rounded waves-effect"><i class="fas fa-edit"></i> Actualizar información</button>
  </div>
</div>
</form>
</div>
</div>

</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





