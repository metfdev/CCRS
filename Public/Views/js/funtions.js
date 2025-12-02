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

