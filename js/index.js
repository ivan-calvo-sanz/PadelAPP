/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  /*  ocultar contraseña  */
  const iconoOjo = document.getElementById("login-eye");
  const inputPass = document.getElementById("login-pass");

  iconoOjo.addEventListener("click", cambiar);
  function cambiar() {
    if (inputPass.getAttribute("type") == "password") {
      inputPass.setAttribute("type", "text");
      iconoOjo.classList.add("fa-eye");
      iconoOjo.classList.remove("fa-eye-slash");
    } else {
      inputPass.setAttribute("type", "password");
      iconoOjo.classList.remove("fa-eye");
      iconoOjo.classList.add("fa-eye-slash");
    }
  }
});
