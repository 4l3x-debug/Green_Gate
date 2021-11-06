<?php

	include('../conexao.php');

	$deletar = 'delete from endereco WHERE endereco.id_endereco = '.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){

		echo ('<script>window.alert("Endereço apagado com sucesso!");window.location="endereco.php?edit=0"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar o endereço!");window.location="endereco.php?edit=0"</script>');
	}

?>