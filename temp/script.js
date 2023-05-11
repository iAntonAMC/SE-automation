function enviarPeticion() {
    const htmlcode = document.querySelector('#editor').innerHTML;
    console.log(htmlcode);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("resultado").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "procesar.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("dato="+htmlcode);
  }
