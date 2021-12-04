-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Dez-2021 às 18:20
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `green_gate_final`
--
CREATE DATABASE IF NOT EXISTS `green_gate_final` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `green_gate_final`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `nota` int(1) DEFAULT NULL,
  `id_pf_fisico` int(11) DEFAULT NULL,
  `id_pf_juridico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `fk_avaliacao_pf_fisico` (`id_pf_fisico`),
  KEY `fk_avaliacao_pf_juridico` (`id_pf_juridico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(9) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `logradouro` varchar(50) DEFAULT NULL,
  `n_residencial` int(4) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `tp_usuario` int(1) DEFAULT NULL,
  `id_pf_fisico` int(11) DEFAULT NULL,
  `id_pf_juridico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_pf_fisico_endereco` (`id_pf_fisico`),
  KEY `fk_pf_juridico_endereco` (`id_pf_juridico`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `cep`, `estado`, `cidade`, `bairro`, `logradouro`, `n_residencial`, `complemento`, `tp_usuario`, `id_pf_fisico`, `id_pf_juridico`) VALUES
(26, '07411220', 'SP', 'ArujÃ¡', 'JordanÃ³polis', 'Rua Santo AntÃ´nio do CatigerÃ³', 332, 'Casa Branca', 1, NULL, 27),
(24, '07411220', 'SP', 'ArujÃ¡', 'JordanÃ³polis', 'Rua Santo AntÃ´nio do CatigerÃ³', 332, 'Casa Verde', 1, NULL, 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `tp_pagamento` int(1) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `fk_pagamento_pedido` (`id_pedido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `dt_pedido` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `id_consumidor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedido_consumidor` (`id_consumidor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

DROP TABLE IF EXISTS `pedido_produto`;
CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `id_pedido_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor` decimal(6,2) DEFAULT NULL,
  `id_pedido` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido_produto`),
  KEY `fk_produto_pedido` (`id_produto`),
  KEY `fk_pedido_produto` (`id_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pf_fisico`
--

DROP TABLE IF EXISTS `pf_fisico`;
CREATE TABLE IF NOT EXISTS `pf_fisico` (
  `id_pf_fisico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tp_usuario` int(1) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `genero` varchar(1) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pf_fisico`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pf_fisico`
--

INSERT INTO `pf_fisico` (`id_pf_fisico`, `nome`, `email`, `senha`, `tp_usuario`, `cpf`, `celular`, `data_nascimento`, `data_cadastro`, `genero`, `imagem`) VALUES
(21, 'Nathalia dos Santos', 'nathalia@hotmail.com', '202cb962ac59075b964b07152d234b70', 2, '40956907806', '11954945225', '2003-08-21', '2021-12-03', 'F', '8f7b1081f96679ccdfcc38c071c96d27.png'),
(22, 'Green Gato', 'green_gate@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, '40956907810', '11954945226', '2003-08-21', '2021-12-04', 'F', 'ac974c54eb1204a4431cd2dddabc2618.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pf_juridico`
--

DROP TABLE IF EXISTS `pf_juridico`;
CREATE TABLE IF NOT EXISTS `pf_juridico` (
  `id_pf_juridico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tp_usuario` int(1) NOT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `celular` varchar(12) NOT NULL,
  `razao` varchar(150) NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  `genero` varchar(1) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `plano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pf_juridico`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pf_juridico`
--

INSERT INTO `pf_juridico` (`id_pf_juridico`, `nome`, `email`, `senha`, `tp_usuario`, `cnpj`, `celular`, `razao`, `data_cadastro`, `genero`, `imagem`, `plano`) VALUES
(27, 'Marcelo Rodrigues', 'marcelo@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, '25.534.696/0001-67', '11954945225', 'Venda de Eco Bags', '2021-12-03', 'M', '29ea60dd372e15b1e4b09d08475d035b.png', 0),
(28, 'Meu Eco BebÃª', 'meu_eco@hotmail.com', '202cb962ac59075b964b07152d234b70', 1, '337.534.300/0013-3', '11954945225', 'Fraldas EcolÃ³gicas', '2021-12-03', 'F', 'b34ff626eb85b04858b083b31ec72e0e.png', 0),
(30, 'Oi', 'oi1@hotmail.com', '202cb962ac59075b964b07152d234b70', 3, '47508411-0225-59', '11954945225', 'Produtos SustentÃ¡veis', '2021-12-04', 'F', 'girl.png', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(40) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `dt_validade` date DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `preco` decimal(6,2) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `id_produtor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_produtor_produto` (`id_produtor`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `marca`, `dt_validade`, `descricao`, `preco`, `quantidade`, `imagem`, `id_produtor`) VALUES
(34, 'Bolsa SustentÃ¡vel', 'Eco Bags', '1970-01-01', 'Bolsa feita de pano', '25.00', 12, '4b0bb10e1612f6ea9fef943819f5130d.png', 25),
(33, 'Sabonete DepilatÃ³rio', 'Eco Soap', '1970-01-01', 'Sabonete para pelos faciais', '20.00', 13, '901c5a791d15538e1ee01f1103e10d83.png', 25),
(29, 'Eco Bag', 'Eco Bags', '1970-01-01', 'Bolsa SustentÃ¡vel', '7.00', 20, '91a54d99ed92b4308005d9f47c5797ee.png', 27),
(31, 'Ã“leo Vegetal', 'Eco Oil', '1970-01-01', 'OlÃ©o vegetal', '60.00', 5, '9f10901a3b00d28af6d22cb5bf58ae70.png', 25),
(30, 'Shampo SÃ³lido', 'Eco Soap', '1970-01-01', 'Shampo em barra', '10.00', 15, 'cfe3c88960800c8b0bf3000f0d532566.png', 25),
(32, 'Escova EcolÃ³gica', 'Eco ToothBrush', '1970-01-01', 'Escova feita de madeira e cerdas ecolÃ³gicas', '10.00', 13, 'a8efe8e663d04fd6d1b5b292587ec3fe.png', 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `suporte`
--

DROP TABLE IF EXISTS `suporte`;
CREATE TABLE IF NOT EXISTS `suporte` (
  `id_suporte` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(150) DEFAULT NULL,
  `conteudo` varchar(550) DEFAULT NULL,
  `data_envio` date DEFAULT NULL,
  `id_pf_fisico` int(11) DEFAULT NULL,
  `id_pf_juridico` int(11) DEFAULT NULL,
  `id_remetente` int(11) DEFAULT NULL,
  `tp_usuario_remetente` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_suporte`),
  KEY `fk_suporte_pf_fisico` (`id_pf_fisico`),
  KEY `fk_suporte_pf_juridico` (`id_pf_juridico`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `suporte`
--

INSERT INTO `suporte` (`id_suporte`, `assunto`, `conteudo`, `data_envio`, `id_pf_fisico`, `id_pf_juridico`, `id_remetente`, `tp_usuario_remetente`) VALUES
(43, 'Bem-vinda', 'Bem-vindo ao Green Gate!', '2021-12-04', NULL, 25, 20, 0),
(46, 'dasdas', 'dasdasdas', '2021-12-04', 22, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
