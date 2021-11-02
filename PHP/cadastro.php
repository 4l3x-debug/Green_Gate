<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Green Gate | Cadastro</title>

	<?php
		include('conexao.php');

		include('fundo_ondas.php');
	?>

		<link rel="stylesheet" href="../FONTAW/css/all.css">

	<style type="text/css">
		body{
			font-family: Caviar Dreams;
		}
		
		i, p{
		    position: relative;
		    top: 39.5px;
		}

		a{
			width: 100%;
			display: block;
			height: 100%;
			position: relative;
			bottom: 20px;
		}

		h3{
			position: relative;
			top: 20px;
		}

		.container-fluid{
			width: 100%;
			height: 100%;
			display: flex;
			justify-content: center;
		}

		.pf-fisico, .pf-juridico{
			height: 400px;
			position: relative;
			top: 19.5%;
		}

		.pf-fisico h3, .pf-juridico h3{
			height: 30px;
			width: 100%;
			margin-top: 20px;
			font-size: 1.90rem;
		}

		.pf-fisico h3{
			color: #FFF;
		}

		.pf-juridico h3{
			color: #ADAD7B;
		}

		.pf-fisico{
			background-color: #ADAD7B;
			border-radius: 30px 0  0 30px;
			padding-right: 0;
			text-align: right;
		}

		.pf-juridico{
			background-color: #FFF;
			border-radius: 0 30px 30px 0;
			padding-left: 0;
			text-align: left;
		}

		.pf-fisico .componentes{
			padding-right: 0;
		}

		.pf-juridico .componentes{
			padding-left: 0;
		}

		.icon{
			text-align: center;
			height: 177px;
			position: relative;
			top: 90px;
			border-radius: 100px;
		}

		.pf-fisico .icon{
			color: #FFF;
		}

		.pf-juridico .icon{
			color: #ADAD7B;
		}

		.pf-fisico .componentes .icon i{
			font-size: 60px;
		}

		.pf-juridico .componentes .icon i{
			font-size: 58px;
		}

		.pf-fisico .componentes .icon p{
			font-size: 1.2rem;
		}

		.pf-juridico .componentes .icon p{
			font-size: 1.2rem;
		}

		.pf-fisico:hover, .pf-juridico:hover{
			transition: ease-out;
		    transition-duration: 0.2s;
		   	box-shadow: 0 2px 2px 3px rgba(64,87,109,.07),0 2px 12px rgba(53,71,90,.2);
		}

		a:hover{
			text-decoration: none;
		}


	</style>

	</head>
	<body>

		<div class="container-fluid position-absolute">
			<div class="col-md-3 pf-fisico"><a href="cadastro_pf_fisico.php">
				<div class="container componentes">
					<h3>ESSE O</h3>

					<div class="col-sm-12 icon" style="right: 20px;">
						<i class="fas fa-user"></i>
						<p>Perfil Físico</p>
					</div>
				</div>
			</a></div>

			<div class="col-md-3 pf-juridico"><a href="cadastro_pf_juridico.php">
				<div class="container componentes">
					<h3>U ESTE?</h3>

					<div class="col-sm-12 icon" style="left: 20px;">
						<i class="fas fa-store-alt"></i>
						<p>Perfil Jurídico</p>
					</div>
				</div>
			</a></div>
		</div>

	</body>
</html>