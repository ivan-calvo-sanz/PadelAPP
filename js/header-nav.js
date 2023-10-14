/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  /* CLICK BOTON CERRAR */
  const btnCerrar = document.getElementById("btn-cerrar");
  btnCerrar.addEventListener("click", () => {
    window.open("../controlador/Logout.php", "_self");
  });

  /* CARGAR AVATAR USUARIO */
  const avatarSession = document.getElementById("avatarSession").value;
  //console.log(avatarSession);
  const avatar = document.getElementById("avatar");
  avatar.src = "../img/" + avatarSession;

  /* ACTIVAR Y DESACTIVAR BOTON MENU */
  const btnMenu = document.getElementById("boton-menu");
  //var btnMenuEstado = true;
  btnMenu.addEventListener("click", () => {
    // si ya tiene la clase "active" se la quita y si NO la tiene se la pone
    // la clase "active" modifica el tamaño width del nav
    btnMenu.classList.toggle("active");
  });

  /* ACTIVAR Y ACTUALIZAR <a> SELECCIONADO */
  actualizarEnlace();

  function actualizarEnlace() {
    let URLactual = window.location.href;
    if (URLactual.includes("home_root")) {
      document.getElementById("enlace1").classList.add("activeEnlace");
    } else if (URLactual.includes("contacto")) {
      document.getElementById("enlace2").classList.add("activeEnlace");
    } else if (URLactual.includes("datos_personales")) {
      document.getElementById("enlace3").classList.add("activeEnlace");
      document.getElementById("enlace0").classList.add("activarContenido");
    } else if (URLactual.includes("gestionar_usuarios")) {
      document.getElementById("enlace4").classList.add("activeEnlace");
    } else if (URLactual.includes("reservar_pista")) {
      document.getElementById("enlace5").classList.add("activeEnlace");
    }
  }
});
