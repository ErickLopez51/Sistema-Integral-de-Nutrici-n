$(document).ready(function() {


  

    $('#enviarRecomendacion').click(function(){
      var cuerpo = document.getElementById('textarea').value.trim();
    
    
      if (cuerpo == "")
      {
        console.log("entro");
        $("body").overhang({
          type: "error",
          message: "Campos vacíos",
          duration: 1,
        });
        return false;

      }else
      {
        var parametrosMail = new FormData($("#mail")[0]);
        //ENVIAR ARCHIVOS
        $.ajax({
         data: parametrosMail,
         type: "POST",
         url: '?c=Recomendaciones&a=enviarRecomendacion',
         cache: false,
         contentType: false,
         processData: false,       
              success:function(response){
      
                 if (response.estado == "true") {
                  $("body").overhang({
                    type: "success",
                    message: "Enviando recomendación",
                    duration: 1,
                    callback: function() {
                      window.location.href = "?c=Recomendaciones&a=vistaRecomendacion";
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


  $('#textarea').summernote({
    lang: "es-ES",
    height: 400,
    callbacks: {
      onImageUpload : function(files, editor, welEditable) {

       for(var i = files.length - 1; i >= 0; i--) {
         sendFile(files[i], this);
       }
     }
   }

 });
  
});