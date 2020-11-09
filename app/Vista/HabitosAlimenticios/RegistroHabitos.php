<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-child" style="font-size: 30px;"></i> Hábitos alimenticios</h1>
  <p class="mb-4">Formulario para registar los hábitos alimenticios.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el siguiente formulario con los datos que se te piden. </h6> 
      <br>

      <form method="post">
  <div class="form-row justify-content-center">
    <div class="form-group col-md-2 mb-3">
      <label for="inputEmail4">*Hora de levantarse:</label>
      <input type="time" class="form-control" id="hLevantarse" placeholder="Hora de levantarse" required>
    </div>
    <div class="form-group col-md-2 mb-3">
      <label for="inputPassword4">*Hora de dormir:</label>
      <input type="time" class="form-control" id="hDormir" placeholder="Hora de dormir" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3 mb-3">
      <label for="inputEmail4">*¿Cuántas comidas realizas al día?</label>
      <input type="text" class="form-control" id="comidasDia" required>
    </div>
    <div class="form-group col-md-5 mb-3">
      <label for="inputPassword4">*¿Acostumbra a comer a la misma hora diariamente?</label>
      <input type="text" class="form-control" id="hDiariamente" placeholder="Si / No" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*¿Acostumbra "saltarse" comidas?</label>
      <input type="text" class="form-control" id="saltarComida" placeholder="Si / No" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*¿Acostumbra comer entre comidas?</label>
      <input type="text" class="form-control" id="comerEntreComidas" placeholder="Si / No" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">¿Qué tipos de alimentos?</label>
      <input type="text" class="form-control" id="tipoAlimentos">
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Alimentos que le ocasionen malestar:</label>
      <input type="text" class="form-control" id="alimentosMalestar" required>
    </div>
  </div>


  <div class="col-6 col-sm-12">
  <div class="col text-center">
  <button  id="guardarHabitos" type="submit" class="btn btn-outline-primary btn-rounded waves-effect">Guardar</button>
  </div>
</div>
</form>
</div>
</div>
</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





