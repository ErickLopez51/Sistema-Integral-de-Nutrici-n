//ARREGLO DE ALIMENTOS
var arrayAlimentosPlan=[];

      $(document).ready(function() {

        //INICIALIZAR DATATABLE PRINCIPAL, PLANES DE ALIMENTOS REGISTRADOS
    var tablaPlan = $('#tablaPlan').DataTable({
      "order": [[ 0, "desc" ]],
      "ordering": false,
    //para cambiar el lenguaje a español
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast":"Último",
          "sNext":"Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing":"Procesando...",
      },
      "ajax": {
        "url": "?c=PlanesdeAlimentacion&a=mostrarPlanes",
        "type":"POST",
      },
      "columns": [
      { "data" : "nombrePlan" },
      { "data" : "BotonVer" },
      { "data" : "BotonEditar" },
      { "data" : "BotonEliminar" }
      ]
      });  

         //DEFINIR TABLA DE ALIMENTOS DE LOS PLANES DE ALIMENTACIÓN
  var tablaAlimentosPlan = $('#tablaAlimentosPlan').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            }
    });   

    //CONTADOR
var counter = 0;

//AGREGAR ALIMENTO A TABLA
$('#agregarAlimentoPlan').click(function(){
var diaPlan = $('#diaPlan').val();
var tipoComidaPlan = $('#tipoComidaPlan').val();
var grupoAlimentoPlan = $('#grupoAlimentoPlan').val();
var porcionPlan = $('#porcionPlan').val();
var tipoPorcionplan = $('#tipoPorcionplan').val();
var alimentoPlan = $('#alimentoPlan').val();

var  tablaAlimento =  porcionPlan +' '+ tipoPorcionplan +' de '+ alimentoPlan;
var  botonEliminar = "<div class='col text-center'><button id='"+counter+"' title='Eliminar Alimento' class='eliminar btn btn-danger btn-circle'><i class='fas fa-trash'></i></button></div>";

if(diaPlan == '' || tipoComidaPlan ==  '' || grupoAlimentoPlan ==  '' || porcionPlan ==  '' || tipoPorcionplan ==  '' || alimentoPlan ==  '' )
{
  $("body").overhang({
    type: "error",
    message: "Campos vacíos",
    duration: 1,
  });
}
else
{

  var alimentoPlan = {
    diaPlan: diaPlan,
    tipoComidaPlan: tipoComidaPlan,
    grupoAlimentoPlan: grupoAlimentoPlan,
    porcionPlan: porcionPlan,
    tipoPorcionplan: tipoPorcionplan,
    alimentoPlan: alimentoPlan
};
arrayAlimentosPlan.push(alimentoPlan);
tablaAlimentosPlan.row.add( [
  diaPlan,
  tipoComidaPlan,
  grupoAlimentoPlan,
  tablaAlimento,
  botonEliminar
] ).draw( false );

counter++;

$("#diaPlan").val('0');
$("#tipoComidaPlan").val('0');
$("#grupoAlimentoPlan").val('0');
$("#porcionPlan").val('');
$("#tipoPorcionplan").val('0'); 
$("#alimentoPlan").val(''); 
}
});


//ELIMINAR ALIMENTO DE LA TABLA
$('#tablaAlimentosPlan tbody').on("click", "button.eliminar",function(){
  var idAgregado =$(this).attr("id");
  var indice=$(this).closest('td').parent()[0].sectionRowIndex;
  tablaAlimentosPlan.row(':eq('+indice+')').remove().draw();
  delete arrayAlimentosPlan[idAgregado];

  for(var i = 0; i < arrayAlimentosPlan.length; i++){
    if(arrayAlimentosPlan[i] === undefined){
      arrayAlimentosPlan.splice(i , 1);
    }
}
});

//GUARDAR PLAN DE NUTRICIÓN
$('#guardarPlan').click(function(){
  var nombrePlan=$("#nombrePlan").val();
  var kcaltotal=$("#kcaltotal").val();
  var hc=$("#hc").val();
  var hdesayuno=$("#hdesayuno").val();
  var hcolacion1=$("#hcolacion1").val();
  var hcomida=$("#hcomida").val();
  var hcolacion2=$("#hcolacion2").val();
  var hcena=$("#hcena").val();

  if (nombrePlan == ' ' ||  kcaltotal == '' || hc == '' || 
  hdesayuno == '' || hcolacion1 == '' || hcomida == '' || 
  hcolacion2 == '' || hcena == '')
  {
     $("body").overhang({
               type: "error",
               duration: 1,
               message: "Campos vacios"
             });
      return false;
  }
  else
  {
 
    $.ajax({
     type: "POST",
   url: "?c=PlanesdeAlimentacion&a=guardarPlan",
       data: {nombrePlan:nombrePlan, kcaltotal:kcaltotal, hc:hc, 
        hdesayuno:hdesayuno, hcolacion1:hcolacion1, hcomida:hcomida, 
        hcolacion2:hcolacion2, hcena:hcena, 'arrayAlimentosPlan': JSON.stringify(arrayAlimentosPlan) },
         success:function(response){
 
            if (response.estado == "true") {
             $("body").overhang({
               type: "success",
               message: "Guardando información",
               duration: 1,
               callback: function() {
                 window.location.href = "?c=PlanesdeAlimentacion&a=MainPlanAlimentacion";
               }
             });
           } else {
             $("body").overhang({
               type: "error",
               duration: 1,
               message: "Error al guardar información"
             });
           }  
 
         }
       });
 
      return false;
   }
 });





        //BOTON PARA VER INFORMACION DEL NUTRIOLOGO
      $('#GestorNutriologos tbody').on("click", "button.Verinfo",function(){
        var idBotonVer =$(this).attr("id");
      
       //LLENAR CAMPOS DE TEXTO CON LA INFORMACION DE PERFIL 
       $.ajax({
         type: "POST",
         url: "?c=GestionarNutriologos&a=datosDeUsuario",
         data: {idBotonVer:idBotonVer},
         success:function(data){
      
           var data = JSON.parse(data);
      
           for (var i = data.length - 1; i >= 0; i--) {
            $("#nombreNutriologoGestor").val(data[i].nombre);
            $("#correoNutriologoGestor").val(data[i].correo);
            $("#direccionNutriologoGestor").val(data[i].direccion);
            $("#telefonoNutriologoGestor").val(data[i].telefono);
          }  
      
      
        }
      
      });
      });
      
      
  //EDITAR NUTRIOLOGO
$("#editarUsuario").click(function(){
 var idUsuario = $('#idUsuario').val().trim();
 var nombreNutriologo=$("#nombreNutriologo").val().trim();
 var apNutriologo=$("#apNutriologo").val().trim();
 var amNutriologo=$("#amNutriologo").val().trim();
 var correoNutriologo=$("#correoNutriologo").val().trim();
 var direccionNutriologo=$("#direccionNutriologo").val().trim();
 var telefonoNutriologo=$("#telefonoNutriologo").val().trim();

 if (nombreNutriologo == ' ' ||  apNutriologo == '' || amNutriologo == '' || correoNutriologo == '' || direccionNutriologo == '' || telefonoNutriologo == '')
 {
    $("body").overhang({
              type: "error",
              duration: 1,
              message: "Campos vacios"
            });
     return false;
 }
 else
 {

  $.ajax({
    type: "POST",
    url: "?c=GestionarNutriologos&a=ActualizarNutriologo",
          data: {idUsuario:idUsuario, nombreNutriologo:nombreNutriologo, apNutriologo:apNutriologo, amNutriologo:amNutriologo, correoNutriologo:correoNutriologo, direccionNutriologo:direccionNutriologo, telefonoNutriologo:telefonoNutriologo},//capturo array 
          success:function(response){

           if (response.estado == "true") {
            $("body").overhang({
              type: "success",
              message: "Actualizando información",
              duration: 1,
              callback: function() {           
                window.location.href = "?c=GestionarNutriologos&a=MainGestorNutriologos";
              }
            });
          } else {
            $("body").overhang({
              type: "error",
              duration: 1,
              message: "Error al actualizar información"
            });
          }  

        }

      });
  return false;  
 }
});

});


//DAR DE BAJA A NUTRIOLOGO
function EliminarPlan(idPlanAlimentacion)
{

    $.ajax({
    type: "POST",
  url: "?c=PlanesdeAlimentacion&a=bajaPlan",
      data: {idPlanAlimentacion:idPlanAlimentacion},
          beforeSend:function(){},
          success:function(){
 $('#tablaPlan').DataTable().ajax.reload();
    Swal.fire(
            '¡Hecho!',
            'El plan de nutrición fue dado de baja.',
            'success'
            )

        } 
      }); 
}

 function alertaBajaPlan(idPlanAlimentacion)
{
      Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
         cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, ¡Dar de baja!'
      }).then((result) => {
        if (result.value) {
          EliminarPlan(idPlanAlimentacion);
        }
      });
}
