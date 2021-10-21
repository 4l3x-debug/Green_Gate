<?php

	include('conexao.php');

	$deletar = 'delete from produto where id_produto='.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){
		echo ('<script>window.alert("Produto apagado com sucesso!");window.location="painel_empresa_produtos.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar o produto!");window.location="painel_empresa_produtos.php"</script>');
	}

?>