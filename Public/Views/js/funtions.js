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

});

}

function getLink() {
  link = window.location.href;
  url = link.split("/");
  desactive = document.querySelector(".aside-enlace-Active");
  desactive.classList.remove("aside-enlace-Active");
  select = document.querySelector("#" + url[4]);
  select.classList.add("aside-enlace-Active");
}



