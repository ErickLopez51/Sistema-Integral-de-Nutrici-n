//Código para Datables

//$('#example').DataTable(); //Para inicializar datatables de la manera más simple
 
    var tablaGestorNutriologos = $('#GestorNutriologos').DataTable({
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
        "url": "?c=GestionarNutriologos&a=mostrarNutriologos",
        "type":"POST",
      },
      "columns": [
      { "data" : "nombre" },
      { "data" : "correo" },
      { "data" : "BotonVer" },
      { "data" : "BotonEditar" },
      { "data" : "BotonEliminar" }
      ]
      });   

      $(document).ready(function() {


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

  //DAR DE ALTA NUTRIOLOGO
$('#UsuarioAlta').click(function(){
  var nombreNutriologo=$("#nombreNutriologo").val();
  var apNutriologo=$("#apNutriologo").val();
  var amNutriologo=$("#amNutriologo").val();
  var correoNutriologo=$("#correoNutriologo").val();
  var direccionNutriologo=$("#direccionNutriologo").val();
  var telefonoNutriologo=$("#telefonoNutriologo").val();
 
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
   url: "?c=GestionarNutriologos&a=darDeAltaUsuario",
       data: {nombreNutriologo:nombreNutriologo, apNutriologo:apNutriologo, amNutriologo:amNutriologo, correoNutriologo:correoNutriologo, direccionNutriologo:direccionNutriologo, telefonoNutriologo:telefonoNutriologo},
         success:function(response){
 
            if (response.estado == "true") {
             $("body").overhang({
               type: "success",
               message: "Guardando información",
               duration: 1,
               callback: function() {
                 window.location.href = "?c=GestionarNutriologos&a=MainGestorNutriologos";
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
function EliminarUsuario(idUsuario)
{

    $.ajax({
    type: "POST",
  url: "?c=GestionarNutriologos&a=bajaUsuario",
      data: {idUsuario:idUsuario},
          beforeSend:function(){},
          success:function(){
 $('#GestorNutriologos').DataTable().ajax.reload();
    Swal.fire(
            '¡Hecho!',
            'El nutriologo fue dado de baja.',
            'success'
            )

        } 
      }); 
}

 function alertaBajaUsuario(idUsuario)
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
          EliminarUsuario(idUsuario);
        }
      });
}
