<?php
	include ('barra_rolagem.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Green Gate | Cadastro</title>

	<?php
		include('conexao.php');

		include('fundo_ondas.php');
	?>
	
		<link rel="stylesheet" type="text/css" href="../CSS/style-escolha-pf.css">
		<link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
		<link rel="stylesheet" href="../FONTAW/css/all.css">
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