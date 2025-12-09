export {
  getLink,
  exportar_listados,
  Resumen,
  getNroCotizaciones,
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

function getNroCotizaciones(){
  const formData = new FormData();
    formData.append("action", "conteo");

    fetch(api + "cotizacionAjax.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        document.getElementById("nro").value = data;
      });
}
