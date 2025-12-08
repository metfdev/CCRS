if (document.getElementById("login-form")){
  document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append("action", "login");

    fetch("./Api/loginAjax.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        const json = JSON.parse(data);

        if (json.icono == "success") {
          alertas_ajax(json);
          setTimeout(() => {
            window.location.href = "./home";
          }, 1500);
        } else {
          alertas_ajax(json);
        }
      });
  });

}

if (document.getElementById("recovery-form")){
  document.getElementById("recovery-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append("action", "recovery");

    fetch("./Api/loginAjax.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        const json = JSON.parse(data);

        console.log(json);

        // if (json.icono == "success") {
        //   alertas_ajax(json);
        //   setTimeout(() => {
        //     window.location.href = "./login";
        //   }, 1500);
        // } else {
        //   alertas_ajax(json);
        // }
      });
  });
}

if(document.getElementById("main")){
document.addEventListener("DOMContentLoaded", () => {
  getLink();

  document.getElementById("exportar-listados").addEventListener("click", exportar_listados);



});

}

/**
 * @description Funcion para detectar link de aside
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
 *
 */
function exportar_listados() {

  let datos = document.getElementById("tbody-listados");

  let listados = [];

  for (let i = 0; i < datos.children.length; i++) {
    listados.push({
      "id": datos.children[i].children[0].innerHTML,
      "marca": datos.children[i].children[1].innerHTML,
      "modelo": datos.children[i].children[2].innerHTML,
      "ano": datos.children[i].children[3].innerHTML,
      "version": datos.children[i].children[4].innerHTML,
      "precio": datos.children[i].children[5].innerHTML,
    });
  }

  formData = new FormData();
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


