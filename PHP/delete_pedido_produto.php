<!-- Deletar Pedido Produto -->

<?php

	include('conexao.php');

	$deletar = 'delete from pedido_produto WHERE pedido_produto.id_pedido_produto = '.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){

		echo ('<script>window.alert("Produto apagado com sucesso!");window.location="carrinho.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar o produto!");window.location="carrinho.php"</script>');
	}

?>