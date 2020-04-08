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

    <link rel="stylesheet" href="css/balao.css">

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <?php
    if(!isset($_SESSION)){
        session_start();
    }

    if (isset($_SESSION['logado'])){
        $var = $_SESSION['ID_Usuario'];
        require_once('topoPosLogin.php');
    } else {
        require_once('topoPreLogin.php');

    }
    ?>




    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="shap_pattern d-none d-lg-block">
                <img src="img/about/grid.png" alt="">
            </div>
            <div class="social_links">
                <ul>
                    <li><a href="https://www.facebook.com/My-Anonymous-Friend-100669234903255"> <i class="fa fa-facebook"></i> </a></li>
                    <li><a href="https://twitter.com/MyAnonymousFri1"> <i class="fa fa-twitter"></i> </a></li>
                    <li><a href="https://www.instagram.com/myanonymousfriend.uefs/"> <i class="fa fa-instagram"></i> </a></li>
                </ul>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <h3>
                                Olá, você precisa desabafar?
                            </h3>
                            <span>Seu amigo anônimo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->


    <!-- service_area  -->
    <div class="service_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-65">
                        <span>MY ANONYMOUS FRIEND</span>
                        <h3>Converse de maneira anônima  <br>
                                com outras pessoas que desejam ouvir você</h3>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="single_service text-center">
                        <div class="icon">
                            <img src="img/svg_icon/1.svg" alt="">
                        </div>
                        <h3>Gratuito</h3>
                        <p>Cadastre-se e use de forma gratuita e convere com alguém para desabafar.<br><br><br><br></p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_service text-center">
                        <div class="icon">
                            <img src="img/svg_icon/2.svg" alt="">
                        </div>
                        <h3>Desabafe!</h3>
                        <p>Encontre pessoas para compartilhar os seus maiores problemas e sem se preocupar em revelar sua identidade!<br><br></p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_service text-center">
                        <div class="icon">
                            <img src="img/svg_icon/3.svg" alt="">
                        </div>
                        <h3>Ajude outras pessoas</h3>
                        <p>Ajude outra pessoas conversando com elas, ouvindo elas. Sua atenção e os seus conselhos podem tornar o dia de outra pessoa bem melhor.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="discuss_projects">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="project_text text-center">
                        <h3>Encontre alguém para desabafar!</h3>
                        <p>Aqui você pode encontrar tanto profissionais especializados, quanto pessoas dispostas a ouvi-lo sem julgamentos. <br>Vamos lá, não tenha medo! eles podem te ajudar.</p>
                        <a class="boxed-btn3" href="/pessoas.html">Buscar pessoas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--/ service_area  -->


        <!-- service_area  -->
        <div class="service_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center mb-65">
                            <span>MY ANONYMOUS FRIEND</span>
                            </div>
                    </div>
                </div>
                <div class="row">
          <div class="col-xl-4 col-md-4">
            <div class="box">
            <div class="balao"><div class="aspa">”</div><div class="frase">Seja honesto com você mesmo e não se engane sobre o que você sente. Coloque o peso que você está sentindo para fora e se liberte dos sentimentos ruins. É necessário expelir tudo o que nos faz mal e refletir sobre a vida. </div></div>
            <div class="balao2"><div class="triangulo-para-cima"></div></div>

            </div>
          </div>

            <div class="col-xl-4 col-md-4">
            <div class="box">
            <div class="balao"><div class="aspa">”</div><div class="frase">Encontre algo que você gosta de fazer e faça! Busque o prazer pela vida, tenha mais amor-próprio, divirta-se mesmo sozinha e aprenda a lidar com a solidão. Você merece ser feliz, independentemente de ter a companhia de alguém. Pense antes de agir e controle sua ansiedade no dia a dia.</div></div>
            <div class="balao2"><div class="triangulo-para-cima"></div></div>

            </div>
          </div>


            <div class="col-xl-4 col-md-4">
            <div class="box">
            <div class="balao"><div class="aspa">”</div><div class="frase">Se desconecte um pouco deste universo e reflita um pouco sobre você. Se ame em primeiro lugar, tenha calma para agir e permita-se deixar tudo de lado às vezes, para curtir os seus momentos sozinha. Enxergue o seu interior e respire fundo! </div></div>
            <div class="balao2"><div class="triangulo-para-cima"></div></div>

            </div>
          </div>
        </div>
        <br><br><br>

            </div>
        </div>

    <div class="video_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center">
                            <h3>Está passando por um momento ansioso? Veja o vídeo abaixo e relaxe!</h3>
                            <iframe width="960" height="480" src="https://www.youtube.com/embed/cizpXqVzBjw?autoplay=1&rel=0&modestbranding=1&theme=light&showinfo=0&loop=1&iv_load_policy=3" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="video_area">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="section_title text-center">
                                <h3>Meditação para melhorar o seu dia!</h3>
                                <iframe width="960" height="480" src="https://www.youtube.com/embed/oHjeGRqoS3E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-md-6">
                        <div class="menu_links">
                            <ul>
                                <li><a href="#">Sobre</a></li>
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
