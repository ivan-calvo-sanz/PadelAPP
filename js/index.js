/*  ocultar contraseña  */
const iconoOjo = document.getElementById("login-eye");
const inputPass = document.getElementById("login-pass");

iconoOjo.addEventListener("click", cambiar);
function cambiar() {
  if (inputPass.getAttribute("type") == "password") {
    inputPass.setAttribute("type", "text");
    iconoOjo.classList.add("ri-eye-line");
    iconoOjo.classList.remove("ri-eye-off-line");
  } else {
    inputPass.setAttribute("type", "password");
    iconoOjo.classList.add("ri-eye-off-line");
    iconoOjo.classList.remove("ri-eye-line");
  }
}
