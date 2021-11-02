<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Green Gate | Cadastro</title>

	<?php
		include('conexao.php');

		include('fundo_ondas.php');
	?>

	<link rel="stylesheet" href="../FONTAW/css/all.css">

	<link rel="stylesheet" type="text/css" href="../CSS/style-cadastro.css">

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

					<div class="row cpf">
						<div class="col-sm-3">
							CPF:
						</div>

						<div class="col-sm-9">
							<input type="text" name="cpf">
						</div>
					</div>

					<div class="row tp-usuario">
						<div class="col-sm-3" style="font-size: 15px;">
							Tipo de Usuário:
						</div>

						<div class="col-sm-9">
							<select name="usuario">
								<option selected value disabled="">Selecione</option>
								<option value="2">Consumidor</option>
							</select>
						</div>
					</div>

					<div class="row data-nascimento">
						<div class="col-sm-3">
							Data de Nasc:
						</div>

						<div class="col-sm-9">
							<input type="date" name="data">
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

<?php

	if (isset($_POST['cadastrar'])) { // if cadastrar

		if(empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['senha']) or empty($_POST['senha-confirmacao'])  or empty($_POST['usuario']) or empty($_POST['data']) or empty($_POST['genero'])){ // if empty

			echo ('<script>window.alert("Preencha os campos!");window.location="cadastro_pf_fisico.php"</script>');

		}else{

		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$confimacao = $_POST['senha-confirmacao'];
		$cpf = $_POST['cpf'];
		$usuario = $_POST['usuario'];
		$data_nascimento = $_POST['data'];
		$celular = $_POST['telefone'];
		$genero = $_POST['genero'];
		$data_cadastro = date("Y-m-d");
		$data_americana = date("Y-m-d", strtotime($data_nascimento));

		if($genero == "F"){

			$nome_imagem = 'girl.png';

		}else{
			$nome_imagem = 'boy.png';
		}

		if ($senha == $confimacao) { // if senha

			$adicionar = 'insert into pf_fisico (nome, email, senha, tp_usuario, cpf, celular, data_nascimento, data_cadastro, genero, imagem) values ("'.$nome.'", "'.$email.'", "'.md5($senha).'", '.$usuario.', "'.$cpf.'", "'.$celular.'", "'.$data_americana.'", "'.$data_cadastro.'", "'.$genero.'", "'.$nome_imagem.'");';

			$query_cadastro = mysqli_query($conectar, $adicionar);

			if ($query_cadastro) {
				echo ('<script>window.alert("Cadastro efetuado com sucesso!");window.location="login.php"</script>');
			}else{
				echo ('<script>window.alert("Erro ao se cadastrar!");window.location="cadastro_pf_fisico.php"</script>');
			}

		}else{
			echo ('<script>window.alert("As senhas estão incompatíveis!");window.location="cadastro_pf_fisico.php"</script>');
		} // else senha
			
		} // else empty

	} // else cadastrar

?>

	</body>
</html>