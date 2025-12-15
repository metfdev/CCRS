export {
  getLink,
  exportar_listados,
  Resumen,
  getNroCotizaciones,
  add_repuestos_a_cotizar,
  delete_item,
  cotizar,
};

const api = "./Api/";

/**
 * @description Funcion para detectar link de aside
 * @var string link, desactive, select
 * @var array url
 *
 * @return void
 */
function getLink() {
  let link = window.location.href;
  let url = link.split("/");
  let desactive = document.querySelector(".aside-enlace-Active");
  desactive.classList.remove("aside-enlace-Active");
  let select = document.querySelector("#" + url[4]);
  select.classList.add("aside-enlace-Active");
}

/**
 * @description Funcion para exportar los listados de las cotizaciones en formato pdf
 * @var string datos
 * @var array listados
 * @var string id, marca, modelo, ano, version, precio
 * @var FormData formData - Envio de datos
 *
 * @return void
 */
function exportar_listados() {
  let datos = document.getElementById("tbody-listados");

  let listados = [];

  for (let i = 0; i < datos.children.length; i++) {
    listados.push({
      id: datos.children[i].children[0].innerHTML,
      marca: datos.children[i].children[1].innerHTML,
      modelo: datos.children[i].children[2].innerHTML,
      ano: datos.children[i].children[3].innerHTML,
      version: datos.children[i].children[4].innerHTML,
      precio: datos.children[i].children[5].innerHTML,
    });
  }

  const formData = new FormData();
  formData.append("listados", JSON.stringify(listados));

  fetch("./libraries/pdf/listados-pdf.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.blob())
    .then((blob) => {
      let url = window.URL.createObjectURL(blob);
      let a = document.createElement("a");
      a.href = url;
      a.download = "listados.pdf";
      a.click();
    });
}

/**
 * @description Funcion para obtener el resumen de las cotizaciones
 * @var FormData formData - Envio de datos
 *
 * @return void
 *
 */
function Resumen() {
  const formData = new FormData();
  formData.append("action", "resumen");

  fetch(api + "cotizacionAjax.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("pendientes").innerHTML = data.pendiente;
      document.getElementById("aprobadas").innerHTML = data.aprobado;
      document.getElementById("rechazadas").innerHTML = data.rechazado;
    });
}

/**
 * @description Funcion para obtener el resumen de las cotizaciones
 * @var FormData formData - Envio de datos
 *
 * @return void
 */
function getNroCotizaciones() {
  const formData = new FormData();
  formData.append("action", "conteo");

  fetch(api + "cotizacionAjax.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      return (document.getElementById("nro").value = data);
    });
}

/**
 * @description Funcion para agregar repuestos a la cotizacion
 * @var string nroParte, nombre, cantidad
 * @var array repuestos, repuestos_guardado
 *
 * @return void
 *
 */
function add_repuestos_a_cotizar() {
  let repuestos = [];
  let repuestos_guardado = localStorage.getItem("repuestos");

  let nroParte = document.getElementById("nroparte").value;
  let nombre = document.getElementById("nombre").value;
  let cantidad = document.getElementById("cantidad").value;

  if (repuestos_guardado) {
    repuestos_guardado = JSON.parse(repuestos_guardado);
    repuestos_guardado.push({
      nroParte: nroParte,
      nombre: nombre,
      cantidad: cantidad,
    });
    repuestos = repuestos_guardado;
  } else {
    repuestos.push({
      nroParte: nroParte,
      nombre: nombre,
      cantidad: cantidad,
    });
  }

  localStorage.setItem("repuestos", JSON.stringify(repuestos));

  document.getElementById("tbody_cotizacion_repuestos").innerHTML += `
    <tr>
      <td>${nroParte}</td>
      <td>${nombre}</td>
      <td>${cantidad}</td>
      <td>
        <button id="${nroParte}" class="button-eliminar-repuestos">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>
  `;

  document.getElementById("nroparte").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("cantidad").value = "";
}

/**
 * @description funcion para eliminar item de la tabla de repuestos a cotizar
 * @param {string} nroParte
 * @var string nroParte - Informacion del nro de parte
 * @var string button - Informacion del boton
 * @var array repuestos_guardado - Informacion de los repuestos guardados en el localStorage
 * @var array repuestos_actualizados - Informacion de los repuestos actualizados
 *
 * @return void
 */
function delete_item(nroParte) {
  let button = document.querySelector(`button[id="${nroParte}"]`);
  if (button) {
    button.parentElement.parentElement.remove();
  }

  let repuestos_guardado = localStorage.getItem("repuestos");

  if (repuestos_guardado) {
    repuestos_guardado = JSON.parse(repuestos_guardado);

    let repuestos_actualizados = repuestos_guardado.filter(
      (repuesto) => repuesto.nroParte !== nroParte
    );

    localStorage.setItem("repuestos", JSON.stringify(repuestos_actualizados));
  }
}

function cotizar(dataCotizacion) {
  let formData = new FormData();
  formData.append("action", "registrar");
  formData.append("fecha", dataCotizacion[0]["fecha"]);
  formData.append("id_cotizacion", dataCotizacion[0]["nro_cotizacion"]);
  formData.append("solicitante", dataCotizacion[0]["solicitante"]);
  formData.append("cliente", dataCotizacion[0]["cliente"]);
  formData.append("modelo", dataCotizacion[0]["modelo"]);
  formData.append("ano", dataCotizacion[0]["ano"]);
  formData.append("placa", dataCotizacion[0]["placa"]);
  formData.append("vin", dataCotizacion[0]["vin"]);
  formData.append("repuestos", JSON.stringify(dataCotizacion[0]["repuestos"]));
  formData.append("notas", dataCotizacion[0]["notas"]);
  formData.append("departamento", dataCotizacion[0]["dpto"]);

  fetch(api + "cotizacionAjax.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.icono == "success") {
        alertas_ajax(data);
        setTimeout(() => {
          window.location.href = "./cotizar";
        }, 1500);
      }else{
        alertas_ajax(data);
      }
    });
}
