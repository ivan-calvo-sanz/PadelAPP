/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
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
      console.log(response);
      const usuarios = JSON.parse(response);
      let template = "";
      usuarios.forEach((usuario) => {
        template += `
        <div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead" style="color:var(--azul);"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.adicional}</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> <b>DNI:</b> ${usuario.dni}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> <b>Edad:</b> ${usuario.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Residencia:</b> ${usuario.direccion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Teléfono:</b> ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> <b>Correro:</b> ${usuario.email}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> <b>Genero:</b> ${usuario.genero}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  BOTONES
                  </div>
                </div>
              </div>
            </div>
        </div>
            `;
      });
      document.getElementById("usuarios").innerHTML = template;
    });
  }
});
