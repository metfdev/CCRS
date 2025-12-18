import {
  getLink,
  exportar_listados,
  Resumen,
  getNroCotizaciones,
  add_repuestos_a_cotizar,
  delete_item,
  cotizar,
  getDetalles,
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

      document
        .getElementById("cotizar-form")
        .addEventListener("submit", (e) => {
          e.preventDefault();
          let dataCotizacion = [
            {
              nro_cotizacion: document.getElementById("nro").value,
              solicitante: document.getElementById("id_solicitante").value,
              dpto: document.getElementById("dpto").value,
              fecha: document.getElementById("fecha").value,
              cliente: document.getElementById("cliente").value,
              modelo: document.getElementById("modelo").value,
              ano: document.getElementById("ano").value,
              placa: document.getElementById("placa").value,
              vin: document.getElementById("vin").value,
              repuestos: JSON.parse(localStorage.getItem("repuestos")),
              notas: document.getElementById("notas").value,
            },
          ];
          cotizar(dataCotizacion);
        });

      document
        .getElementById("button-agregar-repuestos")
        .addEventListener("click", (e) => {
          e.preventDefault();
          add_repuestos_a_cotizar();
          document
            .querySelectorAll(".button-eliminar-repuestos")
            .forEach((boton) => {
              boton.addEventListener("click", (e) => {
                e.preventDefault();
                delete_item(boton.getAttribute("id"));
              });
            });
        });
    }

    if (document.querySelector(".listados-section")) {
      let button = document.querySelectorAll(".button-detalle");
      let button_delete = document.querySelectorAll(".button-delete");
      button.forEach((boton) => {
        boton.addEventListener("click", (e) => {
          e.preventDefault();
          getDetalles(
            boton.getAttribute("ts-id"),
            boton.getAttribute("tl-tooltip")
          );
        });
      });
    }
  });
}
