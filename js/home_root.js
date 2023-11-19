/* para que se ejecute el código JS una vez cargado todo el html */
$(document).ready(function () {
  /* RELLENAR DATOS CUADROS INICIALES */
  mostrar_datos();
  function mostrar_datos() {
    let funcion = "mostrar_datos_hoy";
    $.post("../controlador/ReservaController.php", { funcion }, (response) => {
      let reservasHoy = JSON.parse(response);
      console.log(reservasHoy);
      // ejemplo response:
      /* ["1", "0", "0", "1", "1", "1", "0", "0", "1", "1", "1", "0", "0", "1", "1"]; */

      let pistasCompletas = 0;
      reservasHoy.forEach((reserva) => {
        if (reserva == 4) pistasCompletas++;
      });
      //console.log(pistasCompletas);

      let pistasAbiertas = 0;
      reservasHoy.forEach((reserva) => {
        if (reserva > 0) pistasAbiertas++;
      });
      //console.log(pistasAbiertas);

      let plazasLibres = 60;
      reservasHoy.forEach((reserva) => {
        plazasLibres -= reserva;
      });
      //console.log(plazasLibres);

      document.getElementById("pistas_completas_hoy").innerHTML = pistasCompletas + "/15";
      document.getElementById("pistas_abiertas_hoy").innerHTML = pistasAbiertas + "/15";
      document.getElementById("plazas_libres_hoy").innerHTML = plazasLibres + "/60";
    });

    funcion = "mostrar_datos_mañana";
    $.post("../controlador/ReservaController.php", { funcion }, (response) => {
      let reservasHoy = JSON.parse(response);
      console.log(reservasHoy);
      // ejemplo response:
      /* ["1", "0", "0", "1", "1", "1", "0", "0", "1", "1", "1", "0", "0", "1", "1"]; */

      let pistasCompletas = 0;
      reservasHoy.forEach((reserva) => {
        if (reserva == 4) pistasCompletas++;
      });
      //console.log(pistasCompletas);

      let pistasAbiertas = 0;
      reservasHoy.forEach((reserva) => {
        if (reserva > 0) pistasAbiertas++;
      });
      //console.log(pistasAbiertas);

      let plazasLibres = 60;
      reservasHoy.forEach((reserva) => {
        plazasLibres -= reserva;
      });
      //console.log(plazasLibres);

      document.getElementById("pistas_completas_mañana").innerHTML = pistasCompletas + "/15";
      document.getElementById("pistas_abiertas_mañana").innerHTML = pistasAbiertas + "/15";
      document.getElementById("plazas_libres_mañana").innerHTML = plazasLibres + "/60";
    });

    funcion = "mostrar_datos_anuales_pasados";
    $.post("../controlador/ReservaController.php", { funcion }, (response) => {
      let reservasAnualesPasadas = JSON.parse(response);
      console.log(reservasAnualesPasadas);
      let pistasCompletasReservadasPasadas = 0;
      reservasAnualesPasadas.forEach((reserva) => {
        if (parseInt(reserva) == 4) {
          pistasCompletasReservadasPasadas++;
        }
      });
      console.log("pistas completas Reservadas Pasadas" + pistasCompletasReservadasPasadas);
      document.getElementById("pistas_reservadas_pasadas").innerHTML = pistasCompletasReservadasPasadas;
    });

    funcion = "mostrar_datos_anuales_futuros";
    $.post("../controlador/ReservaController.php", { funcion }, (response) => {
      let reservasAnualesFuturas = JSON.parse(response);
      console.log(reservasAnualesFuturas);
      let pistasCompletasReservadasFuturas = 0;
      reservasAnualesFuturas.forEach((reserva) => {
        if (parseInt(reserva) == 4) {
          pistasCompletasReservadasFuturas++;
        }
      });
      console.log("pistas completas Reservadas Futuras" + pistasCompletasReservadasFuturas);
      document.getElementById("pistas_reservadas_futuras").innerHTML = pistasCompletasReservadasFuturas;
    });
  }

  /* RELLENAR TABLA DINAMINA "datatable" */
  let funcion = "listar";
  let datatable = $("#tabla_reservas").DataTable({
    ajax: {
      url: "../controlador/ReservaController.php",
      method: "POST",
      data: { funcion: funcion },
    },
    columns: [
      { data: "id_reserva" },
      { data: "fecha" },
      { data: "hora" },
      { data: "pista" },
      { data: "usuario" },
      { data: "nombre" },
      { data: "telefono" },
      { data: "email" },
      {
        defaultContent: `
        <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_reserva"><i class="fas fa-search"></i></button>
        <button class="borrar btn btn-danger" type="button" data-toggle="modal" data-target="#eliminar_reserva"><i class="fas fa-window-close"></i></button>
        `,
      },
    ],
    language: espanol,
  });

  $("#tabla_reservas tbody").on("click", ".ver", function () {
    console.log("entra");
    let datos = datatable.row($(this).parents()).data();
    console.log(datos);
    let id_reserva = datos.id_reserva;
    let fecha = datos.fecha;
    let hora = datos.hora;
    let pista = datos.pista;

    document.getElementById("reserva").innerHTML = " " + id_reserva;
    document.getElementById("fecha").innerHTML = fecha + " ";
    document.getElementById("hora").innerHTML = " " + hora + " ";
    document.getElementById("pista").innerHTML = " " + pista;

    let funcion = "mostrarReserva";
    $.post("../controlador/ReservaController.php", { funcion, fecha, hora, pista }, (response) => {
      console.log(response);
      let reservas = JSON.parse(response);

      for (let i = 1; i <= 4; i++) {
        document.getElementById(`usuario${i}`).innerHTML = "";
        document.getElementById(`reserva${i}`).innerHTML = "";
        document.getElementById(`avatar${i}`).src = "../img/avatar_transparente.png";
        document.getElementById(`nombre${i}`).innerHTML = "";
        document.getElementById(`nivel${i}`).innerHTML = "";
        document.getElementById(`rol${i}`).innerHTML = "";
        document.getElementById(`email${i}`).innerHTML = "";
        document.getElementById(`tel${i}`).innerHTML = "";
      }

      let i = 1;
      reservas.forEach((reserva) => {
        document.getElementById(`usuario${i}`).innerHTML = reserva.usuario;

        document.getElementById(`reserva${i}`).innerHTML = "Reserva: " + reserva.id_reserva;

        document.getElementById(`avatar${i}`).src = "../img/" + reserva.avatar;

        document.getElementById(`nombre${i}`).innerHTML = reserva.nombre_apellidos;
        document.getElementById(`nivel${i}`).innerHTML = reserva.nombre_nivel;
        document.getElementById(`rol${i}`).innerHTML = reserva.nombre_rol;
        document.getElementById(`email${i}`).innerHTML = reserva.email;
        document.getElementById(`tel${i}`).innerHTML = reserva.telefono;
        i++;
      });
    });
  });

  $("#tabla_reservas tbody").on("click", ".borrar", function () {
    console.log("entra");
    let datos = datatable.row($(this).parents()).data();
    console.log(datos);
    console.log(datos.id_reserva);
    var id_reserva = datos.id_reserva;
    document.getElementById("reserva_2").innerHTML = " " + id_reserva;
    document.getElementById("fecha_2").innerHTML = " " + datos.fecha;
    document.getElementById("hora_2").innerHTML = " a las " + datos.hora;
    document.getElementById("pista_2").innerHTML = " en la pista " + datos.pista;

    document.getElementById("eliminarReserva").addEventListener("click", eliminar);
    function eliminar() {
      let funcion = "borrarReservaID";
      $.post("../controlador/ReservaController.php", { funcion, id_reserva }, (response) => {
        console.log(response);
        if (response == "reserva_borrada") {
          let spanFlotante = document.getElementById("alert_reserva_borrada");
          spanFlotante.style.display = "";
          setTimeout(cerrar, 2000);
          function cerrar() {
            spanFlotante.style.display = "none";
            location.reload();
          }
        }
      });
    }
  });
});

let espanol = {
  processing: "Procesando...",
  lengthMenu: "Mostrar _MENU_ registros",
  zeroRecords: "No se encontraron resultados",
  emptyTable: "Ningún dato disponible en esta tabla",
  infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  infoFiltered: "(filtrado de un total de _MAX_ registros)",
  search: "Buscar:",
  loadingRecords: "Cargando...",
  paginate: {
    first: "Primero",
    last: "Último",
    next: "Siguiente",
    previous: "Anterior",
  },
  aria: {
    sortAscending: ": Activar para ordenar la columna de manera ascendente",
    sortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
    collection: "Colección",
    colvisRestore: "Restaurar visibilidad",
    copyKeys:
      "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
    copySuccess: {
      1: "Copiada 1 fila al portapapeles",
      _: "Copiadas %ds fila al portapapeles",
    },
    copyTitle: "Copiar al portapapeles",
    csv: "CSV",
    excel: "Excel",
    pageLength: {
      "-1": "Mostrar todas las filas",
      _: "Mostrar %d filas",
    },
    pdf: "PDF",
    print: "Imprimir",
    renameState: "Cambiar nombre",
    updateState: "Actualizar",
    createState: "Crear Estado",
    removeAllStates: "Remover Estados",
    removeState: "Remover",
    savedStates: "Estados Guardados",
    stateRestore: "Estado %d",
  },
  autoFill: {
    cancel: "Cancelar",
    fill: "Rellene todas las celdas con <i>%d</i>",
    fillHorizontal: "Rellenar celdas horizontalmente",
    fillVertical: "Rellenar celdas verticalmente",
  },
  decimal: ",",
  searchBuilder: {
    add: "Añadir condición",
    button: {
      0: "Constructor de búsqueda",
      _: "Constructor de búsqueda (%d)",
    },
    clearAll: "Borrar todo",
    condition: "Condición",
    conditions: {
      date: {
        before: "Antes",
        between: "Entre",
        empty: "Vacío",
        equals: "Igual a",
        notBetween: "No entre",
        not: "Diferente de",
        after: "Después",
        notEmpty: "No Vacío",
      },
      number: {
        between: "Entre",
        equals: "Igual a",
        gt: "Mayor a",
        gte: "Mayor o igual a",
        lt: "Menor que",
        lte: "Menor o igual que",
        notBetween: "No entre",
        notEmpty: "No vacío",
        not: "Diferente de",
        empty: "Vacío",
      },
      string: {
        contains: "Contiene",
        empty: "Vacío",
        endsWith: "Termina en",
        equals: "Igual a",
        startsWith: "Empieza con",
        not: "Diferente de",
        notContains: "No Contiene",
        notStartsWith: "No empieza con",
        notEndsWith: "No termina con",
        notEmpty: "No Vacío",
      },
      array: {
        not: "Diferente de",
        equals: "Igual",
        empty: "Vacío",
        contains: "Contiene",
        notEmpty: "No Vacío",
        without: "Sin",
      },
    },
    data: "Data",
    deleteTitle: "Eliminar regla de filtrado",
    leftTitle: "Criterios anulados",
    logicAnd: "Y",
    logicOr: "O",
    rightTitle: "Criterios de sangría",
    title: {
      0: "Constructor de búsqueda",
      _: "Constructor de búsqueda (%d)",
    },
    value: "Valor",
  },
  searchPanes: {
    clearMessage: "Borrar todo",
    collapse: {
      0: "Paneles de búsqueda",
      _: "Paneles de búsqueda (%d)",
    },
    count: "{total}",
    countFiltered: "{shown} ({total})",
    emptyPanes: "Sin paneles de búsqueda",
    loadMessage: "Cargando paneles de búsqueda",
    title: "Filtros Activos - %d",
    showMessage: "Mostrar Todo",
    collapseMessage: "Colapsar Todo",
  },
  select: {
    cells: {
      1: "1 celda seleccionada",
      _: "%d celdas seleccionadas",
    },
    columns: {
      1: "1 columna seleccionada",
      _: "%d columnas seleccionadas",
    },
    rows: {
      1: "1 fila seleccionada",
      _: "%d filas seleccionadas",
    },
  },
  thousands: ".",
  datetime: {
    previous: "Anterior",
    hours: "Horas",
    minutes: "Minutos",
    seconds: "Segundos",
    unknown: "-",
    amPm: ["AM", "PM"],
    months: {
      0: "Enero",
      1: "Febrero",
      10: "Noviembre",
      11: "Diciembre",
      2: "Marzo",
      3: "Abril",
      4: "Mayo",
      5: "Junio",
      6: "Julio",
      7: "Agosto",
      8: "Septiembre",
      9: "Octubre",
    },
    weekdays: {
      0: "Dom",
      1: "Lun",
      2: "Mar",
      4: "Jue",
      5: "Vie",
      3: "Mié",
      6: "Sáb",
    },
    next: "Próximo",
  },
  editor: {
    close: "Cerrar",
    create: {
      button: "Nuevo",
      title: "Crear Nuevo Registro",
      submit: "Crear",
    },
    edit: {
      button: "Editar",
      title: "Editar Registro",
      submit: "Actualizar",
    },
    remove: {
      button: "Eliminar",
      title: "Eliminar Registro",
      submit: "Eliminar",
      confirm: {
        _: "¿Está seguro de que desea eliminar %d filas?",
        1: "¿Está seguro de que desea eliminar 1 fila?",
      },
    },
    error: {
      system:
        'Ha ocurrido un error en el sistema (<a target="\\" rel="\\ nofollow" href="\\">Más información&lt;\\/a&gt;).</a>',
    },
    multi: {
      title: "Múltiples Valores",
      restore: "Deshacer Cambios",
      noMulti: "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
      info: "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales.",
    },
  },
  info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
  stateRestore: {
    creationModal: {
      button: "Crear",
      name: "Nombre:",
      order: "Clasificación",
      paging: "Paginación",
      select: "Seleccionar",
      columns: {
        search: "Búsqueda de Columna",
        visible: "Visibilidad de Columna",
      },
      title: "Crear Nuevo Estado",
      toggleLabel: "Incluir:",
      scroller: "Posición de desplazamiento",
      search: "Búsqueda",
      searchBuilder: "Búsqueda avanzada",
    },
    removeJoiner: "y",
    removeSubmit: "Eliminar",
    renameButton: "Cambiar Nombre",
    duplicateError: "Ya existe un Estado con este nombre.",
    emptyStates: "No hay Estados guardados",
    removeTitle: "Remover Estado",
    renameTitle: "Cambiar Nombre Estado",
    emptyError: "El nombre no puede estar vacío.",
    removeConfirm: "¿Seguro que quiere eliminar %s?",
    removeError: "Error al eliminar el Estado",
    renameLabel: "Nuevo nombre para %s:",
  },
  infoThousands: ".",
};
