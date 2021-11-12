<?php

	include('conexao.php');

	$deletar = 'delete from pf_juridico where pf_juridico.id_pf_juridico='.$_GET['del'].';';

	$apagar = mysqli_query($conectar,$deletar);


	if($apagar){

		echo ('<script>window.alert("Empresa apagada com sucesso!");window.location="Administrador/lojas.php"</script>');
	}else{
		echo ('<script>window.alert("Erro ao apagar a empresa!");window.location="Administrador/lojas.php"</script>');
	}

?>