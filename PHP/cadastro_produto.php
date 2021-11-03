<?php
include('conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cadastro | Produto</title>
	<link rel="stylesheet" href="../CSS/cad_produto.css">
</head>

<body>
	<form method="post" enctype="multipart/form-data">
		<div class="main-cadastro">
			<div class="titulo">
				<h1>Cadastre seu Produto</h1>
				<hr>
			</div>

			<div class="nome-produto">
				<span>Nome do produto:</span>
				<input type="text" name="nome_produto" maxlength="40">
			</div>

			<div class="marca">
				<span>Marca do produto:</span>
				<input type="text" name="marca" maxlength="20">
			</div>

			<div class="dt-validade">
				<span>Data Validade:</span>
				<input type="date" name="data_validade">
			</div>

			<div class="preco">
				<span>Preco:</span>
				<input type="text" name="preco">
			</div>

			<div class="descricao">
				<span>Descrição:</span>
				<input type="text" name="descricao" maxlength="300">
			</div>

			<div class="imagem">
				<span>Imagem:</span>
				<input type="file" name="imagem">
			</div>

			<div class="btn">
				<input type="submit" name="cadastrar" value="Cadastrar">
			</div>
		</div>
	</form>
	<?php
	include('fundo_ondas.php');
	?>
</body>

</html>

<?php
if (isset($_POST['cadastrar'])) {
	$nome_produto = $_POST['nome_produto'];
	$marca = $_POST['marca'];
	$data_validade = $_POST['data_validade'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];
	$imagem = $_FILES['imagem'];
	$date = date("Y-m-d", strtotime($data_validade));

	$extensao = strtolower(substr($imagem['name'], -4));
	$nome_img = md5(time()) . $extensao;
	$diretorio = "../IMG/Produtos/";

	move_uploaded_file($imagem['tmp_name'], $diretorio . $nome_img);

	$sql = 'insert into produto (nome_produto, marca, dt_validade, preco, descricao, imagem) values ("' . $nome_produto . '","' . $marca . '","' . $date . '","' . $preco . '","' . $descricao . '","' . $nome_img . '");';

	$sql_query = mysqli_query($conectar, $sql);

	if ($sql_query) {
		echo ('<script>window.alert("Cadastro efetuado com sucesso!");');
	} else {
		echo ('<script>window.alert("Erro ao cadastrar produto");');
	}
}
?>