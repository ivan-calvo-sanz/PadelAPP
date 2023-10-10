/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  let funcion = "";
  let id_usuario = document.getElementById("id_usuario").value;
  //console.log(id_usuario);

  buscar_usuario(id_usuario);

  /* Funcion que realiza una peticion post */
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
});
