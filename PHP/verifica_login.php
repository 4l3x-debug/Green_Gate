<?php
	session_start();
	if (!$_SESSION['id_usuario']) {
		echo('<script>window.alert("Você não tem acesso a esta página!"); window.location="../login.php"</script>');
	}
?>
