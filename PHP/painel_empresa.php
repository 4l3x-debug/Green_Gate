<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Green Gate | Página Administrador</title>
        <link rel="stylesheet" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
    	<link rel="stylesheet" href="../FONTAW/css/all.css">
    	<link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
	</head>
	<body class="corpo-pagina-adm">

    <?php

    include('conexao.php');
        session_start();
        if(!isset($_SESSION['entrar'])){

            if(!isset($_SESSION['entrar_empresa'])){

                $id = $_SESSION['id_usuario'];
                $cnpj_empresa = $_SESSION['cnpj_empresa'];

                $sql_usuario = 'select *from usuario where id_usuario='.$id.';';
                $resul_usuario = mysqli_query($conectar, $sql_usuario);
                $dados_usuario = mysqli_fetch_array($resul_usuario);
                
                $sql_empresa = 'select nome_empresa from empresa where cnpj='.$cnpj_empresa.';';
                $resul_empresa = mysqli_query($conectar, $sql_empresa);
                $dados_empresa = mysqli_fetch_array($resul_empresa);


    ?>

    <!-- Cabeçalho -->

        <section class="main-nav">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../HTML/index.html"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-empresa">
                	<a href=""><i class="fas fa-user-circle"></i></a>
                        <div class="empresa">
                            <?php echo $dados_empresa['nome_empresa']; ?>        
                        </div>
                    <a href=""><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Menu para Administrar -->

    <main>
    <aside class="main aside">
    	<nav>
    		<ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="pagina_empresa.php"><li><i class="fas fa-store-alt"></i>
                    Loja
                </li></a>
                <a href="pagina_empresa_produtos.php"><li><i class="fas fa-tags"></i> 
                    Produtos
                </li></a>   
                <a href="pagina_empresa_avaliacoes.php"><li><i class="fas fa-tasks"></i>
                    Avaliações
                </li></a>
                <a href="pagina_empresa_suporte.php"><li><i class="fas fa-headset"></i>
                    Suporte
                </li></a>      
            </ul>
    	</nav>
    </aside>

    <!-- Conteúdo -->
        <section class="main articles">
        </section>
    </main>    

    <!-- Modal -->
        


    <!-- Rodapé -->

    <footer class="main-footer">
        <section class="cont-footer">
            <div>
                <p>Para quem se compromete com o meio ambiente.</p>
            </div>
        </section>

        <div id="linha-vert"></div>

        <div class="footer-icon">
            <a href="https://www.facebook.com/Green-Gate-103711395206238"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

    <?php
            }else{
                unset($_SESSION['entrar_empresa']);
                header('location:invalido.php');
            }

        }else{
          unset($_SESSION['entrar']);
          header('location:invalido.php');
        }
    ?>

	</body>
</html>