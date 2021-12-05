<?php
    session_start();
    include ('conexao.php');
    include ('barra_rolagem.php');

    if(isset($_SESSION['id_usuario'])){
        $tp_usuario = $_SESSION['tp_usuario'];
        $id_usuario = $_SESSION['id_usuario'];

        if($tp_usuario == 0 or $tp_usuario == 2){
            $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario='.$dados_usuario['id_pf_fisico'].'&tp_usuario='.$dados_usuario['tp_usuario'].'';

            if($tp_usuario == 0){
                $usuario = 'Administrador';
                $caminho_painel = ''.$usuario.'/painel_adm';
            }else{
                $usuario = 'Consumidor';
                $caminho_painel = ''.$usuario.'/painel_consumidor';
            }
        }
        elseif($tp_usuario == 1 or $tp_usuario == 3){
            $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario='.$dados_usuario['id_pf_juridico'].'&tp_usuario='.$dados_usuario['tp_usuario'].'';

            if($tp_usuario == 1){
                $usuario = 'Produtor';
                $caminho_painel = ''.$usuario.'/painel_produtor';
            }else{
                $usuario = 'Produtor_Consumidor';
                $caminho_painel = ''.$usuario.'/painel_produtor_consumidor';
            }
        }else{}

    }else{}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-suporte.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pedidos.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../JS/script_box_user.js"></script>

        <style type="text/css">
            .figuras-produtor{
                top: 36px;
            }

            .box-user{
                height: 17%;
            }

            .pedidos tr{
                height: 130px;
            }

            .pedidos .imagem img{
                top: 0;
            }

            button{
                border: 0;
                width: 100px;
                height: 30px;
                background-color: #c3c65b;
                color: #FFF;
                border-radius: 20px;
                cursor: pointer;
                font-family: Caviar Dreams;
            }

            button:hover{
                background-color: #000;
            }
        </style>
    </head>
    
    <body class="corpo-painel-produtor">

    <!-- Dados do Usuário -->

    <?php
        include('conexao.php');

        if(!isset($_SESSION['id_usuario'])){
            unset($_SESSION['id_usuario']);
            header('location:invalido.php');
        }

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 2 or $dados_usuario['tp_usuario'] == 2){ // if tp_usuario

    ?>

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href=" <?php echo($caminho_painel); ?>.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="<?php echo($usuario); ?>/editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="index.php"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="lista-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="lojas.php">Loja</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                        <li><a href="suporte.php">Suporte</a></li>
                    </ul>
                </div>

                <div class="figuras-produtor">
                    <a href="#" onclick="box()">
                        <div class="usuario">
                            <?php echo ('<img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">'); ?>     
                        </div>
                    </a>
                    <a href="<?php echo($usuario); ?>/notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->
    <section class="titulos">

        <table>
            <tr>
                <td style="text-align: left; padding-left: 35px; width: 325px;">Produtos</td>
                <td>Preço Unitário</td>
                <td>Quantidade</td>
                <td>Preço Total</td>
                <td>Excluir</td>
            </tr>
        </table>

    </section>

    <section class="pedidos">

        <?php

        $sql_pedido = 'select * from pedido where id_consumidor = '.$id.';';
        $pedido = mysqli_query($conectar,$sql_pedido);

            while($dados_pedido = mysqli_fetch_array($pedido)){

            $sql_produtor = 'select * from pf_juridico where id_pf_juridico = '.$dados_pedido['id_produtor'].';';
            $produtor = mysqli_query($conectar,$sql_produtor);
            $dados_produtor = mysqli_fetch_array($produtor);

            $data_pedido = date("d/m/Y", strtotime($dados_pedido['dt_pedido']));
        
        ?>

        <table>
            <tr>
                <td colspan="3">
                    <?php
                        echo('<strong>Loja: </strong>'.$dados_produtor['nome']);
                    ?>

                </td>
                <td colspan="3">
                    <?php
                        echo('<strong>Data do Pedido: </strong>'.$data_pedido);
                    ?>

                </td>
            </tr>

        <?php
            
            $sql_pedido_produto = 'select * from pedido_produto where id_pedido = '.$dados_pedido['id_pedido'].';';
            $pedido_produto = mysqli_query($conectar,$sql_pedido_produto);
            
            while($dados_pedido_produto = mysqli_fetch_array($pedido_produto)){

            $sql_produto = 'select * from produto where id_produto = '.$dados_pedido_produto['id_produto'].';';
            $produto = mysqli_query($conectar,$sql_produto);

            while($dados_produto = mysqli_fetch_array($produto)){

            $preco_total = $dados_produto['preco'] * $dados_pedido_produto['quantidade'];
        ?>
        
            <tr>
                <td class="imagem">
                    <?php echo ('<img src="../IMG/Imagem_Produtos/'.$dados_produto['imagem'].'">'); ?>
                </td>
                <td>
                    <?php echo ($dados_produto['nome_produto']); ?>
                </td>
                <td>
                    <?php echo ($dados_produto['preco']); ?>
                </td>
                <td>
                    <?php echo ($dados_pedido_produto['quantidade']); ?>
                </td>
                <td>
                    <?php echo ($preco_total); ?>
                </td>
                <td>
                    <i class="fas fa-trash"></i>
                </td>
            </tr>
            
            <tr style="height: 100px">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button>Cancelar</button></td>
                <td><button>Comprar</button></td>
            </tr>

        <?php
            }
        }
        ?>

        </table>

        <?php
            }
        ?>

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
            <a href="https://www.facebook.com/Green-Gate-103711395206238" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

    <!-- Enviar Suporte -->

    <?php   

        }else{ // else tp_usuario
            echo ('<script>window.alert("Você não possui essa função!");window.location="index.php"</script>');
        }

    ?>

    </body>
</html>