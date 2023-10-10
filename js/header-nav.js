const contenedor = document.getElementById("contenedor");
const navLateral = document.getElementById("menu-lateral");
const btnContenedor = document.getElementById("boton-menu");

var btnMenu = true;

/* ACTIVAR Y ACTUALIZAR <a> SELECCIONADO */
actualizarEnlace();

function actualizarEnlace() {
  let URLactual = window.location.href;
  if (URLactual.includes("home_root")) {
    document.getElementById("enlace1").classList.add("active");
  } else if (URLactual.includes("reservar_pista")) {
    document.getElementById("enlace2").classList.add("active");
  } else if (URLactual.includes("datos_personales")) {
    document.getElementById("enlace3").classList.add("active");
  } else if (URLactual.includes("usuarios")) {
    document.getElementById("enlace4").classList.add("active");
  }
}

/* ACTIVAR Y DESACTIVAR BOTON MENU */
btnContenedor.addEventListener("click", () => {
  // si ya tiene la clase "active" se la quita y si NO la tiene se la pone
  // la clase "active" modifica el tamaño width del nav
  contenedor.classList.toggle("active");
  if (btnMenu == true) {
    btnMenu = false;
    btnContenedor.classList.remove("active");
  } else if (btnMenu == false) {
    btnMenu = true;
    btnContenedor.classList.add("active");
  }
});

/* ACTIVAR Y DESACTIVAR MENU LATERAL */
navLateral.addEventListener("mouseout", () => {
  if (!btnMenu) contenedor.classList.remove("active");
});
navLateral.addEventListener("mouseover", () => {
  if (!btnMenu) contenedor.classList.add("active");
});

/* MEDIAQUERIES JS */
/* *** ANCHO PANTALLA MAX 768px *** */
/* detecto cuando se cambia el tamaño del ancho de la pantalla */
// hago que el navegador este oculto //
comprobarAncho();

window.addEventListener("resize", () => {
  comprobarAncho();
});

const comprobarAncho = () => {
  if (window.innerWidth <= 768) {
    contenedor.classList.remove("active");
    btnMenu = false;
    btnContenedor.classList.remove("active");
  } else {
    contenedor.classList.add("active");
    btnMenu = true;
    btnContenedor.classList.add("active");
  }
};
