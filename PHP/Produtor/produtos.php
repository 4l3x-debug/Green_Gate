<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Produtos</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-empresa-produtos.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-produtos.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-box-user.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../../JS/script_editar_endereco.js"></script>
        <script type="text/javascript" src="../../JS/script_box_user.js"></script>
    </head>
    
    <body class="corpo-pagina-adm">

    <!-- Dados do Usuário -->

    <?php

    include('../conexao.php');
    
    session_start();
    
    if(!isset($_SESSION['id_usuario'])){
        unset($_SESSION['id_usuario']);
        header('location:../invalido.php');
    }

        $id = $_SESSION['id_usuario'];

        $sql_usuario = 'select * from pf_juridico where id_pf_juridico='.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        $caminho = '?id_usuario='.$dados_usuario['id_pf_juridico'].'&tp_usuario='.$dados_usuario['tp_usuario'].'';

        if($dados_usuario['tp_usuario'] == 1){
    

    ?>

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href="painel_produtor.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="../invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <section class="main-nav">
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
                    <a href="#" onclick="box()">
                        <div class="usuario">
                        <?php echo ('<img src="../../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">'); 
                        ?>         
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->

        <section class="pagina-usuario" onclick="boxFechar()">

    <!-- Menu para Administrar -->

        <script type="text/javascript" src="../../JS/script_painel_consumidor.js"></script>

        <aside id="menuOculto" class="menuOculto">
            <a href="javascript: void(0)" class="btnFechar" onclick="fecharNav()"><i class="fas fa-times"></i></a>
            <a href="#" class="icon"><i class="fas fa-tags"></i>Produtos</a>
            <a href="suporte.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

            <div class="adicionar-produtos">

                <h3>Adicionar Produtos</h3>
                
                <form method="POST" enctype="multipart/form-data">
                        
                    <div class="primeira">

                        Nome:
                        <input type="text" name="nome_produto" maxlength="40">
                        
                        Marca:
                        <input type="text" name="marca" maxlength="20">

                    </div>

                    <div class="segunda">
                        
                        Descrição:
                        <input type="text" name="descricao" maxlength="300">

                    </div>

                    <div class="terceira">
                        
                        Data de Validade:
                        <input type="date" name="data_validade">

                        Preço:
                        <input type="text" name="preco">

                    </div>

                    <div class="quarta">

                        Imagem:
                        <input type="file" name="imagem">
                        
                    </div>

                    <div class="quinta">

                        <div class="botao"><i class="fas fa-leaf">
                            <input type="submit" name="inserir" value="">
                        </i></div>
                        
                    </div>

                </form>

            </div>

            <div class="tabela-produto">

                <table align="center">

                    <tr>
                        <td>Nome</td>
                        <td>Preço</td>
                        <td>Editar</td>
                        <td>Excluir</td>
                    </tr>

                <?php

                $sql_empresas = 'select * from produto where id_produtor='.$id.';';
                $resul = mysqli_query($conectar,$sql_empresas);

                while($con = mysqli_fetch_array($resul)){
                    echo('<tr class="dados"><td>'.$con['nome_produto'].'</td><td>'.$con['preco'].'</td><td><a href="produtos.php?edit='.$con['id_produto'].'"><i class="fas fa-pen"></i></a></td><td><a href="delete_produto.php?del='.$con['id_produto'].'"><i class="fas fa-trash"></i></a></td></tr>');
                }    
        
                ?>

                </table>
                
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
            <a href="https://www.facebook.com/Green-Gate-103711395206238" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>
    
    <!-- Inserir Produtos -->
    
    <?php

        if(isset($_POST['inserir'])){

            if(empty($_POST['nome_produto']) or empty($_POST['marca']) or empty($_POST['descricao']) or empty($_POST['preco'])){
                echo ('<script>window.alert("Preencha os campos!");window.location="produtos.php?edit=0"</script>');
            }else{

            $nome_produto = $_POST['nome_produto'];
            $marca = $_POST['marca'];
            $data_validade = $_POST['data_validade'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];
            $imagem = $_FILES['imagem'];
            $date = date("Y-m-d", strtotime($data_validade));

            $preco = str_replace(',','.', $preco);

            $extensao = strtolower(substr($imagem['name'], -4));
            $nome_img = md5(time()) . $extensao;
            $diretorio = "../../IMG/Imagem_Produtos/";

            move_uploaded_file($imagem['tmp_name'], $diretorio . $nome_img);

            $sql = 'insert into produto (nome_produto, marca, dt_validade, preco, descricao, imagem, id_produtor) values ("'.$nome_produto.'","'.$marca .'","'.$date .'",'.$preco.',"'.$descricao.'","'.$nome_img.'", '.$id.');';

            $sql_query = mysqli_query($conectar, $sql);

                if($sql_query){
                    echo ('<script>window.alert("Produto inserido com sucesso!");window.location="produtos.php?edit=0"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao inserir o produto!");window.location="produtos.php?edit=0"</script>');
                }

            }

        }else{}

    if($_GET['edit']){

    $sql = 'select * from produto where id_produto='.$_GET['edit'].';';
    $resul_editar = mysqli_query($conectar, $sql);
    $editar = mysqli_fetch_array($resul_editar);

    ?>

    <section id="editar">
        <a href="produtos.php?edit=0"><i class="fas fa-times"></i></a>
        <div class="editar-produtos">

            <h2>Produto</h2>

            <form method="POST">

                <div class="edit um">
                    Nome: <input type="text" name="nome-edit" value="<?php echo $editar['nome_produto']; ?>">
                </div>

                <div class="edit dois">
                    Marca: <input type="text" name="marca-edit" value="<?php echo $editar['marca']; ?>">
                </div>

                <div class="edit tres">
                    Data de Validade: <input type="date" name="data-edit" value="<?php echo $editar['dt_validade']; ?>">
                </div>

                <div class="edit quatro">
                    Descrição: <input type="text" name="descricao-edit" value="<?php echo $editar['descricao']; ?>">
                </div>

                <div class="edit cinco">
                    Preço: <input type="text" name="preco-edit" value="<?php echo $editar['preco']; ?>">
                </div>

                <div>
                    Imagem: <input type="file" name="imagem-edit" value="<?php echo $editar['imagem']; ?>">
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

    <!-- Editar Produto -->
    
    <?php

    }else{
    
    if(isset($_POST['salvar'])){

            if(empty($_POST['nome-edit']) or empty($_POST['marca-edit']) or empty($_POST['descricao-edit']) or empty($_POST['preco-edit'])){
                echo ('<script>window.alert("Preencha os campos!");window.location="produtos.php?edit=0"</script>');
            }else{

            $nome_edit = $_POST['nome-edit'];
            $marca_edit = $_POST['marca-edit'];
            $data_validade_edit = $_POST['data-edit'];
            $preco_edit = $_POST['preco-edit'];
            $descricao_edit = $_POST['descricao-edit'];
            $imagem_edit = $_FILES['imagem-edit'];
            $date_edit = date("Y-m-d", strtotime($data_validade_edit));

            $preco_edit = str_replace(',','.', $preco_edit);

            $extensao = strtolower(substr($imagem_edit['name'], -4));
            $nome_img = md5(time()) . $extensao;
            $diretorio = "../../IMG/Imagem_Produtos/";

            move_uploaded_file($imagem['tmp_name'], $diretorio . $nome_img);

            $sql_update = 'update produto set nome_produto="'.$nome_edit.'", marca="'.$marca_edit .'", dt_validade="'.$date_edit .'", preco='.$preco_edit.', descricao="'.$descricao_edit.'", imagem="'.$nome_img.'" where produto.id_produto='.$_GET['edit'].';';

            $sql_query = mysqli_query($conectar, $sql_update);

                if($sql_query){
                    echo ('<script>window.alert("Mudança realizada com sucesso!");window.location="produtos.php?edit=0"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao editar o produto!");window.location="produtos.php?edit=0"</script>');
                }

            }

        }else{}

    ?>

    <?php
    }
            }else{
                header('location:invalido.php');
            }
    ?>

    </body>
</html>