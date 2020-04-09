<!--
//index.php
!-->

<?php

include('database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
 header("location:login.php");
}

?>

<html>
    <head>
        <title>My Anonymous Friend</title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <link rel="stylesheet" href="css/sty.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    </head>
    <body>

      <header>
          <div class="header-area ">
              <div id="sticky-header" class="main-header-area">
                  <div class="container-fluid">
                      <div class="row align-items-center">
                          <div class="col-xl-3 col-lg-2">
                              <div class="logo">
                                  <a style="color: white;" href="index.php" class="active">
                                      My Anonymous Friend <!-- <img src="img/logo.png" alt=""> -->
                                  </a>
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-7">
                              <div class="main-menu  d-none d-lg-block">
                                  <nav>
                                      <ul id="navigation">
                                          <li><a class="active" href="index.php">Início</a></li>
                                          <li><a href="about.html">Sobre</a></li>
                                          <li><a href="#">Blogs Relacionados <i class="ti-angle-down"></i></a>
                                              <ul class="submenu">
                                                  <li><a href="https://www.cvv.org.br/">CVV</a></li>
              <li><a href="https://psicoterapia.psc.br/blog/">Artur Scarpato</a></li>
                                                  <li><a href="https://saude.abril.com.br/tudo-sobre/ansiedade/">Tudo sobre ansiedade</a></li>
              <li><a href="https://www.vittude.com/blog/">Vittude</a></li>
                                              </ul>
                                          </li>
                                          <li><a href="#">Parceiros<i class="ti-angle-down"></i></a>
                                              <ul class="submenu">
                                                   <li><a href="portfolio.html">Sites</a></li>
                                                   <li><a href="elements.html">Elementos</a></li>
                                              </ul>
                                          </li>
                                          <li><a href="contact.html">Contato</a></li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>

                          <div class="col-sm d-none d-lg-block">
                              <div class="Appointment">
                                  <div class="book_btn d-none d-lg-block">
                                      <a  href="index2.php">Chat</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="mobile_menu d-block d-lg-none"></div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </header>










      <div class="bradcam_area bradcam_bg_1">
          <div class="container">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="bradcam_text text-center">
                          <h3>Mural de Desabafo</h3>
                      </div>
                  </div>
              </div>
          </div>
      </div>

        <div class="container">
   <br />


   <br />
   <div class="row">
    <div class="col-md-8 col-sm-6">
     <h4>Mural de Desabafo</h4>
    </div>
    <div class="col-md-2 col-sm-3">
    </div>
    <div class="col-md-2 col-sm-3">
     <p align="right">Olá - <?php echo $_SESSION['username']; ?> - <a href="logout.php">Sair</a></p>
    </div>
   </div>
   <div class="table-responsive">

    <div id="user_details"></div>
    <div id="user_model_details"></div>
   </div>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div style="display: block;">Conte-nos algo</div>
			<div id="texto_desabafo" contenteditable="true" style="width: 100%; overflow: auto; border: 1px solid rgb(221,221,221); padding: 5px; height: 100px;"></div>
			<input id="desabafo" type="submit" name="desabafar" class="btn btn-info" value="Desabafar" style="display: block; float: right; margin-top: 10px;">
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12" id="desabafos_content">


		</div>
	</div>
  </div>

    </body>
</html>

<style>
.desabafo {
	border: 1px solid rgb(221, 221, 221);
	padding: 20px;
	width: 100%;
	margin-top: 20px;
}
</style>

<script>
var desabafoElement = document.querySelector("#desabafo");

desabafo.addEventListener("click", function() {
    event.preventDefault();
    event.stopPropagation();

	var texto_desabafoElement = document.querySelector("#texto_desabafo");
	if (texto_desabafoElement.innerHTML != "") {
		var xhttp = new XMLHttpRequest();

       		 xhttp.onreadystatechange = function() {
            		if (xhttp.readyState === 4) {
                		if (xhttp.status === 200) {
                    			if(xhttp.responseText === "true") {
						texto_desabafoElement.innerHTML = "";
						alert("Desabafo publicado!");
					}
					else {
						console.log(xhttp.responseText);
					}
				}
			}
		}
		xhttp.open("POST", "desabafo.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send("desabafo="+texto_desabafoElement.innerHTML);
	}
	else {
		alert("Escreva algo antes de publicar");
	}



});
var desabafos_contetElement = document.querySelector("#desabafos_content");
setInterval(function(){

		var xhttp = new XMLHttpRequest();

       		 xhttp.onreadystatechange = function() {
            		if (xhttp.readyState === 4) {
                		if (xhttp.status === 200) {
					desabafos_contetElement.innerHTML = xhttp.responseText;
				}
			}
		}

		xhttp.open("GET", "desabafos.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send();


}, 2000);

</script>
