<!-- Deletar Produto -->

<?php

	include('../conexao.php');

	$deletar = 'delete from produto where id_produto='.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){
		echo ('<script>window.alert("Produto apagado com sucesso!");window.location="produtos.php?edit=0"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar o produto!");window.location="produtos.php?edit=0"</script>');
	}

?>