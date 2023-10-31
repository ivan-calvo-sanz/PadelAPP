/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  vaciar();
  document.getElementById("borrar_reserva").addEventListener("click", borrarReserva);

  var funcion = "";
  var hora = "";

  var fecha = new Date();

  var formato_fecha = fecha.toLocaleDateString();
  //console.log(formato_fecha);
  formato_fecha = formato_fecha.replaceAll("/", "-");
  document.getElementById("fecha").innerHTML = formato_fecha;

  document.getElementById(">").addEventListener("click", sumarDia);
  document.getElementById("<").addEventListener("click", restarDia);
  function sumarDia() {
    hora = "";
    vaciar();
    quitarRellenoBotones();
    controlarEstadoPista("A", -1);
    controlarEstadoPista("B", -1);
    controlarEstadoPista("C", -1);
    fecha.setDate(fecha.getDate() + 1);
    //console.log(fecha.toLocaleDateString());
    formato_fecha = fecha.toLocaleDateString();
    formato_fecha = formato_fecha.replaceAll("/", "-");
    document.getElementById("fecha").innerHTML = formato_fecha;
  }
  function restarDia() {
    hora = "";
    vaciar();
    quitarRellenoBotones();
    controlarEstadoPista("A", -1);
    controlarEstadoPista("B", -1);
    controlarEstadoPista("C", -1);
    fecha.setDate(fecha.getDate() - 1);
    //console.log(fecha.toLocaleDateString());
    formato_fecha = fecha.toLocaleDateString();
    formato_fecha = formato_fecha.replaceAll("/", "-");
    document.getElementById("fecha").innerHTML = formato_fecha;
  }

  // dar evento a botones hora
  let botones_hora = document.getElementsByClassName("btn-hora");
  for (i = 0; i < botones_hora.length; i++) {
    botones_hora[i].addEventListener("click", consultarHora);
  }

  function rellenarVacio(nombreJugador, pista, avatar, nivel) {
    if (pista === "A") {
      let nombres = document.getElementsByClassName("jugadorNombreA");
      let avatars = document.getElementsByClassName("avatarsA");
      let niveles = document.getElementsByClassName("jugadorNivelA");
      recorre(nombres, avatars, niveles);
    }

    if (pista === "B") {
      let nombres = document.getElementsByClassName("jugadorNombreB");
      let avatars = document.getElementsByClassName("avatarsB");
      let niveles = document.getElementsByClassName("jugadorNivelB");
      recorre(nombres, avatars, niveles);
    }

    if (pista === "C") {
      let nombres = document.getElementsByClassName("jugadorNombreC");
      let avatars = document.getElementsByClassName("avatarsC");
      let niveles = document.getElementsByClassName("jugadorNivelC");
      recorre(nombres, avatars, niveles);
    }

    function recorre(nombres, avatars, niveles) {
      for (i = 0; i < nombres.length; i++) {
        let reservado = nombres[i].getAttribute("reservado");
        if (reservado == "no") {
          nombres[i].setAttribute("reservado", "si");
          nombres[i].innerHTML = nombreJugador;
          niveles[i].innerHTML = nivel;
          nombres[i].classList.add("text-danger");
          avatars[i].src = "../img/" + avatar;
          avatars[i].addEventListener("click", reservar);
          //avatars[i].removeEventListener("click", reservar);
          break;
        }
      }
    }
  }

  function vaciar() {
    let nombres = document.getElementsByClassName("jugadorNombreA");
    let avatars = document.getElementsByClassName("avatarsA");
    let niveles = document.getElementsByClassName("jugadorNivelA");
    recorre(nombres, avatars, niveles);
    nombres = document.getElementsByClassName("jugadorNombreB");
    avatars = document.getElementsByClassName("avatarsB");
    niveles = document.getElementsByClassName("jugadorNivelB");
    recorre(nombres, avatars, niveles);
    nombres = document.getElementsByClassName("jugadorNombreC");
    avatars = document.getElementsByClassName("avatarsC");
    niveles = document.getElementsByClassName("jugadorNivelC");
    recorre(nombres, avatars, niveles);

    function recorre(nombres, avatars, niveles) {
      for (i = 0; i < nombres.length; i++) {
        nombres[i].setAttribute("reservado", "no");
        nombres[i].classList.remove("text-danger");
        nombres[i].innerHTML = "libre";
        niveles[i].innerHTML = "-";
        avatars[i].addEventListener("click", reservar);
        avatars[i].src = "../img/avatar_transparente.png";
      }
    }
  }

  function quitarRellenoBotones() {
    let botones_hora = document.getElementsByClassName("btn-hora");
    for (i = 0; i < botones_hora.length; i++) {
      botones_hora[i].classList.remove("btn-warning");
      botones_hora[i].classList.add("btn-outline-warning");
    }
  }

  // FUNCION: READ a la BBDD
  function consultarHora(e) {
    //console.log(e.target);
    //quitarRellenoBotones();
    //console.log(e);
    if (e !== undefined) {
      quitarRellenoBotones();
      e.target.classList.remove("btn-outline-warning");
      e.target.classList.add("btn-warning");
      hora = e.target.getAttribute("hora");
    }

    funcion = "consultarReservas";
    $.post("../controlador/ReservaController.php", { funcion, formato_fecha, hora }, (response) => {
      console.log(response);

      const reservas = JSON.parse(response);

      vaciar();
      reservas.forEach((reserva) => {
        rellenarVacio(reserva.nombreJugador, reserva.pista, reserva.avatar, reserva.nivelString);
      });
    });

    funcion = "estadoPistas";
    $.post("../controlador/ReservaController.php", { funcion, formato_fecha, hora }, (response) => {
      const estadoPistas = JSON.parse(response);
      console.log(estadoPistas);
      //console.log(estadoPistas["contReservasPistaA"]);
      //console.log(estadoPistas["contReservasPistaB"]);
      //console.log(estadoPistas["contReservasPistaC"]);
      controlarEstadoPista("A", estadoPistas["contReservasPistaA"]);
      controlarEstadoPista("B", estadoPistas["contReservasPistaB"]);
      controlarEstadoPista("C", estadoPistas["contReservasPistaC"]);
    });
  }

  function controlarEstadoPista(pista, contReservasPista) {
    //console.log(pista);
    //console.log(contReservasPista);
    let h3;
    if (pista == "A") {
      h3 = document.getElementById("estado_pista_A");
    } else if (pista == "B") {
      h3 = document.getElementById("estado_pista_B");
    } else if (pista == "C") {
      h3 = document.getElementById("estado_pista_C");
    }

    let div = h3.parentNode;
    div.classList.remove("bg-warning", "bg-primary", "bg-success", "bg-dark");
    if (contReservasPista < 0) {
      div.classList.add("bg-warning");
      h3.innerHTML = "Seleccione hora";
    } else if (contReservasPista == 0) {
      div.classList.add("bg-primary");
      h3.innerHTML = "PISTA LIBRE";
    } else if (contReservasPista < 4) {
      div.classList.add("bg-success");
      h3.innerHTML = "PISTA ABIERTA";
    } else if (contReservasPista == 4) {
      div.classList.add("bg-dark");
      h3.innerHTML = "PISTA COMPLETA";
    }
  }

  // FUNCION: REMOVE a la BBDD
  function borrarReserva() {
    //console.log("borrar reserva");
    funcion = "borrar_reserva";
    if (hora != "") {
      $.post("../controlador/ReservaController.php", { funcion, formato_fecha, hora }, (response) => {
        console.log(response);
        if (response == "tienes_reserva") {
          consultarHora();
          vaciar();

          let spanFlotante = document.getElementById("span_reserva_borrada");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        } else if (response == "no_tienes_reserva") {
          let spanFlotante = document.getElementById("span_no_tienes_reserva");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        }
      });
    } else {
      let spanFlotante = document.getElementById("span_selecciona_hora");
      spanFlotante.style.display = "";
      setTimeout(cerrar, 3000);
      function cerrar() {
        spanFlotante.style.display = "none";
      }
    }
  }

  // FUNCION: INSERT a la BBDD
  function reservar(e) {
    funcion = "reservar";

    let img = e.target;
    let pista;

    if (img.classList.contains("avatarsA")) {
      pista = "A";
    } else if (img.classList.contains("avatarsB")) {
      pista = "B";
    } else if (img.classList.contains("avatarsC")) {
      pista = "C";
    }

    //replace( oldClass, newClass )
    console.log(hora);
    //contains(String);
    //*** Controlar que el usuario ha seleccionado hora ***
    if (hora != "") {
      $.post("../controlador/ReservaController.php", { funcion, formato_fecha, hora, pista }, (response) => {
        if (response == "pista_completa") {
          let spanFlotante = document.getElementById("span_pista_completa");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        }
        if (response == "reservada") {
          let spanFlotante = document.getElementById("span_pista_reservada");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        }
        if (response == "existe_reserva") {
          let spanFlotante = document.getElementById("span_existe_reserva");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        }

        //console.log(response);
        consultarHora();
      });
    } else {
      let spanFlotante = document.getElementById("span_selecciona_hora");
      spanFlotante.style.display = "";
      setTimeout(cerrar, 3000);
      function cerrar() {
        spanFlotante.style.display = "none";
      }
    }
  }
});
