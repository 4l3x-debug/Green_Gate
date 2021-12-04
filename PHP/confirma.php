<html>

<html>
    <head>
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
        
                    $caminho = '?id_usuario='.$dados_usuario['id_pf_fisico'].'&tp_usuario='.$dados_usuario['tp_usuario'].';';
        
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
        
                    $caminho = '?id_usuario='.$dados_usuario['id_pf_juridico'].'&tp_usuario='.$dados_usuario['tp_usuario'].';';
        
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

        <style type="text/css">
            .box-user{
                height: 17%;
            }
            .usuario {
                position: relative;
                top: 6px;
                right: 12px;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="../CSS/style-compra.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-lojas.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../JS/script_box_user.js"></script>
    </head>
    <body>
    <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href=" <?php echo($caminho_painel); ?>.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="<?php echo($usuario);?>/editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

    <header>
        <section class="main-nav">
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

                <?php
                    if(!isset($_SESSION['id_usuario'])){
                ?>                    

                <div class="figuras" style="top: 40%;">
                    <a href=""><i class="fas fa-search"></i></a>
                    <a href="login.php"><i class="fas fa-user-circle"></i></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a>
                </div>
                
                <?php
                    }else{  

                echo ('<div class="figuras" style="top: 30%;">
                    <a href=""><i class="fas fa-search"></i></a>
                    <a href="#" onclick="box()"><div class="usuario">
                        <img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">
                    </div></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a></div>');
                
                    }    
                ?>
            </nav>
        </section>
    </header>
<body>
    <style>
        #centro{

            position: absolute;
            align-content: center;
            align-items: center;
            left: 60px;
        }

        .paypal-buttons{
            position: absolute;
            left:50%;
            transform:translateX(-50%);
            top: 25%;
        }

    </style>
    <a href="lojas.php">
        <img src="../IMG/seta.png" width="50" height="50" style="margin-left: 20px; margin-top: 20px;">
    </a>
<br>

        

</body>
</html>