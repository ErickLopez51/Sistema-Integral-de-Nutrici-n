
//ARREGLO DE ALIMENTOS
var arrayAlimentos=[];

$(document).ready(function() {

  //DEFINIR TABLA DE HISTORIAL ALIMENTOS
  var tablaHistorial = $('#tablaHistorial').DataTable({
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
$('#agregarAlimento').click(function(){
var grupoAlimento = $('#grupoAlimento').val();
var frecuencia = $('#frecuencia').val();
var porcion = $('#porcion').val();
var tipoPorcion = $('#tipoPorcion').val();
var alimento = $('#alimento').val();


var  tablafrecuencia = frecuencia + '/7';
var  tablaAlimento =  porcion +' '+ tipoPorcion +' de '+ alimento;
var  botonEliminar = "<div class='col text-center'><button id='"+counter+"' title='Eliminar Alimento' class='eliminar btn btn-danger btn-circle'><i class='fas fa-trash'></i></button></div>";

if(grupoAlimento == '' || frecuencia ==  '' || porcion ==  '' || tipoPorcion ==  '' || alimento ==  '' )
{
  $("body").overhang({
    type: "error",
    message: "Campos vacíos",
    duration: 1,
  });
}
else
{

  var alimento = {
    grupoAlimento: grupoAlimento,
    frecuencia: frecuencia,
    porcion: porcion,
    tipoPorcion: tipoPorcion,
    alimento: alimento
};
   arrayAlimentos.push(alimento);
  tablaHistorial.row.add( [
    grupoAlimento,
    tablafrecuencia,
    tablaAlimento,
    botonEliminar
] ).draw( false );

counter++;

$("#grupoAlimento").val('0');
$("#frecuencia").val('');
$("#porcion").val('');
$("#tipoPorcion").val('0');
$("#alimento").val(''); 
}
});


//ELIMINAR ALIMENTO DE LA TABLA
$('#tablaHistorial tbody').on("click", "button.eliminar",function(){
  var idAgregado =$(this).attr("id");
  var indice=$(this).closest('td').parent()[0].sectionRowIndex;
  tablaHistorial.row(':eq('+indice+')').remove().draw();
  delete arrayAlimentos[idAgregado];

  for(var i = 0; i < arrayAlimentos.length; i++){
    if(arrayAlimentos[i] === undefined){
      arrayAlimentos.splice(i , 1);
    }
}

});

//GUARDAR HISTORIAL
$('#guardarHistorial').click(function(){
  var pesohabitual=$("#pesohabitual").val();
  var aguaP=$("#aguaP").val();
  var complexionF=$("#complexionF").val();
  var pesoMinumo=$("#pesoMinumo").val();
  var musculoP=$("#musculoP").val();
  var edadMetabolica=$("#edadMetabolica").val();
  var pesoMaximo=$("#pesoMaximo").val();
  var masaOsea=$("#masaOsea").val();
  var cintura=$("#cintura").val();
  var pesoActual=$("#pesoActual").val();
  var imc=$("#imc").val();
  var cadera=$("#cadera").val();
  var talla=$("#talla").val();
  var kgGrasa=$("#kgGrasa").val();
  var pesoIdeal=$("#pesoIdeal").val();
  var grasaP=$("#grasaP").val();
  var nivelGrasa=$("#nivelGrasa").val();
  var pesoMeta=$("#pesoMeta").val();

 
  if (pesohabitual == ' ' ||  aguaP == '' || complexionF == '' || 
  pesoMinumo == '' || musculoP == '' || edadMetabolica == '' || 
  pesoMaximo == '' || masaOsea == '' || cintura == '' || 
  pesoActual == '' || imc == '' || cadera == '' ||
  talla == '' || kgGrasa == '' || pesoIdeal == '' || 
  grasaP == '' || nivelGrasa == '' || pesoMeta == '' )
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
   url: "?c=HistorialNutricionales&a=guardarHistorial",
       data: {pesohabitual:pesohabitual, aguaP:aguaP, complexionF:complexionF, 
        pesoMinumo:pesoMinumo, musculoP:musculoP, edadMetabolica:edadMetabolica, 
        pesoMaximo:pesoMaximo, masaOsea:masaOsea, cintura:cintura, 
        pesoActual:pesoActual, imc:imc, cadera:cadera,
        talla:talla, kgGrasa:kgGrasa, pesoIdeal:pesoIdeal,
        grasaP:grasaP, nivelGrasa:nivelGrasa, pesoMeta:pesoMeta, 'arrayAlimentos': JSON.stringify(arrayAlimentos) },
         success:function(response){
 
            if (response.estado == "true") {
             $("body").overhang({
               type: "success",
               message: "Guardando información",
               duration: 1,
               callback: function() {
                 window.location.href = "?c=Usuarios&a=ingresar";
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




});