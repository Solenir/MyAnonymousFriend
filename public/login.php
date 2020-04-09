<!--
//login.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index2.php');
}

if(isset($_POST['login']))
{
	$query = "
		SELECT * FROM login
  		WHERE username = :username
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':username' => $_POST["username"]
		)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"]))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
				INSERT INTO login_details
	     		(user_id)
	     		VALUES ('".$row['user_id']."')
				";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();
				header('location:index2.php');
			}
			else
			{
				$message = '<label>Senha incorreta</label>';
			}
		}
	}
	else
	{
		$message = '<label>Nome de usuário inválido</labe>';
	}
}


?>

<html>
    <head>
        <title>My Anonymous Friend</title>
				<link rel="stylesheet" href="css/sty.css">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
			                                    <li><a href="about.php">Sobre</a></li>

			                                    <li><a href="portfolio.php">Parceiros</a> </li>
			                                    <li><a href="contact.php">Contato</a></li>
			                                </ul>
			                            </nav>
			                        </div>
			                    </div>

			                    <div class="col-sm d-none d-lg-block">
			                        <div class="Appointment">
			                            <div class="book_btn d-none d-lg-block">
			                                <a  href="index3.php">Postagens</a>
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
  				<div class="panel-heading">Entrar</div>
				<div class="panel-body">
					<p class="text-danger"><?php echo $message; ?></p>
					<form method="post">
						<div class="form-group">
							<label>Digite nome do usuário</label>
							<input type="text" name="username" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Digite a senha</label>
							<input type="password" name="password" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-info" value="Entrar" />
						</div>
						<div align="center">

              <p>Não possui cadastro? <a href="register.php">cadastre-se aqui!</a></p>
						</div>
					</form>
					<br />
					<br />
					<br />
					<br />
				</div>
			</div>
		</div>

    </body>
</html>
