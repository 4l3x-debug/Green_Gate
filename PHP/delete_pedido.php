<!-- Deletar Pedido -->

<?php

	include('conexao.php');

	$deletar = 'delete from pedido WHERE pedido.id_pedido = '.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){

		echo ('<script>window.alert("Pedido apagado com sucesso!");window.location="carrinho.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar o pedido!");window.location="carrinho.php"</script>');
	}

?>