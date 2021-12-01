-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Dez-2021 às 13:59
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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
  `id_prod_cons` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedido_consumidor` (`id_consumidor`),
  KEY `fk_pedido_prod_cons` (`id_prod_cons`),
  KEY `fk_pedido_produto` (`id_produto`)
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
  PRIMARY KEY (`id_pedido_produto`),
  KEY `fk_produto_pedido` (`id_produto`)
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
  `id_remetente` int(11) NOT NULL,
  `tp_usuario_remetente` int(1) NOT NULL,
  PRIMARY KEY (`id_suporte`),
  KEY `fk_suporte_pf_fisico` (`id_pf_fisico`),
  KEY `fk_suporte_pf_juridico` (`id_pf_juridico`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
