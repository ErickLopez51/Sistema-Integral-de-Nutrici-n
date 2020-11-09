$(document).ready(function() {

//GUARDAR DIETA HABITUAL
$('#guardarDieta').click(function(){
    var desayuno=$("#desayuno").val();
    var colacion1=$("#colacion1").val();
    var comida=$("#comida").val();
    var colacion2=$("#colacion2").val();
    var cena=$("#cena").val();
    var notaDieta=$("#notaDieta").val();
    var cantidadLiquidos=$("#cantidadLiquidos").val();


    if (desayuno == ' ' ||  colacion1 == '' || comida == '' || 
    colacion2 == '' || cena == '' || cantidadLiquidos == '' )
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
     url: "?c=DietaHabituales&a=guardarDieta",
         data: {desayuno:desayuno, colacion1:colacion1, comida:comida, 
          colacion2:colacion2, cena:cena, notaDieta:notaDieta, 
          cantidadLiquidos:cantidadLiquidos},
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