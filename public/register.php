<!--
//register.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST["register"]))
{
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$check_query = "
	SELECT * FROM login
	WHERE username = :username
	";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':username'		=>	$username
	);
	if($statement->execute($check_data))
	{
		if($statement->rowCount() > 0)
		{
			$message .= '<p><label>Usuário existente!</label></p>';
		}
		else
		{
			if(empty($username))
			{
				$message .= '<p><label>Um nome de usuário é requerido</label></p>';
			}
			if(empty($password))
			{
				$message .= '<p><label>Uma senha é requerida</label></p>';
			}
			else
			{
				if($password != $_POST['confirm_password'])
				{
					$message .= '<p><label>As senhas informadas são diferentes</label></p>';
				}
			}
			if($message == '')
			{
				$data = array(
					':username'		=>	$username,
					':password'		=>	password_hash($password, PASSWORD_DEFAULT)
				);

				$query = "
				INSERT INTO login
				(username, password)
				VALUES (:username, :password)
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$message = "<label>Cadastro realizado com sucesso</label>";
				}
			}
		}
	}
}

?>

<html>
    <head>
        <title>Chat My Anonymous Friend</title>


		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				<link rel="stylesheet" href="css/sty.css">
<link rel="stylesheet" href="css/sty.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
			                                <a  href="chat.php">Postagens</a>
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
	                        <h3>My Anonymous Friend</h3>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
        <div class="container">
			<br />

			<br />
			<div class="panel panel-default">
  				<div class="panel-heading">Cadastro</div>
				<div class="panel-body">
					<form method="post">
						<span class="text-danger"><?php echo $message; ?></span>
						<div class="form-group">
							<label>Digite o nome de usuário</label>
							<input type="text" name="username" class="form-control" />
						</div>
						<div class="form-group">
							<label>Digite a senha</label>
							<input type="password" name="password" class="form-control" />
						</div>
						<div class="form-group">
							<label>Repita a senha</label>
							<input type="password" name="confirm_password" class="form-control" />
						</div>
						<div class="form-group">
							<input type="submit" name="register" class="btn btn-info" value="Cadastrar" />
						</div>
						<div align="center">
							<a href="login.php">Entrar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>
