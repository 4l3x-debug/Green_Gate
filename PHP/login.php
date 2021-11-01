<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Green Gate | Login</title>

	<?php

		session_start();
		include('conexao.php');

		include('fundo_ondas.php');
	?>

		<link rel="stylesheet" type="text/css" href="../CSS/style-login.css">

	<body>

		<div class="container-fluid position-absolute"> <!-- INÍCIO - Tamanho da página-->
			<div class="col-md-3 login"> <!--INÍCIO - Tamanho Login-->

				<div class="col-12 position-absolute titulo-login">  <!--INÍCIO - Título-->
					<h2>LOGIN</h2>
				</div> <!-- FIM - Título-->

				<form action="#" method="POST" class="col-12">

				<div class="col-12 tp-usuario"> <!--INÍCIO - Tipo de Usuário-->
					<div class="row">
						<div class="col">
							<p>Tipo de Usuário:</p>
						</div>	

						<div class="col">	
							<select>
								<option selected value disabled="">Selecione</option>
						        <option value="0">Administrador</option>
						        <option value="1">Produtor</option>
						        <option value="2">Consumidor</option>
						        <option value="3">Produtor Consumidor</option>
							</select>
						</div>
					</div> 
				</div> <!-- FIM - Tipo de Usuário-->

				<div class="col-12 email">
					<input type="text" name="email" placeholder="Email">
				</div>

				<div class="col-12 senha">
					<input type="text" name="senha" placeholder="Senha">
				</div>

				<div class="col-12 btn-login">
					<input type="submit" name="entrar" value="Entrar">
				</div>

				<div class="col-12 cadastro">
					<a href="cadastro.php"><p>Cadastre-se no Green Gate</p></a>
				</div>

				</form>

			</div> <!-- FIM - Tamanho Login-->
		</div> <!-- FIM - Tamanho da página-->

		<?php

		if (isset($_POST['entrar'])) {
		
		$usuario = mysqli_real_escape_string($conectar, $_POST['usuario']);
		$email = mysqli_real_escape_string($conectar, $_POST['email']);
		$senha = mysqli_real_escape_string($conectar, md5($_POST['senha']));

		    if ($usuario == 0) {
		    	$select = "select id_usuario, nome from usuario where email = '".$email."' and senha = '".$senha."' and tp_usuario = 0;";

		      	$query_select = mysqli_query($conectar, $select);

		      	$rows = mysqli_num_rows($query_select);

		      	if ($rows == 1) {
		        	$dados = mysqli_fetch_array($query_select);
		        	$_SESSION['id_usuario'] = $dados['id_usuario'];
		        	header('location: painel_adm.php');
		      	}else{
		        	header('location: login.php');
		      	}

		    }else if ($usuario == 1) {
		      $select = "select id_usuario, nome from usuario where email = '".$email."' and senha = '".$senha."' tp_usuario = 1;";

		      $query_select = mysqli_query($conectar, $select);

		      $rows = mysqli_num_rows($query_select);

		      if ($rows == 1) {
		        $dados = mysqli_fetch_array($query_select);
		        $_SESSION['id_usuario'] = $dados['id_usuario'];
		        header('location: painel_produtor.php');
		      }else{
		        header('location: login.php');
		      }

		    }else if ($usuario == 2) {
		      $select = "select id_usuario, nome from usuario where email = '".$email."' and senha = '".$senha."' tp_usuario = 2;";

		      $query_select = mysqli_query($conectar, $select);

		      $rows = mysqli_num_rows($query_select);

		      if ($rows == 1) {
		        $dados = mysqli_fetch_array($query_select);
		        $_SESSION['id_usuario'] = $dados['id_usuario'];
		        header('location: painel_consumidor.php');
		      }else{
		        header('location: login.php');
		      }

		    }else if($usuario == 3) {
		    	$select = "select id_usuario, nome from usuario where email = '".$email."' and senha = '".$senha."' tp_usuario = 3;";

		    	$query_select = mysqli_query($conectar, $select);

		      	$rows = mysqli_num_rows($query_select);

			    if ($rows == 1) {
			   	    $dados = mysqli_fetch_array($query_select);
			        $_SESSION['id_usuario'] = $dados['id_usuario'];
			        header('location: painel_produtor_consumidor.php');
			    }else{
			        header('location: login.php');
			     }
		    }

		  }

		?>

	</body>
</html>