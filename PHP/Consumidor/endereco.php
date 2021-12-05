<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Endereços</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-editar-perfil-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-endereco.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-box-user.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../../JS/script_editar_endereco.js"></script>
        <script type="text/javascript" src="../../JS/script_box_user.js"></script>

    </head>

    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['id_usuario'])){
            unset($_SESSION['id_usuario']);
            header('location:../invalido.php');
        }

        function get_endereco($cep){
            $cep = preg_replace("/[^0-9]/","",$cep);
            $url = "http://viacep.com.br/ws/$cep/xml/";

            $xml = simplexml_load_file($url);
            return $xml;
        }

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 2){

    ?>

    <!-- Cabeçalho -->
        
        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href="painel_consumidor.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="#"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="../invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
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
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <a href="#" onclick="box()">
                        <div class="usuario">
                            <?php echo ('<img src="../../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">'); ?>     
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Menu para Administrar -->

    <main>
    <aside class="main-aside-produtor" onclick="boxFechar()">
        <nav>
            <ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="editar_perfil.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="alterar_senha.php"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="endereco.php?edit=0"><li><i class="fas fa-map-marked-alt"></i>
                    Endereços
                </li></a>  
                <a href="deletar.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>      
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main adicionar-endereco" onclick="boxFechar()">

        <div class="adicionar">
            <h2>Adicionar Endereço</h2>

            <form method="POST">

                <div class="linha primeira">
                    CEP: <input type="text" name="cep">
                </div>

                <div class="linha segunda">
                    Bairro: <input type="text" name="bairro">
                </div>

                <div class="linha terceira">
                    Logradouro: <input type="text" name="logradouro">
                </div>

                <div class="linha quarta">
                    Número Residencial: <input type="text" name="n_residencial">
                </div>

                <div class="linha quinta">
                    Complemento: <input type="text" name="complemento">
                </div>

                <div class="linha sexta">
                    <div class="btn">
                        <i class="fas fa-plus"> 
                            <input type="submit" name="adicionar" value="">                
                        </i>
                    </div>
                </div>
            </form>
        </div>
        

        <table align="center" class="enderecos">
            
            <tr>
                <td>CEP</td>
                <td>Logradouro</td>
                <td>Número</td>
                <td>Editar</td>
                <td>Excluir</td>
            </tr>

        <?php

        $sql_enderecos = 'select * from endereco where id_pf_fisico='.$id.';';
        $resul = mysqli_query($conectar,$sql_enderecos);

        while($con = mysqli_fetch_array($resul)){
            echo('<tr class="dados">
                <td>'.$con['cep'].'</td>
                <td>'.$con['logradouro'].'</td>
                <td>'.$con['n_residencial'].'</td>
                <td><a href="endereco.php?edit='.$con['id_endereco'].'"><i class="fas fa-pen"></i></a></td>
                <td><a href="delete_endereco.php?del='.$con['id_endereco'].'"><i class="fas fa-trash"></i></a></td></tr>');
        }

        ?>

        </table>

        </section>
    
    </main>

    <?php

    if(isset($_POST['adicionar'])){

        if(empty($_POST['cep']) or empty($_POST['bairro']) or empty($_POST['logradouro']) or empty($_POST['n_residencial'])){
            echo ('<script>window.alert("Preencha os campos!");window.location="endereco.php?edit=0"</script>');

        }else{

        $cep_usuario = $_POST['cep'];
        $endereco = (get_endereco($cep_usuario));
        $estado = $endereco->uf;
        $cidade = $endereco->localidade;
        $bairro = $_POST['bairro'];
        $logradouro = $_POST['logradouro'];
        $n_residencial = $_POST['n_residencial'];
        $complemento = $_POST['complemento'];

        $sql_adiciona_endereco = 'insert into endereco(cep, estado, cidade, bairro, logradouro, n_residencial, complemento, tp_usuario, id_pf_fisico, id_pf_juridico) values ("'.$cep_usuario.'", "'.$estado.'", "'.$cidade.'", "'.$bairro.'", "'.$logradouro.'", '.$n_residencial.', "'.$complemento.'", '.$dados_usuario['tp_usuario'].', '.$dados_usuario['id_pf_fisico'].', null);';

        $adiciona_endereco = mysqli_query($conectar, $sql_adiciona_endereco);

            if($adiciona_endereco){
                echo ('<script>window.alert("Endereço adicionado com sucesso!");window.location="endereco.php?edit=0"</script>');
            }else{
               echo ('<script>window.alert("Erro ao adicionar o endereço!");window.location="endereco.php?edit=0"</script>'); 
            }

        }

    }else{}

    $sql = 'select * from endereco where id_endereco='.$_GET['edit'].';';
    $resul_editar = mysqli_query($conectar, $sql);
    $editar = mysqli_fetch_array($resul_editar);

    if($_GET['edit'] != 0){

    ?>

    <section id="editar">
        <a href="#" onclick="editar()"><i class="fas fa-times"></i></a>
        <div class="editar-endereco">

            <h2>Endereço</h2>

            <form method="POST">

                <div class="edit um">
                    CEP: <input type="text" name="cep-edit" value="<?php echo $editar['cep'];?>">
                </div>

                <div class="edit dois">
                    Bairro: <input type="text" name="bairro-edit" value="<?php echo $editar['bairro'];?>">
                </div>

                <div class="edit tres">
                    Logradouro: <input type="text" name="logradouro-edit" value="<?php echo $editar['logradouro'];?>">
                </div>

                <div class="edit quatro">
                    Número Residencial: <input type="text" name="n_residencial-edit" value="<?php echo $editar['n_residencial'];?>">
                </div>

                <div class="edit cinco">
                    Complemento: <input type="text" name="complemento-edit" value="<?php echo $editar['complemento'];?>">
                </div>

                <div class="btn-edit">
                    <div class="btn">
                        <i class="far fa-save"> 
                            <input type="submit" name="salvar" value="">                
                        </i>
                    </div>
                </div>
            </form>
            
        </div>
    </section>

    <?php

    if(isset($_POST['salvar'])){

        if(empty($_POST['cep-edit']) or empty($_POST['bairro-edit']) or empty($_POST['logradouro-edit']) or empty($_POST['n_residencial-edit'])){
                echo ('<script>window.alert("Preencha os campos!");window.location="endereco.php?edit=0"</script>');
        }else{

        $cep_edit = $_POST['cep-edit'];
        $endereco_edit = (get_endereco($cep_edit));
        $estado_edit = $endereco_edit->uf;
        $cidade_edit = $endereco_edit->localidade;
        $bairro_edit = $_POST['bairro-edit'];
        $logradouro_edit = $_POST['logradouro-edit'];
        $n_residencial_edit = $_POST['n_residencial-edit'];
        $complemento_edit = $_POST['complemento-edit'];

        $sql_update = 'update endereco set cep="'.$cep_edit.'", estado="'.$estado_edit.'", cidade="'.$cidade_edit.'", bairro="'.$bairro_edit.'", logradouro="'.$logradouro_edit.'", n_residencial='.$n_residencial_edit.', complemento="'.$complemento_edit.'" where endereco.id_endereco='.$_GET['edit'].';';
        $update = mysqli_query($conectar, $sql_update);

        if($update){
            echo ('<script>window.alert("Mudanças realizadas com sucesso!");window.location="endereco.php?edit=0"</script>');
        }else{
           echo ('<script>window.alert("Erro ao efetuar a mudança do endereço!");window.location="endereco.php?edit=0"</script>');
        }

        }
    }

    }else{}

    }else{
        header('location:../invalido.php');
    }

    ?>

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

    </body>
</html>