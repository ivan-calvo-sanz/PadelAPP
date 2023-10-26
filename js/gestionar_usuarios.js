/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  /* Recojo el dato que envio desde php mediante un input oculto */
  var rol_usuario = document.getElementById("rol_usuario").value;
  console.log(rol_usuario);

  /* EVENTO "keyup" AL PULSAR UNA TECLA SOBRE EL "buscador" */
  document.getElementById("buscar").addEventListener("keyup", editar, false);
  buscar_datos();
  function editar() {
    //console.log("pulsado");
    let valor = document.getElementById("buscar").value;

    if (valor != "") {
      //console.log(valor);
      buscar_datos(valor);
    } else {
      buscar_datos();
    }
  }

  /* FUNCION */
  /* Realiza peticion POST mediante AJAX para obtener los datos del Usuario */
  function buscar_datos(consulta) {
    funcion = "buscar_usuarios_cards";
    $.post("../controlador/UsuarioController.php", { funcion, consulta }, (response) => {
      //console.log(response);
      const cards = JSON.parse(response);

      if (cards.length == 1) {
        document.getElementById("numUsuarios").innerHTML = cards.length + " usuario encontrado";
      } else {
        document.getElementById("numUsuarios").innerHTML = cards.length + " usuarios encontrados";
      }
      let template = "";
      cards.forEach((card) => {
        template += `
        <div usuarioId="${card.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <div class="altura card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead nombreUsuario"><b>${card.nombre} ${card.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mí: </b> ${card.adicional}</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> <b>DNI:</b> ${card.dni}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> <b>Edad:</b> ${card.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Residencia:</b> ${card.direccion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Teléfono:</b> ${card.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> <b>Correro:</b> ${card.email}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> <b>Genero:</b> ${card.genero}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${card.avatar}" alt="user-avatar" class="img-circle img-fluid">
                      <span><class="small"> ${card.rolString}</span><br>
                      <span class="small"><b>Nivel:</b></span><span class="usuarioNivel"> ${card.nivelString}</span>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  `;

        /* BOTON ELIMINAR */
        /* solo tiene que aparecer si usuario tiene rol 1 (ROOT) o rol 2 (Administrador) * /
        /* si es rol logueado 1 puede eliminar cualquier usuario ya sea Administrador o Jugador */
        if (rol_usuario == 1 && card.rol != 1) {
          template += `<button class="eliminar btn btn-danger ml-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                                  <i class="fas fa-window-close mr-1"></i>Eliminar
                                  </button>`;
        }
        /* si es rol logueado 2 puede eliminar a usuario rol Jugador */
        if (rol_usuario == 2 && card.rol == 3) {
          template += `<button class="eliminar btn btn-danger ml-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                                  <i class="fas fa-window-close mr-1"></i>Eliminar
                                  </button>`;
        }

        /* BOTON ASCENDER */
        /* solo ROOT puede ascender a Jugador a Administrador */
        if (rol_usuario == 1 && card.rol == 3) {
          template += `<button class="ascenderAAdmin btn btn-success mr-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                        <i class="fas fa-sort-amount-up mr-1"></i>Administrador
                        </button>`;
        }
        /* BOTON DESSCENDER */
        /* solo ROOT puede descender a Administrador a Jugador */
        if (rol_usuario == 1 && card.rol == 2) {
          template += `<button class="descenderAJugador btn btn-warning ml-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                        <i class="fas fa-sort-amount-down mr-1"></i>Jugador
                        </button>`;
        }

        /* BAJAR NIVEL */
        /* ROOT y Administrador pueden bajar nivel a la Card */
        if ((rol_usuario == 1 || rol_usuario == 2) && card.nivelNum > 0) {
          template += `<button class="bajarNivel btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                        <i class="fa-solid fa-arrow-down fa-lg"></i> Bajar
                        </button>`;
        }

        /* SUBIR NIVEL */
        /* ROOT y Administrador pueden subir nivel a la Card */
        if ((rol_usuario == 1 || rol_usuario == 2) && card.nivelNum < 6) {
          template += `<button class="subirNivel btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar-contra">
                        Subir <i class="fa-solid fa-arrow-up fa-lg"></i> 
                        </button>
                        `;
        }

        template += `
                  </div>
                </div>
              </div>
            </div>
        </div>
            `;
      });
      document.getElementById("usuarios").innerHTML = template;

      /* EVENTO "click" A TODOS LOS BOTONES "Administrador" */
      let btnsAscenderAAdmin = document.getElementsByClassName("ascenderAAdmin");
      for (i = 0; i < btnsAscenderAAdmin.length; i++) {
        btnsAscenderAAdmin[i].addEventListener("click", ascenderAAdmin);
      }
      function ascenderAAdmin(e) {
        const elemento = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id_card = elemento.getAttribute("usuarioid");
        console.log(id_card);
        //envio datos a los campos ocultos del php
        document.getElementById("id_card").value = id_card;
        document.getElementById("funcion").value = "ascenderAAdmin";
      }

      /* EVENTO "click" A TODOS LOS BOTONES "Jugador" */
      let btnsDescenderAJugador = document.getElementsByClassName("descenderAJugador");
      for (i = 0; i < btnsDescenderAJugador.length; i++) {
        btnsDescenderAJugador[i].addEventListener("click", descenderAJugador);
      }
      function descenderAJugador(e) {
        const elemento = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id_card = elemento.getAttribute("usuarioid");
        console.log(id_card);
        //envio datos a los campos ocultos del php
        document.getElementById("id_card").value = id_card;
        document.getElementById("funcion").value = "descenderAJugador";
      }

      /* EVENTO "click" A TODOS LOS BOTONES "Eliminar" */
      let btnsEliminar = document.getElementsByClassName("eliminar");
      for (i = 0; i < btnsEliminar.length; i++) {
        btnsEliminar[i].addEventListener("click", eliminar);
      }
      function eliminar(e) {
        const elemento = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id_card = elemento.getAttribute("usuarioid");
        console.log(id_card);
        //envio datos a los campos ocultos del php
        document.getElementById("id_card").value = id_card;
        document.getElementById("funcion").value = "eliminarJugador";
      }

      /* EVENTO "click" A TODOS LOS BOTONES "Subir Nivel" */
      let btnsSubirNivel = document.getElementsByClassName("subirNivel");
      for (i = 0; i < btnsSubirNivel.length; i++) {
        btnsSubirNivel[i].addEventListener("click", subirNivel);
      }
      function subirNivel(e) {
        const elemento = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id_card = elemento.getAttribute("usuarioid");
        console.log(id_card);
        //envio datos a los campos ocultos del php
        document.getElementById("id_card").value = id_card;
        document.getElementById("funcion").value = "subirNivel";
      }

      /* EVENTO "click" A TODOS LOS BOTONES "Bajar Nivel" */
      let btnsBajarNivel = document.getElementsByClassName("bajarNivel");
      for (i = 0; i < btnsBajarNivel.length; i++) {
        btnsBajarNivel[i].addEventListener("click", bajarNivel);
      }
      function bajarNivel(e) {
        const elemento = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        const id_card = elemento.getAttribute("usuarioid");
        console.log(id_card);
        //envio datos a los campos ocultos del php
        document.getElementById("id_card").value = id_card;
        document.getElementById("funcion").value = "bajarNivel";
      }

      /* EVENTO "submit" FORMULARIO MODAL CONFIRMAR ACCION */
      document.getElementById("form-confirmar").addEventListener("submit", enviarForm, false);
      function enviarForm() {
        let pass = document.getElementById("pass").value;
        let id_card = document.getElementById("id_card").value;
        let funcion = document.getElementById("funcion").value;
        if (funcion != "") {
          $.post("../controlador/UsuarioController.php", { funcion, pass, id_card }, (response) => {
            /*             if (
              response == "ascendidoAAdmin" ||
              response == "descendidoAJugador" ||
              response == "eliminado" ||
              response == "nivelSubido" ||
              response == "nivelBajado"
            ) {
              
            } else {

            } */
          });
        }
      }
    });
  }

  /* FUNCION */
  /* CREAR USUARIO NUEVO */
  document.getElementById("form-crear").addEventListener("submit", crearUsuario, false);
  function crearUsuario(e) {
    let rol = document.getElementById("rol").value;
    let nivel = document.getElementById("nivel").value;
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let edad = document.getElementById("edad").value;
    let dni = document.getElementById("dni").value;
    let pass = document.getElementById("pass").value;

    funcion = "crear_usuario";
    $.post(
      "../controlador/UsuarioController.php",
      { funcion, nombre, apellidos, edad, dni, pass, rol, nivel },
      (response) => {
        console.log(response);
        if (response == "add") {
          buscar_datos();
          let spanFlotante = document.getElementById("add");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
            document.getElementById("form-crear").reset();
          }
        } else {
          let spanFlotante = document.getElementById("noadd");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 3000);
          function cerrar() {
            spanFlotante.style.display = "none";
          }
        }
      }
    );
    e.preventDefault();
  }
});
