<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Green Gate | Página Empresa</title>
        <link rel="stylesheet" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-consumidor.css">
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

                $sql_empresa = 'select * from empresa where cnpj='.$cnpj_empresa.';';
                $resul_empresa = mysqli_query($conectar, $sql_empresa);
                $dados_empresa = mysqli_fetch_array($resul_empresa);


            if($dados_usuario['usuario'] == 1 && $dados_empresa['id_produtor'] == $id){
    

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

    <!-- Conteúdo -->

        <section class="pagina-usuario">

    <!-- Menu para Administrar -->

        <script type="text/javascript" src="../JS/script_painel_consumidor.js"></script>

        <aside id="menuOculto" class="menuOculto">
            <a href="javascript: void(0)" class="btnFechar" onclick="fecharNav()"><i class="fas fa-times"></i></a>
            <a href="#" class="icon"><i class="fas fa-store-alt"></i>Loja</a>
            <a href="painel_empresa_produtos.php" class="icon"><i class="fas fa-tags"></i>Produtos</a>
            <a href="painel_empresa_avaliacoes.php" class="icon"><i class="fas fa-tasks"></i>Avaliações</a>
            <a href="painel_empresa_suporte.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

        <p>
        <a href="editar_perfil_empresa.php">Editar Perfil</a>
    </p>     

    <div class="fundo-foto-usuario">
        <div class="foto-usuario">
        </div>
    </div>

    <div class="nome-usuario">

    <?php

    echo $dados_empresa['nome_empresa'];

    ?>

    </div>

    <table>

        <tr>

            <div class="dados-usuario primeira">

            <td> Razão Social: <?php echo $dados_empresa['razao']; ?> </td>
            <td> CNPJ: <?php echo $dados_empresa['cnpj']; ?> </td>
            <td> Data de Cadastro: <?php echo $dados_empresa['data_cadastro']; ?> </td>    

            </div>

        </tr>

        <tr>    

            <div class="dados-usuario segunda">

            <td> Email: <?php echo $dados_empresa['email']; ?> </td>
            <td> Telefone: <?php echo $dados_empresa['telefone']; ?> </td>
            <td> CEP: <?php echo $dados_empresa['cep']; ?> </td>
                
            </div>

        </tr>    

    </table>

        </section>
        
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
                header('location:invalido.php');
            }

            }else{
                unset($_SESSION['entrar_empresa']);
                header('location:painel_produtor.php');
            }

        }else{
          unset($_SESSION['entrar']);
          header('location:invalido.php');
        }
    ?>

	</body>
</html>