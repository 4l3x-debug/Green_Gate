<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Green Gate | Cadastro </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/style-cadastro.css">
	<link rel="stylesheet" type="text/css" href="../CSS/style-login.css">
</head>
<body>

	<section>

	<div class="box-cadastro">

		<h1> Cadastre-se no Green Gate! </h1>

		<form method="POST" class="formulario-cadastro" enctype="multipart/form-data">

			<div class="linha primeira">
				Nome:
				<input type="text" name="nome" id="nome">

			</div>

			<div class="linha segunda">
				E-mail:
				<input type="email" name="email" id="usuario">
			</div>	

			<div class="linha terceira">
				Senha:
				<input type="password" name="senha" id="senha">

				Confirmação:
				<input type="password" name="senha-confirmacao" id="senha">
			</div>	

			<div class="linha quarta">

				Data de Nascimento:	
	        	<input type="date" name="data">

	        </div>	

	        <div class="linha quinta">

	        	Telefone:
	        	<input type="text" name="telefone">

	        	CPF:
	        	<input type="text" name="cpf">

	        </div>

	        <div class="linha sexta">

	        	Tipo de Usuário:
				<select name="usuario">
			        <option selected value disabled="">Selecione</option>
			        <option value=1>Produtor</option>
			        <option value=2>Consumidor</option>
			    </select>

		        Gênero:
			    <select name="genero">
			        <option selected value disabled="">Selecione</option>
			        <option value="F">Feminino</option>
			        <option value="M">Masculino</option>
			    </select>		

	        </div>	

	        <div class="linha setima">
	        	
	        	Imagem:
	        	<input type="file" name="imagem">

	        </div>	

				<input type="submit" name="cadastrar" value="Cadastrar" class="botao-cadastro">	

		</form>

	</div>

	</section>

	<svg class="ondas" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20962 10601">
      <path class="primeira_onda" fill="#90a955" d="M27489 8635c504 1667 831 3818-27 5680s-2901 3434-6193 3904-7834-161-12155-589c-4321-427-8421-649-10976-1537-2555-889-3565-2443-4071-4061-505-1619-505-3302 938-4835 1442-1533 4327-2916 6274-3122s2958 764 3877 1522 1746 1304 2738 1382 2148-312 2976-730 1327-864 2136-1014c810-151 1929-6 2757 206s1363 490 1978 775c614 284 1308 574 1947 535s1223-407 1935-875c712-469 1552-1037 2240-1266 688-228 1223-117 1832 530 608 646 1290 1828 1794 3495z" />

      <path class="segunda_onda" fill="#c7d66d" d="M25681 10400c-171 822-305 1990-646 3115-341 1124-889 2206-1856 2808-968 602-2355 724-4668 1064s-5550 898-8520 987-5672-290-9037-859c-3366-568-7394-1326-9403-2118-2008-791-1996-1616-1892-3305 103-1689 298-4242 1412-5731 1113-1488 3146-1912 4953-1627 1808 284 3390 1276 4522 1878s1814 814 2423 552 1145-998 2333-1388c1187-389 3025-432 4266 275 1240 707 1884 2164 2861 2407 976 244 2285-726 3493-1308 1209-581 2316-775 3731-567 1415 207 3137 815 4290 1221 1153 407 1737 612 1926 953 189 342-18 820-188 1643z" />

      <path class="terceira_onda" fill="#ECF39E" d="M30706 11822c-291 731-653 1801-1548 2972-895 1170-2321 2441-4988 3026-2667 586-6574 485-10469 541s-7778 268-10906-256-5501-1784-6906-3382c-1404-1598-1840-3533-1957-4910-118-1377 82-2195 1029-2854 946-659 2637-1158 4033-1002s2495 968 3440 1630 1737 1175 2905 1086c1169-89 2714-780 3810-1332 1095-552 1740-965 2665-820s2130 848 3110 1360c980 513 1734 837 2458 672s1416-819 2179-1050 1597-40 3058 269c1461 310 3550 739 5069 1177 1519 437 2469 883 2998 1112 529 228 639 240 584 440-55 201-274 591-564 1321z" />
    </svg>
	

<?php
	include('conexao.php');

	if (isset($_POST['cadastrar'])) {

		if(empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['senha']) or empty($_POST['senha-confirmacao'])  or empty($_POST['usuario']) or empty($_POST['data']) or empty($_POST['cpf']) or empty($_POST['genero'])){

			echo ('<script>window.alert("Preencha os campos!");window.location="cadastro.php"</script>');

		}else{

		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$confimacao = $_POST['senha-confirmacao'];
		$usuario = $_POST['usuario'];
		$data_nascimento = $_POST['data'];
		$celular = $_POST['telefone'];
		$cpf = $_POST['cpf'];
		$genero = $_POST['genero'];
		$data_cadastro = date("Y-m-d");
		$data_americana = date("Y-m-d", strtotime($data_nascimento));
		$foto = $_FILES["imagem"];

			if(!empty($foto["name"])){

				$largura = 1500;
				$altura = 1500;
				$tamanho = 2048000;

				if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
					echo('Isso não é uma imagem.');
				}

				$dimensoes = getimagesize($foto["tmp_name"]);

				if($dimensoes[0] > $largura){
					echo ('A largura da imagem não deve ultrapassar de '.$largura.' pixels');
				}

				if($dimensoes[1] > $altura){
					echo ('A altura da imagem não deve ultrapassar de '.$altura.' pixels');
				}

				if($foto["size"] > $tamanho){
					echo('A imagem deve ter no máximo '.$tamanho.' bytes');
				}

				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

				$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

				$caminho_imagem = "../IMG/Imagem_Usuario/" . $nome_imagem;

				move_uploaded_file($foto["tmp_name"], $caminho_imagem);


		if ($usuario == 1) {
			if ($senha == $confimacao) {
				$adicionar = 'insert into usuario (nome, email, senha, usuario, celular, data_nascimento, data_cadastro, genero, cpf, imagem) values ("'.$nome.'", "'.$email.'", "'.md5($senha).'", '.$usuario.', "'.$celular.'", "'.$data_americana.'", "'.$data_cadastro.'", "'.$genero.'", "'.$cpf.'", "'.$nome_imagem.'");';

				$query_cadastro = mysqli_query($conectar, $adicionar);

				if ($query_cadastro) {
					echo ('<script>window.alert("Cadastro efetuado com sucesso!");window.location="login.php"</script>');
				}else{
					echo ('<script>window.alert("Erro ao se cadastrar!");window.location="cadastro.php"</script>');
				}
			}else{
				echo ('<script>window.alert("As senhas estão incompatíveis!");window.location="cadastro.php"</script>');
			}

		}else if ($usuario == 2) {
			if ($senha == $confimacao) {
				$adicionar = 'insert into usuario (nome, email, senha, usuario, celular, data_nascimento, data_cadastro, genero, cpf, imagem) values ("'.$nome.'", "'.$email.'", "'.md5($senha).'", '.$usuario.', "'.$celular.'", "'.$data_americana.'", "'.$data_cadastro.'", "'.$genero.'", "'.$cpf.'", "'.$nome_imagem.'");';

				$query_cadastro = mysqli_query($conectar, $adicionar);

				if ($query_cadastro) {
					echo ('<script>window.alert("Cadastro efetuado com sucesso!");window.location="login.php"</script>');
				}else{
					echo ('<script>window.alert("Erro ao se cadastrar!");window.location="cadastro.php"</script>');
				}
			}else{
				echo ('<script>window.alert("As senhas estão incompatíveis!");window.location="cadastro.php"</script>');
			}
		}else{}

			}
			
			}

		}

?>

</body>
</html>