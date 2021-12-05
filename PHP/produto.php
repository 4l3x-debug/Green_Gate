<?php
session_start();
include('conexao.php');
include('barra_rolagem.php');

if (isset($_SESSION['id_usuario'])) {
    $tp_usuario = $_SESSION['tp_usuario'];
    $id_usuario = $_SESSION['id_usuario'];

    if ($tp_usuario == 0 or $tp_usuario == 2) {
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = ' . $id_usuario . ';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        $caminho = '?id_usuario=' . $dados_usuario['id_pf_fisico'] . '&tp_usuario=' . $dados_usuario['tp_usuario'] . '';

        if ($tp_usuario == 0) {
            $usuario = 'Administrador';
            $caminho_painel = '' . $usuario . '/painel_adm';
        } else {
            $usuario = 'Consumidor';
            $caminho_painel = '' . $usuario . '/painel_consumidor';
        }
    } elseif ($tp_usuario == 1 or $tp_usuario == 3) {
        $sql_usuario = 'select * from pf_juridico where id_pf_juridico = ' . $id_usuario . ';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        $caminho = '?id_usuario=' . $dados_usuario['id_pf_juridico'] . '&tp_usuario=' . $dados_usuario['tp_usuario'] . '';

        if ($tp_usuario == 1) {
            $usuario = 'Produtor';
            $caminho_painel = '' . $usuario . '/painel_produtor';
        } else {
            $usuario = 'Produtor_Consumidor';
            $caminho_painel = '' . $usuario . '/painel_produtor_consumidor';
        }
    } else {
    }
} else {
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title> Green Gate | Loja | Produto </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-produto.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-pesquisar.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>

</head>

<body bgcolor="#fdfaef">

    <!-- Box User Oculto -->

    <section id="background-box">
        <div id="abrir">
            <nav class="box-user" style="height: 17%;">
                <ul>
                    <a href=" <?php echo ($caminho_painel); ?>.php">
                        <li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li>
                    </a>
                    <a href="<?php echo ($usuario); ?>/editar_perfil.php">
                        <li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li>
                    </a>
                    <a href="invalido.php">
                        <li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li>
                    </a>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Cabeçalho -->

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
                if (!isset($_SESSION['id_usuario'])) {
                ?>

                    <div class="figuras" style="top: 40%;">
                        <div class="search-box">
                            <form method="GET">
                                <input type="text" name="conteudo" placeholder="Pesquisar...">
                                <input type="submit" name="pesquisar" value=""><i class="fas fa-search"></i>
                            </form>
                        </div>
                        <a href="login.php"><i class="fas fa-user-circle"></i></a>
                        <a href=""><i class="fas fa-shopping-cart"></i></a>
                    </div>

                <?php
                } else {

                    echo ('<div class="figuras" style="top: 30%;">
                        <div class="search-box">
                            <form action="" method="GET">
                                <input type="text" name="conteudo" placeholder="Pesquisar...">
                                <input type="submit" name="pesquisar" value=""><i class="fas fa-search"></i>
                            </form>
                        </div>
                        <a href="#" onclick="box()"><div class="usuario">
                            <img src="../IMG/Imagem_Usuario/' . $dados_usuario['imagem'] . '">
                        </div></a>
                        <a href=""><i class="fas fa-shopping-cart"></i></a>
                    </div>');
                }
                ?>
            </nav>
        </section>
    </header>

    <!--Produto-->

    <?php
    if (!isset($_GET['pesquisar'])) {

        $sql = 'select * from produto where id_produto = ' . $_GET['id_produto'] . ';';
        $query = mysqli_query($conectar, $sql);
        $dados_produto = mysqli_fetch_array($query);
    ?>

        <div id="all">
            <div id="fundo">
                <section class="sessao-produto">

                    <div class="container-produto">
                        <?php
                        echo ('<img src="../IMG/Imagem_Produtos/' . $dados_produto['imagem'] . '" alt="' . $dados_produto['nome_produto'] . '">');
                        ?>
                    </div>

                    <div class="container-info">

                        <span id="nome-produto">
                            <?php
                            echo ($dados_produto['nome_produto']);
                            ?>
                        </span>

                        <div id="preco-space">
                            <span id="cifra"> R$ </span> <span id="preco">
                                <?php
                                echo ($dados_produto['preco']);
                                ?>
                            </span>
                        </div>

                        <div class="espaco-botao" href="compra.php">
                            <?php
                            echo ('<a href="#" id="link_comprar" onclick="changeRoute()">Comprar</a>');
                            ?>
                        </div>

                        <input id="checkbox" type="checkbox">

                        <div class="espaco-carrinho">
                            <label id="carrinho" for="checkbox"> <span id="carro"> Carrinho </span> </label>
                        </div>

                        <div class="detalhes">
                            <h2> Detalhes do produto </h2>
                            <span>
                                <?php
                                echo ($dados_produto['descricao']);
                                echo ("<p>Marca: " . $dados_produto['marca'] . '</p>');
                                ?>
                            </span>
                        </div>

                        <div class="quantidade">
                            <p class="qtd" style="margin-right: 13px;">Quantidade</p>

                            <div class="qtd" style="border: 1px solid #c4c4c4;">
                                <input style="margin-left: 5px;" type="button" value="-" name="btn_menos" id="btn-menos" onclick="Counter(-1)">
                                <input value="1" type="text" id="contador" name="qtd">
                                <input style="margin-right: 5px;" type="button" value="+" name="btn_mais" id="btn-mais" onclick="Counter(1)">
                            </div>

                            <?php
                            $sql_quantidade = 'select * from produto where id_produto=' . $_GET['id_produto'] . ';';

                            $qnt_query = mysqli_query($conectar, $sql_quantidade);

                            $dados = mysqli_fetch_array($qnt_query);
                            ?>

                            <div class="rest-unidades">
                                <p><?php echo ($dados['quantidade']); ?> produtos restantes</p>
                            </div>
                        </div>

                </section>
            </div>
        </div>

        <?php
        if (!isset($_SESSION['id_usuario'])) {
            echo ('<script>window.alert("Faça o login primeiro!");window.location="login.php"</script>');
        } else {
        }
        ?>

    <?php
    } else {

        $conteudo_lojas = $_GET['conteudo'];
        $sql_pesquisar_lojas = 'select * from pf_juridico where tp_usuario = 1 and nome LIKE "' . $conteudo_lojas . '%" ORDER by nome ASC;';
        $resul_pesquisar_lojas = mysqli_query($conectar, $sql_pesquisar_lojas);

        $conteudo_produtos = $_GET['conteudo'];
        $sql_pesquisar_produtos = 'select * from produto where nome_produto LIKE "' . $conteudo_produtos . '%" ORDER by nome_produto ASC;';
        $resul_pesquisar_produtos = mysqli_query($conectar, $sql_pesquisar_produtos);
    ?>

        <section class="conteudo-pesquisar">

            <h2>Lojas</h2>

            <div class="lojas-pesquisadas">

                <?php
                while ($dados_pesquisar_lojas = mysqli_fetch_array($resul_pesquisar_lojas)) {
                    echo ('<div class="espacamento-lojas"><a href=""><article class="lojas">
            <img src="../IMG/Imagem_Usuario/' . $dados_pesquisar_lojas['imagem'] . '" alt="' . $dados_pesquisar_lojas['nome'] . '">
            </article></a></div>');
                }
                ?>

            </div>

            <h2>Produtos</h2>

            <div class="produtos_pesquisados">

                <?php
                while ($dados_produto = mysqli_fetch_array($resul_pesquisar_produtos)) {
                    echo ('<div class="container-produtos"><a href="produto.php?id_produto=' . $dados_produto['id_produto'] . '" class="descricao"><div class="info">  
            <img src="../IMG/Imagem_Produtos/' . $dados_produto['imagem'] . '" alt="' . $dados_produto['nome_produto'] . '">  
            <span class="preco"> R$' . $dados_produto['preco'] . '</span>
            <p>' . $dados_produto['nome_produto'] . '</p>
        </div></a></div>');
                }
                ?>

            </div>

        </section>

    <?php
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
            <a href="https://www.facebook.com/Green-Gate-103711395206238" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

    <script type="text/javascript">
        function Counter(op) {
            let contador = document.querySelector('#contador');
            let valorContador = parseInt(contador.value);

            if (op == -1) {
                contador.value = valorContador - 1;

            }
            if (op == 1) {
                contador.value = valorContador + 1;
            }
        }

        function changeRoute() {
            let link = document.querySelector('#link_comprar');
            let currentProductCount = document.querySelector('#contador').value;

            link.href = `compra.php?id_produto=<?php echo $dados_produto['id_produto']; ?>&qtd=${currentProductCount}`;
        }
    </script>

</body>

</html>