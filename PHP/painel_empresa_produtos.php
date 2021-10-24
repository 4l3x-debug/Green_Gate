<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Green Gate | Página Produtos</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-empresa-produtos.css">
    	<link rel="stylesheet" href="../FONTAW/css/all.css">
    	<link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">
            
        .pagina-usuario{
            height: 950px;
        }

        .menuOculto{
            height: 96.9%;
        }

        </style>

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
                	<a href="painel_empresa.php"><i class="fas fa-user-circle"></i>
                        <div class="empresa">
                            <?php echo $dados_empresa['nome_empresa']; ?>        
                        </div></a>
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
            <a href="painel_empresa.php" class="icon"><i class="fas fa-store-alt"></i>Loja</a>
            <a href="#" class="icon"><i class="fas fa-tags"></i>Produtos</a>
            <a href="painel_empresa_avaliacoes.php" class="icon"><i class="fas fa-tasks"></i>Avaliações</a>
            <a href="painel_empresa_suporte.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

            <div class="adicionar-produtos">

                <h3>Adicionar Produtos</h3>
                
                <form action="#" method="POST">
                        
                    <div class="primeira">

                        Nome:
                        <input type="text" name="nome_produto">
                        
                        Marca:
                        <input type="text" name="marca">

                    </div>

                    <div class="segunda">
                        
                        Descrição:
                        <input type="text" name="descricao">

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

                $sql_empresas = 'select * from produto where id_empresa='.$dados_empresa['id_empresa'].';';
                $resul = mysqli_query($conectar,$sql_empresas);

                while($con = mysqli_fetch_array($resul)){
                    echo('<tr class="dados"><td>'.$con['nome_prod'].'</td><td>'.$con['preco'].'</td><td><a href=""><i class="fas fa-pen"></i></a></td><td><a href="delete_produto.php?del='.$con['id_produto'].'"><i class="fas fa-trash"></i></a></td></tr>');
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
            <a href="https://www.facebook.com/Green-Gate-103711395206238"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

    <?php

        if(isset($_POST['inserir'])){
            $nome_prod = $_POST['nome_produto'];
            $marca = $_POST['marca'];
            $descricao = $_POST['descricao'];
            $data_validade = $_POST['data_validade'];
            $preco = $_POST['preco'];
            $imagem = $_FILES["imagem"];

            $preco = str_replace(',','.', $preco);

            if(empty($imagem["name"])){

                $largura = 1500;
                $altura = 1500;
                $tamanho = 2048000;

                if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $imagem["type"])){
                    echo('Isso não é uma imagem.');
                }

                $dimensoes = getimagesize($imagem["tmp_name"]);

                if($dimensoes[0] > $largura){
                    echo ('A largura da imagem não deve ultrapassar de '.$largura.' pixels');
                }

                if($dimensoes[1] > $altura){
                    echo ('A altura da imagem não deve ultrapassar de '.$altura.' pixels');
                }

                if($imagem["size"] > $tamanho){
                    echo('A imagem deve ter no máximo '.$tamanho.' bytes');
                }

                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                $caminho_imagem = "../IMG/Imagem_Empresa/Produtos_Empresa/" . $nome_imagem;

                move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

            $sql_produtos = 'insert into produto (nome_prod, marca, data_validade, descricao, preco, imagem, id_empresa) values ("'.$nome_prod.'", "'.$marca.'", "'.$data_validade.'", "'.$descricao.'", '.$preco.', "'.$nome_imagem.'", '.$dados_empresa['id_empresa'].');';
            $adicionar_produto = mysqli_query($conectar, $sql_produtos);

                if($adicionar_produto){
                    echo ('<script>window.alert("Produto inserido com sucesso!");window.location="painel_empresa_produtos.php"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao inserir o produto!");window.location="painel_empresa_produtos.php"</script>');
                }

            }else{}


        }else{}


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