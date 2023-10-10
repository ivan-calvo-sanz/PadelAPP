/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  let funcion = "";
  let id_usuario = document.getElementById("id_usuario").value;
  //console.log(id_usuario);
  var edit = false;

  buscar_usuario(id_usuario);

  /* FUNCION */
  /* Realiza peticion POST mediante AJAX para obtener los datos del Usuario */
  function buscar_usuario(id_usuario) {
    funcion = "buscar_usuario";
    /* mediante JQuery realizo una peticion AJAX post al CONTROLER */
    $.post("../controlador/UsuarioController.php", { id_usuario, funcion }, (response) => {
      /* convierto el JSON (String) que devuelve el UsuarioControLler.php a Objeto JSON JS */
      const usuario = JSON.parse(response);
      /* console.log(usuario); */
      let nombre_usuario = usuario.nombre_usuario;
      let nombre = usuario.nombre;
      let apellidos = usuario.apellidos;
      let edad = usuario.edad;
      let dni = usuario.dni;
      let rol = usuario.rol;
      let nivel = usuario.nivel;
      let telefono = usuario.telefono;
      let direccion = usuario.direccion;
      let email = usuario.email;
      let genero = usuario.genero;
      let adicional = usuario.adicional;
      document.getElementById("nombre_us").innerHTML = nombre;
      document.getElementById("apellidos_us").innerHTML = apellidos;
      document.getElementById("edad").innerHTML = edad;
      document.getElementById("dni_us").innerHTML = dni;

      let rolTxt;
      if (rol == 1) {
        rolTxt = `<h1 class="badge badge-danger">ROOT</h1>`;
      } else if (rol == 2) {
        rolTxt = `<h1 class="badge badge-warning">Administrador</h1>`;
      } else if (rol == 3) {
        rolTxt = `<h1 class="badge badge-warning">Administrador</h1>`;
      }

      document.getElementById("us_rol").innerHTML = rolTxt;
      document.getElementById("nivel").innerHTML = nivel;

      document.getElementById("telefono_us").innerHTML = telefono;
      document.getElementById("direccion_us").innerHTML = direccion;
      document.getElementById("email_us").innerHTML = email;
      document.getElementById("genero_us").innerHTML = genero;
      document.getElementById("adicional_us").innerHTML = adicional;
    });
  }

  /* EVENTO CLICK BOTON EDITAR */
  document.getElementById("btn-editar").addEventListener("click", editar, false);
  function editar() {
    edit = true;
    funcion = "buscar_usuario";

    /* PETICION AJAX MEDIANTE JQuery al CONTROLER */
    $.post("../controlador/UsuarioController.php", { id_usuario, funcion }, (response) => {
      /* convierto el JSON formato String que nos envía el UsuarioControLler PHP a formato JS */
      const usuario = JSON.parse(response);
      /* console.log(usuario); */
      let telefono = usuario.telefono;
      let direccion = usuario.direccion;
      let email = usuario.email;
      let genero = usuario.genero;
      let adicional = usuario.adicional;

      document.getElementById("telefono").value = telefono;
      document.getElementById("direccion").value = direccion;
      document.getElementById("email").value = email;
      document.getElementById("genero").value = genero;
      document.getElementById("adicional").value = adicional;
    });
  }

  /* EVENTO SUBMIT AL ENVIAR EL FORMULARIO */
  document.getElementById("form-usuario").addEventListener("submit", guardar, false);
  function guardar(e) {
    if (edit == true) {
      console.log("pulsado Guardar");
      let telefono = document.getElementById("telefono").value;
      let direccion = document.getElementById("direccion").value;
      let email = document.getElementById("email").value;
      let genero = document.getElementById("genero").value;
      let adicional = document.getElementById("adicional").value;
      /* PETICION AJAX MEDIANTE JQuery al CONTROLER */
      funcion = "actualizar-usuario";
      $.post(
        "../controlador/UsuarioController.php",
        { id_usuario, funcion, telefono, direccion, email, genero, adicional },
        (response) => {
          if (response == "editado") {
            let spanFlotante = document.getElementById("editado");
            spanFlotante.style.display = "";
            setTimeout(cerrar, 3000);
            function cerrar() {
              spanFlotante.style.display = "none";
              document.getElementById("form-usuario").reset();
            }
          }
          /* una vez que la consulta se ha realizado la variable "edit" la pongo en false para que desactive el boton de Guardar */
          /* y se actualizan los datos del usuario en la pantalla */
          edit = false;
          buscar_usuario(id_usuario);
        }
      );
    } else {
      let spanFlotante = document.getElementById("no-editado");
      spanFlotante.style.display = "";
      setTimeout(cerrar, 5000);
      function cerrar() {
        spanFlotante.style.display = "none";
        document.getElementById("form-usuario").reset();
      }
    }
    //para evitar que al hacer Submit se actualice la pagina
    e.preventDefault();
  }
});
