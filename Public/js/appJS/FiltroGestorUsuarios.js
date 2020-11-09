
$(document).ready(function() {


   function llenar_tablaGestorUsuarios(idArea = '', idSubarea = '')
 {

  $('#GestorUsuarios').DataTable({
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
    "url": "?c=GestionarUsuarios&a=FiltroGestorUsuario",
    "type":"POST",
    "data": {
      idArea:idArea, idSubarea:idSubarea
    },
  },
  "columns": [
  { "data" : "nombre" },
  { "data" : "correo" },
  { "data" : "BotonVer" },
  { "data" : "BotonEditar" },
  { "data" : "BotonEliminar" }
  ]
});


}

$('#FiltroGestorUsuario').click(function(){
 var idArea = $('#idArea').val();
 var idSubarea = $('#subArea').val();

 if(idArea != 0 && idSubarea != '' )
 {
  $('#GestorUsuarios').DataTable().destroy();
  llenar_tablaGestorUsuarios(idArea, idSubarea);
  
}
else
{
  $("body").overhang({
    type: "error",
    message: "Ninguna opción seleccionada",
    duration: 1,
  });
  $('#GestorUsuarios').DataTable().destroy();
  llenar_tablaGestorUsuarios();

}
});


// $('#GestorNutriologos tbody').on("click", "button.Verinfo",function(){
//   var idBotonVer =$(this).attr("id");

//  //LLENAR CAMPOS DE TEXTO CON LA INFORMACION DE PERFIL 
//  $.ajax({
//    type: "POST",
//    url: "?c=GestionarNutriologos&a=datosDeUsuario",
//    data: {idBotonVer:idBotonVer},
//    success:function(data){

//      var data = JSON.parse(data);

//      for (var i = data.length - 1; i >= 0; i--) {
//       $("#nombreNutriologoGestor").val(data[i].nombre);
//       $("#correoNutriologoGestor").val(data[i].correo);
//       $("#direccionNutriologoGestor").val(data[i].direccion);
//       $("#telefonoNutriologoGestor").val(data[i].telefono);
//     }  


//   }

// });
// });


$("#nombreTrabajador").attr('checked', 'checked');

if ($("#nombreTrabajador").is(':checked'))
{
  //BUSCAR TRABAJADOR POR NOMBRE
$('#key').on('keyup', function() {
  var key = $(this).val();    
  var dataString = 'key='+key;
  $.ajax({
    type: "POST",
    url: "?c=GestionarUsuarios&a=BuscarEmpleadoRegistro",
    data: {dataString:dataString,key:key},
    success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#key').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        // alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                        var correoEmpleado = $('#'+id).attr('correo');
                        var usuario = correoEmpleado.split('@')[0];
                        var idEmpleado = $('#'+id).attr('id');
                        $('#nombreUsuario').val(usuario);
                        $('#correoUsuario').val(correoEmpleado);
                        $('#idEmpleado').val(idEmpleado);
                        return false;
                      });
              }
            });
});
}


  $("input[name=BuscarTrabajador]").click(function () {    
           var buscarInfo = $(this).attr('id');
           

           if (buscarInfo== 'nombreTrabajador')
            {


//BUSCAR TRABAJADOR POR NOMBRE
$('#key').on('keyup', function() {
  var key = $(this).val();    
  var dataString = 'key='+key;
  $.ajax({
    type: "POST",
    url: "?c=GestionarUsuarios&a=BuscarEmpleadoRegistro",
    data: {dataString:dataString,key:key},
    success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#key').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        // alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                        var correoEmpleado = $('#'+id).attr('correo');
                        var usuario = correoEmpleado.split('@')[0];
                        var idEmpleado = $('#'+id).attr('id');
                        $('#nombreUsuario').val(usuario);
                        $('#correoUsuario').val(correoEmpleado);
                        $('#idEmpleado').val(idEmpleado);
                        return false;
                      });
              }
            });
});

            }
            else if (buscarInfo== 'correoTrabajador')
            {

              //BUSCAR TRABAJADOR POR NOMBRE
              $('#key').on('keyup', function() {
                var key = $(this).val();    
                var dataString = 'key='+key;
                $.ajax({
                  type: "POST",
                  url: "?c=GestionarUsuarios&a=BuscarEmpleadoCorreo",
                  data: {dataString:dataString,key:key},
                  success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#key').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        // alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                        var correoEmpleado = $('#'+id).attr('data');
                        var usuario = correoEmpleado.split('@')[0];
                        var idEmpleado = $('#'+id).attr('id');
                        $('#nombreUsuario').val(usuario);
                        $('#correoUsuario').val(correoEmpleado);
                        $('#idEmpleado').val(idEmpleado);
                        return false;
                      });
              }
            });
              });
              

            }
  
    });




});


