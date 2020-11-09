<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-heartbeat" style="font-size: 30px;"></i> Historial nutricional</h1>
  <p class="mb-4">Formulario para registar historial nutricional.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el siguiente formulario con los datos que se te piden. </h6> 
      <br>

      <form method="post">
  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Peso habitual:</label>
      <input type="text" class="form-control" id="pesohabitual" placeholder="Peso habitual" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Agua (porcentaje):</label>
      <input type="text" class="form-control" id="aguaP" placeholder="Agua (porcentaje)" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Complexión física:</label>
      <input type="text" class="form-control" id="complexionF" placeholder="Complexión física" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Peso mínimo:</label>
      <input type="text" class="form-control" id="pesoMinumo" placeholder="Peso mínimo" required> 
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Musculo (porcentaje):</label>
      <input type="text" class="form-control" id="musculoP" placeholder="Musculo (porcentaje)" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Edad metabólica:</label>
      <input type="text" class="form-control" id="edadMetabolica" placeholder="Edad metabólica" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Peso máximo:</label>
      <input type="text" class="form-control" id="pesoMaximo" placeholder="Peso máximo" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Masa ósea (Kg):</label>
      <input type="text" class="form-control" id="masaOsea" placeholder="Masa ósea (Kg)" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Cintura:</label>
      <input type="text" class="form-control" id="cintura" placeholder="Cintura" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Peso actual:</label>
      <input type="text" class="form-control" id="pesoActual" placeholder="Peso actual" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Índice de masa corporal (IMC):</label>
      <input type="text" class="form-control" id="imc" placeholder="IMC" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Cadera:</label>
      <input type="text" class="form-control" id="cadera" placeholder="Cadera" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Talla:</label>
      <input type="text" class="form-control" id="talla" placeholder="Talla" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Kg de grasa:</label>
      <input type="text" class="form-control" id="kgGrasa" placeholder="Kg de garasa" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Peso ideal:</label>
      <input type="text" class="form-control" id="pesoIdeal" placeholder="Peso ideal" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
      <label for="inputEmail4">*Grasa (porcentaje):</label>
      <input type="text" class="form-control" id="grasaP" placeholder="Grasa (porcentaje)" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Nivel de garsa visceral:</label>
      <input type="text" class="form-control" id="nivelGrasa" placeholder="Nivel de garsa visceral" required>
    </div>
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">*Peso meta (IMC):</label>
      <input type="text" class="form-control" id="pesoMeta" placeholder="Peso meta" required>
    </div>
  </div>

  <h4 class="m-0 font-weight-bold text-info">Frecuencia de alimentos</h4> 
  <br>
  <h6 class="m-0 font-weight-bold text-primary">Selecciona el grupo de alimento, ingresa la frecuencia de consumo, descripción del alimento, porción y el tipo de porción.</h6> 
  <br>

  <div class="row">
      <div class="form-group col-md-3 mb-3">
      <label for="inputEmail4">*Grupo de alimento:</label>
        <select name="Grupo de alimento" id="grupoAlimento" class="form-control" >
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

    <div class="form-group col-auto ">
    <label for="inputPassword4">*Frecuencia:</label>
      <div class="input-group mb-1">
        <input type="number" min="0" max="100" class="form-control" id="frecuencia" >
        <div class="input-group-prepend">
          <div class="input-group-text"> / 7</div>
        </div>
      </div>
    </div>

    <div class="form-group col-md-2">
    <label for="inputPassword4">*Porción:</label>
      <input type="text" class="form-control" id="porcion" placeholder="Porción" >
    </div>

    <div class="form-group col-md-2">
    <label for="inputPassword4">*Tipo de porción:</label>
        <select name="Tipo de porción" id="tipoPorcion" class="form-control" >
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

    <div class="form-group col">
    <label for="inputPassword4">*Alimento:</label>
      <input type="text" class="form-control" id="alimento" placeholder="Alimento" >
    </div>


  </div>

  <div class="col text-center">
  <button  id="agregarAlimento" type="button" class="btn btn-primary"> Agregar</button>
                   </div>
                   <br>

  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tablaHistorial" width="100%" cellspacing="0">
          <thead>
            <tr>
           <th>Grupo de alimento</th>
           <th>Frecuencia</th>
           <th>Alimento</th>
           <th>Eliminar</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
           <th>Grupo de alimento</th>
           <th>Frecuencia</th>
           <th>Alimento</th>
           <th>Eliminar</th>
            </tr>
          </tfoot>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>



  <div class="col-6 col-sm-12">
  <div class="col text-center">
  <button  id="guardarHistorial" type="submit" class="btn btn-outline-primary btn-rounded waves-effect">Guardar</button>
  </div>
</div>
</form>
</div>
</div>
</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





