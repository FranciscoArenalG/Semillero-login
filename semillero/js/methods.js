
function EnviarRegistro() {

  $(document).ready(function() {
    $("#formRegister").validate({
      event: "blur",
      rules: {
        nombres: {
          required: true
        },
        correo: {
          required: true,
          email: true
        },
        pass1: {
          required: true,
          minlength: 6
        },
        pass2: {
          required: true,
          minlength: 6,
          equalTo: "#pass1"
        }
      },
      messages: {
        nombres: "Introduce un nombre correcto",
        correo: "Introduce un correo valido",
        pass1: {
          required: "Se requiere una contraseña",
          minlength: "La contraseña debe tener un minimo de 6 caracteres"
        },
        pass2: "Las contraseñas no coinciden"
      },
      errorElement: "label",
      errorClass: "error",
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "./php/register.php",
          data: $("#formRegister").serialize(),
          success: function(msg) {
            if (msg.trim() == "correcto") {
              Swal.fire({
                icon: 'success',
                title: 'Registro correcto',
                text: 'Se registro correctamente el usuario',
                showConfirmButton: false,
                timer: 2000
              });
              setTimeout(function() {
                window.location.href = "./login";
              }, 2000);
            } else if (msg.trim() == "existente") {
              Swal.fire({
                icon: 'error',
                title: 'Usuario existente',
                text: 'El correo ingresado ya existe',
                showConfirmButton: false,
                timer: 2000
              })
            }
          }
        });
      }
    });
  });
}

function Login() {

  $(document).ready(function() {
    $("#formLogin").validate({
      event: "blur",
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        email: "Introduce un correo valido",
        password: {
          required: "Introduce una constraseña",
          minlength: "La contraseña debe tener un mínimo 6 caracteres"
        }
      },
      errorElement: "label",
      errorClass: "error", //Se manda a llamar la clase declarada en css
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "./php/validate.php",
          data: $("#formLogin").serialize(),
          success: function(msg) {
            if (msg.trim() == "correcto") {
              Swal.fire({
                icon: 'success',
                title: 'Acceso correcto',
                text: 'Bienvenido a Semillero',
                showConfirmButton: false,
                timer: 2000
              });
              setTimeout(function() {
                window.location.href = "./home";
              }, 2000);
            } else if (msg.trim() == "user") {
              Swal.fire({
                icon: 'error',
                title: 'Usuario incorrecto',
                text: 'El correo ingresado no existe',
                showConfirmButton: false,
                timer: 2000
              })
            } else if (msg.trim() == "password") {
              Swal.fire({
                icon: 'error',
                title: 'Contraseña incorrecta',
                text: 'La contraseña ingresada es incorrecta',
                showConfirmButton: false,
                timer: 2000
              })
            }
          }
        });
      }
    });
  });
}

function RecoveryPass() {
  $.ajax({
    type: "POST",
    url: "./php/recovery.php",
    data: "recovery="+escape($('#email_recovery').val()),
    success: function(msg) {
      // console.log(msg);
      if (msg.trim() == "existe") {
        Swal.fire({
          icon: 'success',
          title: 'Correo enviado',
          text: 'Se envio correctamente el correo de recuperación',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout(function() {
          window.location.href = "./index";
        }, 2000);
      } else if (msg.trim() == "incorrecto") {
        Swal.fire({
          icon: 'error',
          title: 'Correo no registrado',
          text: 'El correo ingresado no existe',
          showConfirmButton: false,
          timer: 2000
        })
      }
    }
  });
}

function VerifyMail(email) {
  $.ajax({
    type: "POST",
    url: "./php/validate.php",
    data: $("#formLogin").serialize(),
    success: function(msg) {
      if (msg.trim() == "correcto") {
        Swal.fire({
          icon: 'success',
          title: 'Acceso correcto',
          text: 'Bienvenido a Semillero',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout(function() {
          window.location.href = "./home";
        }, 2000);
      } else if (msg.trim() == "user") {
        Swal.fire({
          icon: 'error',
          title: 'Usuario incorrecto',
          text: 'El correo ingresado no existe',
          showConfirmButton: false,
          timer: 2000
        })
      } else if (msg.trim() == "password") {
        Swal.fire({
          icon: 'error',
          title: 'Contraseña incorrecta',
          text: 'La contraseña ingresada es incorrecta',
          showConfirmButton: false,
          timer: 2000
        })
      }
    }
  });
}

function Cerrar() {
  window.location.href = "./php/disconnect.php";
}
