
$(document).ready(function() {


//TABLA DE CITAS AGENDADAS, PACIENTES
  var tablaCitas = $('#tablaCitas').DataTable({
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
      "url": "?c=AgendarCitas&a=mostrarCitas",
      "type":"POST",
    },
    "columns": [
    { "data" : "fecha" },
    { "data" : "notaCita" },
    { "data" : "estado" }
    ]
    });    

    
//TABLA DE CITAS AGENDADAS NUTRIOLOGOS
  var tablaCitasNutriologo = $('#tablaCitasNutriologo').DataTable({
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
      "url": "?c=AgendarCitas&a=mostrarCitasNutriologo",
      "type":"POST",
    },
    "columns": [
    { "data" : "nombrePaciente" },
    { "data" : "fecha" },
    { "data" : "notaCita" },
    { "data" : "estado" },
    { "data" : "confirmar" },
    { "data" : "cancelar" },
    ]
    });   

//GUARDAR HISTORIAL
$('#guardarCita').click(function(){
  var fechaCita=$('[data-toggle="calendarioCita"]').val();
  var timeCita=$("#timeCita").val();
  var notaCita=$("#notaCita").val();

  if (fechaCita == ' ' ||  timeCita == '')
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
   url: "?c=AgendarCitas&a=guardarCita",
       data: {fechaCita:fechaCita, timeCita:timeCita, notaCita:notaCita },
         success:function(response){
 
            if (response.estado == "true") {
             $("body").overhang({
               type: "success",
               message: "Guardando información",
               duration: 1,
               callback: function() {
                 window.location.href = "?c=AgendarCitas&a=mainCitas";
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

 
 function llenar_tabla(estadoCitas = '')
 {

  if( estadoCitas == 1 || estadoCitas == 3 || estadoCitas == 4  )
  {
    var tablaCitasNutriologo = $('#tablaCitasNutriologo').DataTable({
      "pagingType": "full_numbers",
          "columnDefs": [
              {
                  "targets": [ 4 ],
                  "visible": false,
                  "searchable": false
              },
              {
                  "targets": [ 5 ],
                  "visible": false,
                  "searchable": false
              }
          ],
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
        "url": "?c=AgendarCitas&a=mostrarCitasNutriologoFiltro",
        "type":"POST",
        "data": {
          estadoCitas:estadoCitas
        },
      },
      "columns": [
      { "data" : "nombrePaciente" },
      { "data" : "fecha" },
      { "data" : "notaCita" },
      { "data" : "estado" },
      { "data" : "confirmar" },
      { "data" : "cancelar" },
      ]
      }); 
  }
  else
  {
    var tablaCitasNutriologo = $('#tablaCitasNutriologo').DataTable({
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
        "url": "?c=AgendarCitas&a=mostrarCitasNutriologoFiltro",
        "type":"POST",
        "data": {
          estadoCitas:estadoCitas
        },
      },
      "columns": [
      { "data" : "nombrePaciente" },
      { "data" : "fecha" },
      { "data" : "notaCita" },
      { "data" : "estado" },
      { "data" : "confirmar" },
      { "data" : "cancelar" },
      ]
      }); 
   
  }  
}

 //FILTRO PARA MOSTRAR ESTADOS DE LAS CITAS AGENDADAS NUTRIOLOGOS
 $('#filtroCitas').click(function(){
  var estadoCitas = $('#estadoCitas').val();
  
  if(estadoCitas != 0 )
  {

    $('#tablaCitasNutriologo').DataTable().destroy();
      llenar_tabla(estadoCitas);
   
 }
 else
 {
   $("body").overhang({
     type: "error",
     message: "Ninguna opción seleccionada",
     duration: 1,
   });
   $('#tablaCitasNutriologo').DataTable().destroy();
   llenar_tabla(estadoCitas);

 
 }
 });




 function llenar_tablaPacientes(estadoCitasPaciente = '')
 {
    var tablaCitas = $('#tablaCitas').DataTable({
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
        "url": "?c=AgendarCitas&a=mostrarCitasPacienteFiltro",
        "type":"POST",
        "data": {
          estadoCitasPaciente:estadoCitasPaciente
        },
      },
      "columns": [
        { "data" : "fecha" },
        { "data" : "notaCita" },
        { "data" : "estado" }
      ]
      }); 
   
  
}
  //FILTRO PARA MOSTRAR ESTADOS DE LAS CITAS AGENDADAS PACIENTES
  $('#filtroCitasPaciente').click(function(){
    var estadoCitasPaciente = $('#estadoCitasPaciente').val();
    
    if(estadoCitasPaciente != 0 )
    {
  
      $('#tablaCitas').DataTable().destroy();
        llenar_tablaPacientes(estadoCitasPaciente);
     
   }
   else
   {
     $("body").overhang({
       type: "error",
       message: "Ninguna opción seleccionada",
       duration: 1,
     });
     $('#tablaCitas').DataTable().destroy();
     llenar_tablaPacientes(estadoCitasPaciente);
  
   
   }
   });

   
//CALENDARIO PARA AGENDAR CITAS
$(function () {
  $('[data-toggle="calendarioCita"]').datepicker({
    beforeShowDay: $.datepicker.noWeekends ,
    autoHide: true,
    zIndex: 2048,
    dateFormat: 'yy-mm-dd',
    minDate: 0,
    firstDay: 1,
    monthNames: ['Enero', 'Febreo', 'Marzo',
    'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre',
    'Octubre', 'Noviembre', 'Diciembre'],
    dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
  });
});

//MOSTRAR HORAS PARA AGENDAR CITAS
$('#timeCita').timepicker({
  template: 'modal',
  'minTime': '9:00 am',
  'maxTime': '02:00 pm',
  'step': 60,
 });

});

//CONFIRMAR CITA
function confirmarCita(idCita)
{

    $.ajax({
    type: "POST",
  url: "?c=AgendarCitas&a=confirmarCita",
      data: {idCita:idCita},
          beforeSend:function(){},
          success:function(){
   $('#tablaCitasNutriologo').DataTable().ajax.reload();
    Swal.fire(
            '¡Hecho!',
            'Se ha confirmado la cita, se envió correo al paciente.',
            'success'
            )

        } 
      }); 
}

 function alertaConfirmarCita(idCita)
{
      Swal.fire({
        title: '¿Estás seguro de confirmar?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
         cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, ¡Confirmar!'
      }).then((result) => {
        if (result.value) {
          confirmarCita(idCita);
        }
      });
}

//CANCELAR CITA
function cancelarCita(idCita)
{

    $.ajax({
    type: "POST",
  url: "?c=AgendarCitas&a=cancelarCita",
      data: {idCita:idCita},
          beforeSend:function(){},
          success:function(){
          $('#tablaCitasNutriologo').DataTable().ajax.reload();
    Swal.fire(
            '¡Hecho!',
            'Se ha cancelado la cita, se envió correo al paciente.',
            'success'
            )

        } 
      }); 
}

 function alertaCancelarCita(idCita)
{
      Swal.fire({
        title: '¿Estás seguro de cancelar?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
         cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, ¡Cancelar!'
      }).then((result) => {
        if (result.value) {
          cancelarCita(idCita);
        }
      });
}

