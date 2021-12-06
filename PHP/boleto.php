<?php
    session_start();
    include ('conexao.php');
    include ('barra_rolagem.php');

    if(isset($_SESSION['id_usuario'])){
        $tp_usuario = $_SESSION['tp_usuario'];
        $id_usuario = $_SESSION['id_usuario'];

        if($tp_usuario == 2){
            $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);
            $cnpj_ou_cpf = $dados_usuario['cpf'];

        }
        elseif($tp_usuario == 3){
            $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);
            $cnpj_ou_cpf = $dados_usuario['cnpj'];

        }else{}

    }else{}
?>
<link rel="stylesheet" href="../FONTAW/css/all.css">
<style>
    body{
        position: absolute;
        left: 25%;
    }

    button{
        position: absolute;
        right: -197px;
        font-size: 30px;
        top: 27px;
        width: 50px;
        height: 50px;
        border-radius: 44px;
        border: 0;
        cursor: pointer;
    }
</style>

<button value="imprimir" onclick="window.print()"><i class="fas fa-print"></i></button>

<?php

if(isset($_POST['continuar'])){
    $endereco = $_POST['endereco'];

    $sql_endereco = 'select * from endereco where n_residencial='.$endereco.';';
    $resul_endereco = mysqli_query($conectar,$sql_endereco);
    $dados_endereco = mysqli_fetch_array($resul_endereco);
}

$sql = "select * from produto where id_produto= " . $_GET['id_prod'] . ";";
$query = mysqli_query($conectar, $sql);
$dados_prod = mysqli_fetch_array($query);

$sqlProdutor = "select * from pf_juridico where id_pf_juridico = " . $dados_prod['id_produtor'] . ";";
$queryProdutor = mysqli_query($conectar, $sqlProdutor);
$dadosProdutor = mysqli_fetch_array($queryProdutor);

$dias_de_prazo_para_pagamento = 6;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $_SESSION['valorTotal']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".", $valor_cobrado);
$valor_boleto = $valor_cobrado;

$dadosboleto["campo_fixo_obrigatorio"] = "1";       // campo fixo obrigatorio - valor = 1 
$dadosboleto["inicio_nosso_numero"] = "9";          // Inicio do Nosso numero - obrigatoriamente deve começar com 9;
$dadosboleto["numero_documento"] = $dadosProdutor['cnpj'];    // Num do pedido ou do documento
$dadosboleto["nosso_numero"] = $dadosProdutor['celular'];  // Nosso numero sem o DV - REGRA: Máximo de 16 caracteres! (Pode ser um número sequencial do sistema, o cpf ou o cnpj)
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto;     // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $dados_usuario['nome'];
$dadosboleto["endereco1"] = $dados_endereco['logradouro'];
$dadosboleto["endereco2"] = $dados_endereco['cidade']."-".$dados_endereco['estado']."-".$dados_endereco['cep'];


// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = $dados_prod['preco'];
$dadosboleto["aceite"] = "";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["conta"] = "13877";     // Num da conta, sem digito
$dadosboleto["conta_dv"] = "4";     // Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] = "057335"; // ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente_dv"] = ""; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "SR";  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = $cnpj_ou_cpf;
$dadosboleto["endereco"] = "Coloque o endereço da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Cidade / Estado";
$dadosboleto["cedente"] = $dadosProdutor['razao'];

// NÃO ALTERAR!
include("funcoes_cef_sinco.php");
include("layout_cef_sinco.php");
