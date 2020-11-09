<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-edit" style="font-size: 30px;"></i> Editar datos del plan de alimentación <strong>"<?php echo $datosEditarPlan->nombrePlan; ?>" </strong></h1>
  <p class="mb-4">Formulario para editar los datos del plan de nutrición.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el formulario.</h6> 
      <br>
      <form method="post">
  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Nombre del plan de alimentación:</label>
      <input type="text" class="form-control" id="nombrePlan" placeholder="Nombre" value="<?php echo $datosEditarPlan->nombrePlan; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Kcal totales:</label>
      <input type="text" class="form-control" id="kcaltotal" placeholder="Kcal totales" value="<?php echo $datosEditarPlan->kcalTotales; ?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*HC:</label>
      <input type="text" class="form-control" id="hc" placeholder="HC" value="<?php echo $datosEditarPlan->hidratosCarbono; ?>" required>
    </div>
  </div>
  <h6 class="m-0 font-weight-bold text-primary">Selecciona el horario de comidas.</h6> 
  <br>
  <div class="form-row">
    <div class="form-group col">
      <label for="inputEmail4">*Desayuno:</label>
      <input type="time" class="form-control" id="hdesayuno" placeholder="Desayuno" value="<?php echo $datosEditarPlan->hDesayuno; ?>" required>
    </div>
    <div class="form-group col">
      <label for="inputPassword4">*Colación 1:</label>
      <input type="time" class="form-control" id="hcolacion1" placeholder="Colación" value="<?php echo $datosEditarPlan->hColacion1; ?>" required>
    </div>
    <div class="form-group col">
      <label for="inputPassword4">*Comida:</label>
      <input type="time" class="form-control" id="hcomida" placeholder="Comida" value="<?php echo $datosEditarPlan->hComida; ?>" required>
    </div>
    <div class="form-group col">
      <label for="inputPassword4">*Colación 2:</label>
      <input type="time" class="form-control" id="hcolacion2" placeholder="Colación" value="<?php echo $datosEditarPlan->hColacion2; ?>" required>
    </div>
    <div class="form-group col">
      <label for="inputPassword4">*Cena:</label>
      <input type="time" class="form-control" id="hcena" placeholder="Cena" value="<?php echo $datosEditarPlan->hCena; ?>" required>
    </div>
  </div>

  <h6 class="m-0 font-weight-bold text-primary">Selecciona el grupo de alimento, ingresa la frecuencia de consumo, descripción del alimento, porción y el tipo de porción.</h6> 
  <br>

  <div class="row">
  <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Día:</label>
        <select name="Grupo de alimento" id="diaPlan" class="form-control" >
            <option value="0" name="todos">Selecciona...</option>
           <option value="Lunes" name="Lunes">Lunes </option>
           <option value="Martes" name="Martes">Martes </option>
           <option value="Miércoles" name="Miércoles">Miércoles </option>
           <option value="Jueves" name="Jueves">Jueves </option>
           <option value="Viernes" name="Viernes">Viernes</option>
           <option value="Sabado" name="Sabado">Sabado </option>
           <option value="Domingo" name="Domingo a">Domingo  </option>
      </select>
    </div>

  <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Tipo de comida:</label>
        <select name="Grupo de alimento" id="tipoComidaPlan" class="form-control" >
            <option value="0" name="todos">Selecciona...</option>
           <option value="Desayuno" name="Desayuno">Desayuno </option>
           <option value="Colación 1" name="Colación 1">Colación 1 </option>
           <option value="Comida" name="Comida">Comida </option>
           <option value="Colación 2" name="Colación">Colación 2</option>
           <option value="Cena" name="Cena">Cena</option>
      </select>
    </div>

      <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Grupo de alimento:</label>
        <select name="Grupo de alimento" id="grupoAlimentoPlan" class="form-control" >
            <option value="0" name="todos">Selecciona...</option>
           <option value="Verduras" name="Verduras">Verduras </option>
           <option value="Frutas" name="Frutas">Frutas </option>
           <option value="Cereales" name="Cereales">Cereales </option>
           <option value="Leguminosas" name="Leguminosas">Leguminosas </option>
           <option value="Alimentos de origen animal" name="Alimentos de origen animal">Alimentos de origen animal</option>
           <option value="Leche" name="Leche">Leche </option>
           <option value="Grasas a" name="Grasas a">Grasas a </option>
           <option value="Grasas b" name="Grasas b">Grasas b </option>
           <option value="Azúcares" name="Azúcares">Azúcares </option>
      </select>
    </div>

    <div class="form-group col-md-4 mb-3">
    <label for="inputPassword4">*Porción:</label>
      <input type="text" class="form-control" id="porcionPlan" placeholder="Porción" >
    </div>

    <div class="form-group col-md-4 mb-3">
    <label for="inputPassword4">*Tipo de porción:</label>
        <select name="Tipo de porción" id="tipoPorcionplan" class="form-control" >
            <option value="0" name="todos">Selecciona...</option>
            <option value="Ninguna" name="Ninguna">Ninguna</option>
           <option value="Rebanadas" name="Rebanadas">Rebanadas</option>
           <option value="Tazas" name="Tazas">Tazas</option>
           <option value="Gramos" name="Gramos">Gramos</option>
           <option value="Miligramos" name="Miligramos">Miligramos</option>
           <option value="Vasos" name="Vasos">Vasos</option>
           <option value="Piezas" name="Piezas">Piezas</option>
           <option value="Cucharadas" name="Cucharadas">Cucharadas</option>
           <option value="Cucharaditas" name="Cucharaditas">Cucharaditas</option>
      </select>
    </div>

    <div class="form-groupcol-md-2 col-md-4 mb-3">
    <label for="inputPassword4">*Alimento:</label>
      <input type="text" class="form-control" id="alimentoPlan" placeholder="Alimento" >
    </div>
  </div>

  <div class="col text-center">
  <button  id="agregarAlimentoPlan" type="button" class="btn btn-primary"> Agregar alimento</button>
  </div> 
  <br>

  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tablaAlimentosPlan" width="100%" cellspacing="0">
          <thead>
            <tr>
           <th>Día</th>
           <th>Tipo de comida</th>
           <th>Grupo de alimento</th>
           <th>Alimento</th>
           <th>Eliminar</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
           <th>Día</th>
           <th>Tipo de comida</th>
           <th>Grupo de alimento</th>
           <th>Alimento</th>
           <th>Eliminar</th>
            </tr>
          </tfoot>
          <tbody>
          <?php 
        foreach ($editarAlimentosPlan as $row) {?>
          <tr>
            <td><?php echo $row['diaComida'];?></td>

            <td><?php echo $row['tipoComida'];?></td>

            <td><?php echo $row['planCategoria'];?></td>
            
            <td><?php echo $row['planPorcion'];?> <?php echo $row['planTipoPorcion'];?> <?php echo $row['planDescripcion']; ?></td>

            <td><div class='col text-center'><button id="<?php echo $row['idPlanComida'] ?>" title='Eliminar usuario al grupo' class='eliminarEditar btn btn-danger btn-circle'><i class='fas fa-trash'></i></button></div></td>

          </tr>
        <?php } 
        ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-6 col-sm-12">
  <div class="col text-center">
  <button  id="editarPlan" type="submit" class="btn btn-outline-warning btn-rounded waves-effect"><i class="fas fa-edit"></i> Actualizar información</button>
  </div>
</div>
</form>
</div>
</div>

</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





