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

	<link rel="stylesheet" type="text/css" href="../CSS/style-cadastro.css">
	<link rel="stylesheet" href="../FONTAW/css/all.css">
	<link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

</head>

<body>

	<script type="text/javascript" src="../JS/script_cadastro.js"></script>

	<div class="container-fluid position-absolute">
		<div class="col-md-6 cadastro">

			<div class="container componentes-cadastro">
				<h4>Cadastre-se no Green Gate!</h4>

				<form method="POST" class="col-12" enctype="multipart/form-data">

					<section class="container" id="primeira">

						<div class="row nome">
							<div class="col-sm-2">
								Nome:
							</div>

							<div class="col-sm-10">
								<input type="text" name="nome">
							</div>
						</div>

						<div class="row email">
							<div class="col-sm-2">
								E-mail:
							</div>

							<div class="col-sm-10">
								<input type="email" name="email">
							</div>
						</div>

						<div class="row senha">
							<div class="col-sm-2">
								Senha:
							</div>

							<div class="col-sm-10">
								<input type="password" name="senha">
							</div>
						</div>

						<div class="row confirmacao">
							<div class="col-sm-2">
								Confirmar:
							</div>

							<div class="col-sm-10">
								<input type="password" name="senha-confirmacao">
							</div>
						</div>

						<div class="row telefone">
							<div class="col-sm-2">
								Telefone:
							</div>

							<div class="col-sm-10">
								<input type="text" name="telefone">
							</div>
						</div>

						<div class="row btn-parte1">
							<div class="col-sm-1 btn" onclick="containerDisplay()">
								<i class="fas fa-arrow-right"></i>
							</div>
						</div>

					</section>

					<section class="container" id="segunda">

						<div class="row cnpj">
							<div class="col-sm-3">
								CNPJ:
							</div>

							<div class="col-sm-9">
								<input type="text" name="cnpj">
							</div>
						</div>

						<div class="row tp-usuario">
							<div class="col-sm-3" style="font-size: 15px;">
								Tipo de Usuário:
							</div>

							<div class="col-sm-9">
								<select name="usuario">
									<option selected value disabled="">Selecione</option>
									<option value="1">Produtor</option>
									<option value="3">Produtor Consumidor</option>
								</select>
							</div>
						</div>

						<div class="row razao">
							<div class="col-sm-3">
								Razão Social:
							</div>

							<div class="col-sm-9">
								<input type="text" name="razao">
							</div>
						</div>

						<div class="row genero">
							<div class="col-sm-3">
								Gênero:
							</div>

							<div class="col-sm-9">
								<select name="genero">
									<option selected value disabled="">Selecione</option>
									<option value="F">Feminino</option>
									<option value="M">Masculino</option>
								</select>
							</div>
						</div>

						<div class="row termos">
							<input type="checkbox" name="termos">
							<span for="termos">Eu concordo com os <a href="termos_de_uso.php" target="_blank">Termos de Uso</a>, <a href="politica_de_privacidade.php" target="_blank">Política de Privacidade</a> e <a href="politica_de_cookies.php" target="_blank">Política de Cookies.</a></span>
						</div>

						<div class="row btn-parte1">
							<div class="col-sm-1 btn" onclick="Voltar()">
								<i class="fas fa-arrow-left"></i>
							</div>

							<div class="col-sm-1 btn">
								<i class="fas fa-arrow-right"><input type="submit" name="cadastrar" value=""></i>
							</div>
						</div>
					</section>

				</form>

			</div>

		</div>
	</div>

	<!-- Cadastro Perfil Jurídico -->

	<?php

	if (isset($_POST['cadastrar'])) { // if cadastrar

		if (empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['senha']) or empty($_POST['senha-confirmacao'])  or empty($_POST['usuario']) or empty($_POST['razao'])) { // if empty

			echo ('<script>window.alert("Preencha os campos!");window.location="cadastro_pf_juridico.php"</script>');
		} else {

			if(!isset($_POST['termos'])){
				echo ('<script>window.alert("É preciso aceitar os termos para se cadastrar!");window.location="cadastro_pf_fisico.php"</script>');
			}else{

			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$confimacao = $_POST['senha-confirmacao'];
			$cnpj = $_POST['cnpj'];
			$usuario = $_POST['usuario'];
			$razao = $_POST['razao'];
			$celular = $_POST['telefone'];
			$genero = $_POST['genero'];
			$data_cadastro = date("Y-m-d");

			function validar_cnpj($cnpj){
			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
				
			if (strlen($cnpj) != 14)
				return false;

			if (preg_match('/(\d)\1{13}/', $cnpj))
				return false;	

			for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
				$soma += $cnpj[$i] * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}

			$resto = $soma % 11;

			if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
				return false;

			for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
				$soma += $cnpj[$i] * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}

			$resto = $soma % 11;

			return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
			}

			if(validar_cnpj($cnpj)){

			if ($genero == "F") {

				$nome_imagem = 'girl.png';
			} else if ($genero == "M") {
				$nome_imagem = 'boy.png';
			} else {
				$nome_imagem = 'outro.png';
			}

			if ($senha == $confimacao) { // if senha

				if($usuario == 1){

					$adicionar = 'insert into pf_juridico (nome, email, senha, tp_usuario, cnpj, celular, razao, data_cadastro, genero, imagem, plano) values ("' . $nome . '", "' . $email . '", "' . md5($senha) . '", ' . $usuario . ', "' . $cnpj . '", "' . $celular . '", "' . $razao . '", "' . $data_cadastro . '", "' . $genero . '", "' . $nome_imagem . '", 0);';

					$query_cadastro = mysqli_query($conectar, $adicionar);

				} else if($usuario == 3){

					$adicionar = 'insert into pf_juridico (nome, email, senha, tp_usuario, cnpj, celular, razao, data_cadastro, genero, imagem, plano) values ("' . $nome . '", "' . $email . '", "' . md5($senha) . '", ' . $usuario . ', "' . $cnpj . '", "' . $celular . '", "' . $razao . '", "' . $data_cadastro . '", "' . $genero . '", "' . $nome_imagem . '", null);';

					$query_cadastro = mysqli_query($conectar, $adicionar);

				}else{}

				if ($query_cadastro) {
					echo ('<script>window.alert("Cadastro efetuado com sucesso!");window.location="login.php"</script>');
				} else {
					echo ('<script>window.alert("Erro ao se cadastrar!");window.location="cadastro_pf_juridico.php"</script>');
				}
			} else {
				echo ('<script>window.alert("As senhas estão incompatíveis!");window.location="cadastro_pf_juridico.php"</script>');
			} // else senha

			}else{
				echo ('<script>window.alert("O CNPJ inválido!");window.location="cadastro_pf_juridico.php"</script>');
			}

			}

		} // else empty

	} // else cadastrar

	?>

</body>

</html>