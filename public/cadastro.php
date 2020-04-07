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
    <script src="js/jquery-3.1.1.min.js"></script>

      <script>

            $(document).ready(function() { // Espera o DOM carregar


                $('form#cadastro-form').submit(function(ev) {
                    ev.preventDefault(); // Para a subimissão do formulário

                    // Captura inputs do formulário

                    var inputNome = $(this).find('input[name="nome"]').val();
                    var inputLogin = $(this).find('input[name="email"]').val();
                    var inputSenha1 = $(this).find('input[name="senha1"]').val();
                    var inputSenha2 = $(this).find('input[name="senha2"]').val();


                    // Monta os parâmentos para a requisição
                    var request = {botaoCadastro: "botaocadastro", nome: inputNome, login: inputLogin, senha: inputSenha1,senha2: inputSenha2}

                    $.ajax({ // Faz requisição no servidor

                        url : "api/v1/rotas.php",
                        type: "post",
                        data : request,

                        success: function(data, textStatus, jqXHR) {

                          $('.alerta').html(data);

                            //window.location.href = "index.php";

                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                            if (jqXHR.status == 500){
                              $('.alerta').html('<div class="alert alert-danger" id="erroCadastro"> <strong> Atenção!</strong> Já existe um usuário com este Login.</div>');

                            }
                            else{
                              if(jqXHR.status == 400)
                                   $('.alerta').html('<div class="alert alert-danger" id="erroCadastro"> <strong> Atenção!</strong> Preencha todos os campos corretamente.</div>');


                            }


                        }
                    });

                });
            });
        </script>

</head>

<body>

  <?php
  $login = (isset($_COOKIE['Login'])) ? ($_COOKIE['Login']) : '';
  $senha = (isset($_COOKIE['Senha'])) ? ($_COOKIE['Senha']) : '';
  $lembrete = (isset($_COOKIE['Lembrete'])) ?($_COOKIE['Lembrete']) : '';
  $checked = ($lembrete == 'SIM') ? 'checked' : '';
  require_once("topoPreLogin.php");

  ?>
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
            <div style="margin-left: 120%;
            width: 80%;
            background: #fff;
            border: 1px solid #a0a0a0;
            padding: 10px;" class="panel-body">
               <div class="panel-title">

                <h4 class="panel-title">Cadastro</h4>
                </div>
                <div class="panel-heading">
                </div>

                <form  method="post" role="form" id="cadastro-form" data-toggle="validator">
                    <div class="alerta">

                   </div>
                <fieldset>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="" aria-hidden="true"></i>
                        </div>
                        <input class="form-control"  name="nome" type="text" placeholder="*Seu nome"  required/>
                    </div>
                </div>


                <div class="form-group">

                    <div class="input-group">

                   <div class="input-group-addon">
                    <i class="" aria-hidden="true"></i>
                    </div>
                    <input class="form-control" id="email" name="email" type="*Seu Login - Email" placeholder="Seu email para acessar a plataforma">

                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <div class="input-group senha">
                    <div class="input-group-addon ">
                    <i class="" aria-hidden="true"></i>
                    </div>
                        <input class="form-control" id="senha" name="senha1" type="password" placeholder="*Senha" data-minlength="6"  required/>
                    </div>

                    <span class="help-block"><small>Mínimo de seis (6) digitos</small></span>
                </div>

                <div class="form-group">
                    <div class="input-group senha">
                    <div class="input-group-addon ">
                    <i class="" aria-hidden="true"></i>
                    </div>
                    <input class="form-control" id="senha" name="senha2" type="password" placeholder="*Confirme sua senha" data-match="#senha"
                           data-match-error="Atenção! As senhas não estão iguais." data-error=" " required/>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>


                <p id="obrigatorio">* Campos obrigatórios</p>
                <input class="btn btn-lg btn-success btn-block cadastro"   name="cadastrar" type="submit" value="Cadastrar">

                </fieldset>
                </form>
                <hr/>
                </br>
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
  <script src="js/jquery-3.1.1.min.js"></script>

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
