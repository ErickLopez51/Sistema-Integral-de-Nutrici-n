
$(document).ready(function() {


//GUARDAR HISTORIAL
$('#guardarHabitos').click(function(){
    var hLevantarse=$("#hLevantarse").val();
    var hDormir=$("#hDormir").val();
    var comidasDia=$("#comidasDia").val();
    var hDiariamente=$("#hDiariamente").val();
    var saltarComida=$("#saltarComida").val();
    var comerEntreComidas=$("#comerEntreComidas").val();
    var tipoAlimentos=$("#tipoAlimentos").val();
    var alimentosMalestar=$("#alimentosMalestar").val();
  
   
    if (hLevantarse == ' ' ||  hDormir == '' || comidasDia == '' || 
    hDiariamente == '' || saltarComida == '' || comerEntreComidas == '' ||
     alimentosMalestar == '' )
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
     url: "?c=HabitosAlimenticios&a=guardarHabitos",
         data: {hLevantarse:hLevantarse, hDormir:hDormir, comidasDia:comidasDia, 
          hDiariamente:hDiariamente, saltarComida:saltarComida, comerEntreComidas:comerEntreComidas, 
          tipoAlimentos:tipoAlimentos, alimentosMalestar:alimentosMalestar },
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