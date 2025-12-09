import {
  getLink,
  exportar_listados,
  Resumen,
  getNroCotizaciones,
} from "./funtions.js";

if (document.getElementById("login-form")) {
  document
    .getElementById("login-form")
    .addEventListener("submit", function (e) {
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

if (document.getElementById("recovery-form")) {
  document
    .getElementById("recovery-form")
    .addEventListener("submit", function (e) {
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

if (document.getElementById("main")) {
  document.addEventListener("DOMContentLoaded", () => {
    getLink();

    if (document.querySelector(".home-resumen")) {
      Resumen();
    }

    if (document.querySelector(".exportar-listados")) {
      exportar_listados();
    }

    if (document.querySelector(".cotizar-form")) {
      getNroCotizaciones();
    }
  });
}
