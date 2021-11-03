<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Usuário</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-lojas-adm.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        
    </head>
    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 0){

        $limite = 2;

        if(!isset($_GET['pag'])){
            $pagina = 1;
        }else{
            $pagina = $_GET['pag'];
        }

        $inicio = ($pagina * $limite) - $limite;


        $sql_empresa = 'select * from pf_juridico where tp_usuario = 1 order by nome ASC limit '.$inicio.', '.$limite.';';
        $resul_empresa = mysqli_query($conectar, $sql_empresa);

        $sql_total = 'select * from pf_juridico where tp_usuario = 1;';
        $resul_total = mysqli_query($conectar, $sql_total);
        $total_registros = mysqli_num_rows($resul_total);

    ?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="lista-menu">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../lojas.php">Loja</a></li>
                        <li><a href="../sobre.php">Sobre</a></li>
                        <li><a href="../suporte.php">Suporte</a></li>
                    </ul>
                </div>

                <div class="figuras-produtor">
                    <a href="painel_adm"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="../notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario">

    <!-- Menu Lateral Oculto -->

        <script type="text/javascript" src="../../JS/script_painel_consumidor.js"></script>

        <aside id="menuOculto" class="menuOculto">
            <a href="javascript: void(0)" class="btnFechar" onclick="fecharNav()"><i class="fas fa-times"></i></a>
            <a href="lojas.php" class="icon"><i class="fas fa-store-alt"></i>Lojas</a>
            <a href="aprovacoes.php" class="icon"><i class="far fa-check-square"></i>Aprovações</a>
            <a href="../invalido.php" class="icon"><i class="fas fa-sign-out-alt"></i>Sair</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

        <section class="lojas">
            
            <?php

                while($dados_empresa = mysqli_fetch_array($resul_empresa)){

                echo ('   
            <div class="fundo-loja">
                
                <section>

                    <table>

                    <tr>
                        <td>Nome: ' . $dados_empresa['nome'] . '</td>
                        <td>Email: ' . $dados_empresa['email'] . '</td>
                        <td>Telefone: ' . $dados_empresa['celular'] . '</td>
                    </tr>

                    <tr>
                        <td>Razão Social: ' . $dados_empresa['razao'] . '</td>
                        <td>CNPJ: ' . $dados_empresa['cnpj'] . '</td>
                        <td>Data de Cadastro: ' . $dados_empresa['data_cadastro'] . '</td>
                    </tr>
                        
                    </table>

                    <div class="botao">
                        <a href="../delete.php?del='.$dados_empresa['id_pf_juridico'].'"><i class="fas fa-trash"></i></a>
                    </div>

                </section>

            </div>');

                }
            ?>

        </section>

        <div class="paginacao">

            <?php

                $total_paginas = $total_registros / $limite;

                $anterior = $pagina - 1;
                $proximo = $pagina + 1;

                if($pagina>1){
                    echo ('<a href="lojas.php?pag='.$anterior.'"><</a>');
                }

                for($cont=1;$cont<=$total_paginas;$cont++){
                    echo('<a href="lojas.php?pag='.$cont.'">'.$cont.'</a>');
                }

                if($pagina<$total_paginas){
                    echo ('<a href="lojas.php?pag='.$proximo.'">></a>');
                }
            ?>

            </div>
        
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
            header('location:../invalido.php');
        }

        }else{
            unset($_SESSION['entrar']);
            header('location:../invalido.php');
        }

        ?>

    </body>
</html>