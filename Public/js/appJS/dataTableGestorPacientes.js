//Código para Datables

//$('#example').DataTable(); //Para inicializar datatables de la manera más simple
 
    var tablaGestorPaciente = $('#GestorPacientes').DataTable({
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
        "url": "?c=GestionarPacientes&a=mostrarPacientes",
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


        //BOTON PARA VER INFORMACION DEL PACIENTE
      $('#GestorPacientes tbody').on("click", "button.Verinfo",function(){
        var idBotonVer =$(this).attr("id");
      
       //LLENAR CAMPOS DE TEXTO CON LA INFORMACION DE PERFIL 
       $.ajax({
         type: "POST",
         url: "?c=GestionarPacientes&a=datosDeUsuario",
         data: {idBotonVer:idBotonVer},
         success:function(data){
      
           var data = JSON.parse(data);
      
           for (var i = data.length - 1; i >= 0; i--) {
            $("#nombrePacienteGestor").val(data[i].nombre);
            $("#fechaNacPacienteGestor").val(data[i].fechaNac);
            $("#ocupacionPacienteGestor").val(data[i].ocupacion);
            $("#estaturaPacienteGestor").val(data[i].estatura);
            $("#correoPacienteGestor").val(data[i].correo);
            $("#direccionPacienteGestor").val(data[i].direccion);
            $("#ciudadPacienteGestor").val(data[i].ciudad);
            $("#telefonoPacienteGestor").val(data[i].telefono);
          }  
      
      
        }
      
      });
      });

  //DAR DE ALTA PACIENTE
$('#pacienteAlta').click(function(){
  var nombrePaciente=$("#nombrePaciente").val();
  var apPaciente=$("#apPaciente").val();
  var amPaciente=$("#amPaciente").val();
  var fechaNacPaciente=$("#fechaNacPaciente").val();
  var estaturaPaciente=$("#estaturaPaciente").val();
  var ocupacionPaciente=$("#ocupacionPaciente").val();
  var correoPaciente=$("#correoPaciente").val();
  var direccionPaciente=$("#direccionPaciente").val();
  var ciudadPaciente=$("#ciudadPaciente").val();
  var telefonoPaciente=$("#telefonoPaciente").val();
 
  if (nombrePaciente == ' ' ||  apPaciente == '' || amPaciente == '' || fechaNacPaciente == '' || estaturaPaciente == '' || ocupacionPaciente == '' || correoPaciente == '' || direccionPaciente == '' || ciudadPaciente == '' || telefonoPaciente == '')
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
   url: "?c=GestionarPacientes&a=darDeAltaUsuario",
       data: {nombrePaciente:nombrePaciente, apPaciente:apPaciente, 
        amPaciente:amPaciente, fechaNacPaciente:fechaNacPaciente, estaturaPaciente:estaturaPaciente,
        ocupacionPaciente:ocupacionPaciente, correoPaciente:correoPaciente, direccionPaciente:direccionPaciente,
        ciudadPaciente:ciudadPaciente, telefonoPaciente:telefonoPaciente},
         success:function(response){
 
            if (response.estado == "true") {
             $("body").overhang({
               type: "success",
               message: "Guardando información",
               duration: 1,
               callback: function() {
                 window.location.href = "?c=GestionarPacientes&a=MainGestorPacientes";
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
     
  //EDITAR PACIENTE
$("#editarPaciente").click(function(){
 var idUsuario = $('#idPaciente').val().trim();
 var nombrePaciente=$("#nombrePaciente").val().trim();
 var apPaciente=$("#apPaciente").val().trim();
 var amPaciente=$("#amPaciente").val().trim();
 var fechaNacPaciente=$("#fechaNacPaciente").val().trim();
 var estaturaPaciente=$("#estaturaPaciente").val().trim();
 var ocupacionPaciente=$("#ocupacionPaciente").val().trim();
 var correoPaciente=$("#correoPaciente").val().trim();
 var direccionPaciente=$("#direccionPaciente").val().trim();
 var ciudadPaciente=$("#ciudadPaciente").val().trim();
 var telefonoPaciente=$("#telefonoPaciente").val().trim();

 if (nombrePaciente == ' ' ||  apPaciente == '' || amPaciente == '' || fechaNacPaciente == '' || estaturaPaciente == '' || ocupacionPaciente == '' || correoPaciente == '' || direccionPaciente == '' || ciudadPaciente == '' || telefonoPaciente == '')
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
    url: "?c=GestionarPacientes&a=ActualizarPaciente",
          data: {idUsuario:idUsuario, nombrePaciente:nombrePaciente, apPaciente:apPaciente, 
                 amPaciente:amPaciente, fechaNacPaciente:fechaNacPaciente, estaturaPaciente:estaturaPaciente,
                 ocupacionPaciente:ocupacionPaciente, correoPaciente:correoPaciente, direccionPaciente:direccionPaciente,
                 ciudadPaciente:ciudadPaciente, telefonoPaciente:telefonoPaciente},//capturo array 
          success:function(response){

           if (response.estado == "true") {
            $("body").overhang({
              type: "success",
              message: "Actualizando información",
              duration: 1,
              callback: function() {           
                window.location.href = "?c=GestionarPacientes&a=MainGestorPacientes";
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


//DAR DE BAJA A PACIENTE
function EliminarUsuario(idUsuario)
{

    $.ajax({
    type: "POST",
  url: "?c=GestionarPacientes&a=bajaUsuario",
      data: {idUsuario:idUsuario},
          beforeSend:function(){},
          success:function(){
 $('#GestorPacientes').DataTable().ajax.reload();
    Swal.fire(
            '¡Hecho!',
            'El paciente fue dado de baja.',
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
