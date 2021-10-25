<?php

	include('conexao.php');

	$deletar = 'delete from empresa where id_empresa='.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){
		echo ('<script>window.alert("Empresa apagada com sucesso!");window.location="painel_adm_aprovacoes.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagada a empresa!");window.location="painel_adm_aprovacoes.php"</script>');
	}

?>