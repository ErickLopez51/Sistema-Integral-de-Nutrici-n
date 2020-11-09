$(document).ready(function() {


    $("#loginForm").bind("submit", function() {
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend: function() {
                $("#loginForm button[type=submit]").html("Enviando...");
                $("#loginForm button[type=submit]").attr("disabled", "disabled");
            },
            success: function(response) {
                if (response.estado == "true") {
                 $("body").overhang({
                    type: "success",
                    message: "Usuario encontrado, te estamos redirigiendo...",
                    callback: function() {
                        window.location.href = "?c=Usuarios&a=ingresar";
                    }
                });
             } else {
                $("body").overhang({
                    type: "error",
                    message: "¡Correo y contraseña incorrectos!"
                });
            }

            $("#loginForm button[type=submit]").html("Ingresar");
            $("#loginForm button[type=submit]").removeAttr("disabled");
        },
        error: function() {
            $("body").overhang({
                type: "error",
                message: "Correo y contraseña incorrectos!"
            });

            $("#loginForm button[type=submit]").html("Ingresar");
            $("#loginForm button[type=submit]").removeAttr("disabled");
        }
    });

        return false;
    });

});

$(document).ready(function() {

    //MOSTRAR Y OCULTAR CONTRASEÑA
    $('#mostrarContraInicio').click(function(){
      if($(this).hasClass('fa-eye'))
      {
          $('#txtPassword').attr('type','text');
          $('#mostrarContraInicio').addClass('fa-eye-slash').removeClass('fa-eye');
      }

      else
      {
      //Establecemos el atributo y valor
      $('#txtPassword').attr('type','password');
      $('#mostrarContraInicio').addClass('fa-eye').removeClass('fa-eye-slash');
  }
});




});


