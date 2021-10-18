<?php

	include('conexao.php');

	$deletar = 'delete from empresa where id_empresa='.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){
		echo ('<script>window.alert("Empresa apagada com sucesso!");window.location="deletar_produtor.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagada a empresa!");window.location="painel_produtor.php"</script>');
	}

?>