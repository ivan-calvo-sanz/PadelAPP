/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  let funcion = "";
  let id_usuario = document.getElementById("id_usuario").value;
  //console.log(id_usuario);
  var edit = false;

  /* CARGAR AVATAR USUARIO */
  const avatarSession = document.getElementById("avatarSession").value;
  //console.log(avatarSession);
  const avatars = document.getElementsByClassName("avatar");
  for (let i = 0; i < avatars.length; i++) {
    avatars[i].src = "../img/" + avatarSession;
  }

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
      document.getElementById("nombre_apellidos_us").innerHTML = nombre + " " + apellidos;
      document.getElementById("edad").innerHTML = edad + " años";
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

      document.getElementById("telefono").innerHTML = telefono;
      document.getElementById("direccion").innerHTML = direccion;
      document.getElementById("email").innerHTML = email;
      document.getElementById("genero").innerHTML = genero;
      document.getElementById("adicional").innerHTML = adicional;
    });
  }

  /* EVENTO CLICK BOTON "Editar" */
  document.getElementById("btn-editar").addEventListener("click", editar, false);
  function editar() {
    edit = true;
    funcion = "buscar_usuario";

    /* peticion AJAX mediante JQuery al Controller */
    $.post("../controlador/UsuarioController.php", { id_usuario, funcion }, (response) => {
      /* convierto el JSON formato String que nos envía el UsuarioControLler PHP a formato JS */
      const usuario = JSON.parse(response);
      /* console.log(usuario); */
      let telefono = usuario.telefono;
      let direccion = usuario.direccion;
      let email = usuario.email;
      let genero = usuario.genero;
      let adicional = usuario.adicional;

      document.getElementById("edit_telefono").value = telefono;
      document.getElementById("edit_direccion").value = direccion;
      document.getElementById("edit_email").value = email;
      document.getElementById("edit_genero").value = genero;
      document.getElementById("edit_adicional").value = adicional;
    });
  }

  /* EVENTO SUBMIT AL ENVIAR EL FORMULARIO "Guardar" */
  document.getElementById("form-usuario").addEventListener("submit", guardar, false);
  function guardar(e) {
    if (edit == true) {
      console.log("pulsado Guardar");
      let telefono = document.getElementById("edit_telefono").value;
      let direccion = document.getElementById("edit_direccion").value;
      let email = document.getElementById("edit_email").value;
      let genero = document.getElementById("edit_genero").value;
      let adicional = document.getElementById("edit_adicional").value;
      /* peticion AJAX mediante JQuery al Controller */
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

  /* EVENTO SUBMIT AL ENVIAR EL FORMULARIO DEL MODAL "Cambiar contraseña" */
  document.getElementById("form-pass").addEventListener("submit", cambiarContrasena, false);
  function cambiarContrasena(e) {
    let oldpass = document.getElementById("old-pass").value;
    let newpass = document.getElementById("new-pass").value;
    funcion = "cambiar_contra";
    /* peticion AJAX mediante JQuery al Controller */
    $.post("../controlador/UsuarioController.php", { id_usuario, funcion, oldpass, newpass }, (response) => {
      if (response == "update") {
        let spanFlotante = document.getElementById("update");
        spanFlotante.style.display = "";
        document.getElementById("form-pass").reset();
        setTimeout(cerrar, 5000);
        function cerrar() {
          spanFlotante.style.display = "none";
        }
      } else {
        let spanFlotante = document.getElementById("no-update");
        spanFlotante.style.display = "";
        document.getElementById("form-pass").reset();
        setTimeout(cerrar, 5000);
        function cerrar() {
          spanFlotante.style.display = "none";
        }
      }
    });
    //para evitar que al hacer Submit se actualice la pagina
    e.preventDefault();
  }
});
