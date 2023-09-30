const contenedor = document.getElementById("contenedor");
const navLateral = document.getElementById("menu-lateral");
const btnContenedor = document.getElementById("boton-menu");
const enlaces = document.getElementsByClassName("enlace");

var btnMenu = false;

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

navLateral.addEventListener("mouseout", () => {
  if (!btnMenu) contenedor.classList.remove("active");
});
navLateral.addEventListener("mouseover", () => {
  if (!btnMenu) contenedor.classList.add("active");
});

for (let i = 0; i < enlaces.length; i++) {
  enlaces[i].addEventListener("click", activarEnlace);
}

function activarEnlace(e) {
  desactivarEnlace();
  e.target.classList.add("active");
}

function desactivarEnlace() {
  for (let i = 0; i < enlaces.length; i++) {
    enlaces[i].classList.remove("active");
  }
}

/* ******************** 
MEDIAQUERIES JS
******************** */
/* *** ANCHO PANTALLA MAX 768px *** */
/* detecto cuando se cambia el tamaño del ancho de la pantalla */
// hago que el navegador este oculto //
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

comprobarAncho();

window.addEventListener("resize", () => {
  comprobarAncho();
});
