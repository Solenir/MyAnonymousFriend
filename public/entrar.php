<?php
$login = (isset($_COOKIE['Login'])) ? ($_COOKIE['Login']) : '';
$senha = (isset($_COOKIE['Senha'])) ? ($_COOKIE['Senha']) : '';
$lembrete = (isset($_COOKIE['Lembrete'])) ?($_COOKIE['Lembrete']) : '';
$checked = ($lembrete == 'SIM') ? 'checked' : '';
require_once("topoPreLogin.php");

?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Anonymous Friend</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <script>
  	$(document).ready(function() { // Espera o DOM carregar
      $('#loginForm').submit(function(ev) {
          ev.preventDefault(); // Para a subimissão do formulário
          // Captura inputs do formulário


          var inputLogin = $(this).find('input[name="login"]').val();
          var inputSenha = $(this).find('input[name="senha"]').val();
          var inputCheck = $(this).find('input[name="lembrar"]').val();

          // Monta os parâmentos para a requisição
          var request = { botaoEntrar: "botaoEntrar", login: inputLogin, senha: inputSenha, lembrete: inputCheck};

          $.ajax({ // Faz requisição no servidor
            url : "api/v1/rotas.php",
            type: "post",
            data : request,
			/* Esta callback é chamada se o login ocorrer com sucesso */
            success: function(data, textStatus, jqXHR) {

             window.location.href = "index.php";

            },
			/* Está callback é chamada se ocorrer falha de login */
            error: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR.status == 401)
                    $('.alerta').html('<div class="alert alert-danger" id="erroLogin"> <strong> Atenção!</strong> Login e/ou senha incorretos.</div>');

                else
                    if(jqXHR.status == 400) {
                        $('.alerta').html('<div class="alert alert-danger" id="erroLogin"> <strong> Atenção!</strong> Preencha os campos obrigatórios.</div>');
                    }
            }
          });
      });
  	});
    </script>


</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- header-end -->
        <!-- header-end -->
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>My Anonymous Friend</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

<section class="contact-section section_padding">

      <div class="row">
        <div class="col-md-4 col-md-offset-4 login" >
            <div class="panel-body">
                <div class="panel-title">
                    <h4 class="panel-title" id="entrarH4">Entrar</h4>

                </div>
                <div class="panel-heading">

                </div>

                <form  method="post" role="form" id="loginForm" data-toggle="validator">
                    <div class="alerta"></div>
                    <fieldset>

                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="" aria-hidden="true" ></i>
                                </div>
                                <input class="form-control" value="" id="login" name="login" type="text" placeholder="Seu login" data-error="Por favor, informe um login." required/>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>


                        <div class="form-group">

                            <div class="input-group">

                                <div class="input-group-addon">
                                    <i class="" aria-hidden="true"></i>
                                </div>
                                <input class="form-control"  name="senha" type="password" placeholder="Senha" data-error="Por favor, informe sua senha."required/>


                            </div>
                            <div class="help-block with-errors"></div>

                        </div>



                        <div class="checkbox">
                            <label>
                                <input name="lembrar" type="checkbox" value="SIM" <?=$checked?>Lembre-me
                            </label>
                            <a href="recuperarSenha.php" id="esqueceu">&nbsp;&nbsp;&nbsp;&nbsp;Esqueceu sua senha?</a>

                        </div>

                        <input class="btn btn-lg btn-success btn-block" id="entrar" name="entrar" type="submit" value="Entrar">
                    </fieldset>
                </form>
                <hr/>
                </br>
                <div class="form-group">

                    <div class="input-group">
                        <p>Não possui cadastro? <a href="cadastro.php">cadastre-se aqui!</a></p>
                    </div>
                </div>



            </div>


        </div>
      </div>

  </section>
  <!-- ================ contact section end ================= -->
  <!-- footer start -->
  <footer class="footer">
      <div class="footer_top">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-xl-6 col-md-6">
                      <div class="menu_links">
                          <ul>
                              <li><a href="#">Sobre/li>
                              <li><a href="#">Serviços</a></li>
                              <li><a href="#">Portfólio</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <div class="socail_links">
                          <ul>
                              <li><a href="https://www.facebook.com/My-Anonymous-Friend-100669234903255"> <i class="fa fa-facebook"></i> </a></li>
                              <li><a href="https://twitter.com/MyAnonymousFri1"> <i class="fa fa-twitter"></i> </a></li>
                              <li><a href="https://www.instagram.com/myanonymousfriend.uefs/"> <i class="fa fa-instagram"></i> </a></li>
                              <li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="copy-right_text">
          <div class="container">
              <div class="footer_border"></div>
              <div class="row">
                  <div class="col-xl-12">
                      <p class="copy_right text-center">
                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!--/ footer end  -->


  <!-- JS here -->
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/ajax-form.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/scrollIt.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nice-select.min.js"></script>
  <script src="js/jquery.slicknav.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/gijgo.min.js"></script>

  <!--contact js-->
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>

  <script src="js/main.js"></script>
</body>

</html>
