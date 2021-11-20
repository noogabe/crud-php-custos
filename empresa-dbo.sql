-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Nov-2021 às 21:44
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresa-dbo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacoes`
--

CREATE TABLE `classificacoes` (
  `id_classificacao` int(11) NOT NULL,
  `classificacao` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `classificacoes`
--

INSERT INTO `classificacoes` (`id_classificacao`, `classificacao`) VALUES
(1, 'ACESSÓRIOS'),
(2, 'ALIMENTAÇÃO'),
(3, 'DIÁRIAS'),
(5, 'HORA EXTRA'),
(6, 'MATERIAL ELÉTRICO'),
(7, 'MATERIAL HIDRÁULICO'),
(8, 'MATERIAL DE PINTURA'),
(9, 'MATÉRIA PRIMA'),
(10, 'MANUTENÇÃO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `empresa` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `empresa`) VALUES
(1, 'EMPRESA 1'),
(2, 'EMPRESA 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `cpf_cnpj` int(14) NOT NULL,
  `fornecedor` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` text NOT NULL,
  `sites` varchar(60) NOT NULL,
  `endereco` text NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `excluido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras_gerais`
--

CREATE TABLE `obras_gerais` (
  `id_obra_geral` int(11) NOT NULL,
  `obra_geral` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `obras_gerais`
--

INSERT INTO `obras_gerais` (`id_obra_geral`, `obra_geral`) VALUES
(3, 'Obra 1'),
(4, 'Obra 2'),
(5, 'Obra 3'),
(6, 'Obra 4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pgtos_obras`
--

CREATE TABLE `pgtos_obras` (
  `id_pagamento` int(11) NOT NULL,
  `tipo_documento` varchar(125) DEFAULT NULL,
  `tipo_movimento` int(1) DEFAULT NULL,
  `fornecedor` varchar(125) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `data_emissao` date DEFAULT NULL,
  `descricao` varchar(125) DEFAULT NULL,
  `classificacao` varchar(125) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `valor_unitario` double DEFAULT NULL,
  `valor_total` double DEFAULT NULL,
  `obra_geral` varchar(125) DEFAULT NULL,
  `empresa` varchar(125) DEFAULT NULL,
  `observacao` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pgtos_obras`
--

INSERT INTO `pgtos_obras` (`id_pagamento`, `tipo_documento`, `tipo_movimento`, `fornecedor`, `numero`, `data_emissao`, `descricao`, `classificacao`, `qtd`, `valor_unitario`, `valor_total`, `obra_geral`, `empresa`, `observacao`) VALUES
(24, 'NFS', 1, 'FORNECEDOR2', 123, '2021-10-18', 'UM NOME DE UM SERVIÇO QUALQUER', 'ACESSÓRIOS', 6, 58, 348, 'Obra 1', 'EMPRESA 1', 'UMA OBSERVAÇÃO LONGA PRA TESTAR O TAMANHO'),
(26, 'NFS', 1, 'FORNECEDOR3', 4578, '2021-10-18', 'OUTRA DESCRIÇÃO', 'MANUTENÇÃO', 33, 889.99, 29369.67, 'Obra 1', 'EMPRESA 1', ''),
(27, 'NFE', 1, 'FORNECEDOR4', 1234, '2021-10-18', 'LUVAS P', 'MATERIAL DE PINTURA', 34, 150, 5100, 'Obra 4', 'EMPRESA 1', 'OUTRA OBSERVAÇÃO'),
(28, 'NFS', 1, 'FORNECEDOR5', 8798, '2021-10-18', 'INSTALAÇÃO ELÉTRICA', 'MATERIAL ELÉTRICO', 20, 150, 3000, 'Obra 1', 'EMPRESA 1', 'INSTALAÇÃO FEITA NA SALA 1\r\n'),
(29, 'NFE', 1, 'FORNECEDOR5', 7484, '2021-10-18', 'TOMADA DUAS ENTRADAS', 'MATERIAL ELÉTRICO', 30, 50, 1500, 'Obra 1', 'EMPRESA 1', 'TOMADAS PARA SALA 2\r\n'),
(30, 'NFE', 1, 'FORNECEDOR5', 2541, '2021-10-18', 'DISJUNTOR', 'MATERIAL ELÉTRICO', 10, 200, 2000, 'Obra 1', 'EMPRESA 1', 'DISTRIBUIDOS PARA TODOS OS SETORES\r\n'),
(31, 'NFE', 1, 'FORNECEDOR5', 5051, '2021-10-18', 'NOTEBOOK CORE I5 ASUS', 'ACESSÓRIOS', 5, 3500, 17500, 'Obra 1', 'EMPRESA 1', ''),
(32, 'NFE', 1, 'FORNECEDOR5', 5052, '2021-10-18', 'TECLADO ', 'ACESSÓRIOS', 10, 50, 500, 'Obra 2', 'EMPRESA 1', ''),
(33, 'NFE', 1, 'FORNECEDOR4', 5053, '2021-10-18', 'MOUSE', 'ACESSÓRIOS', 10, 30, 300, 'Obra 1', 'EMPRESA 1', ''),
(34, 'NFE', 1, 'FORNECEDOR5', 5054, '2021-10-18', 'MOUSEPAD', 'ACESSÓRIOS', 10, 20, 200, 'Obra 1', 'EMPRESA 1', ''),
(35, 'NFE', 1, 'FORNECEDOR5', 5056, '2021-10-18', 'CX CANETA ESFEROGRÁFICA AZUL', 'ACESSÓRIOS', 200, 2, 400, 'Obra 1', 'EMPRESA 1', ''),
(36, 'NFE', 1, 'FORNECEDOR5', 5057, '2021-10-18', 'LÁPIS', 'ACESSÓRIOS', 200, 2, 400, 'Obra 3', 'EMPRESA 1', ''),
(37, 'NFE', 1, 'teste UPDATE', 8484, '2021-11-20', 'teste', 'ACESSÓRIOS', 5, 4848.48, 24242.4, 'Obra 1', 'EMPRESA 1', ''),
(38, 'NFS', 1, 'TESTE update', 54545, '2021-11-20', 'TESTE', 'ACESSÓRIOS', 5, 54.54, 272.7, 'Obra 1', 'EMPRESA 1', ''),
(39, 'NFE', 0, 'FORNECEDOR MASTER', 6568, '2021-11-20', 'PRODUTO 1', 'ACESSÓRIOS', 5, 2045.44, 10227.2, 'Obra 1', 'EMPRESA 2', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_obras`
--

CREATE TABLE `sub_obras` (
  `fk_obra_geral` int(11) NOT NULL,
  `id_sub_obra` int(11) NOT NULL,
  `sub_obra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sub_obras`
--

INSERT INTO `sub_obras` (`fk_obra_geral`, `id_sub_obra`, `sub_obra`) VALUES
(6, 2, 'Sub obra A'),
(4, 3, 'Sub obra B'),
(4, 4, 'Sub obra C'),
(5, 5, 'Sub obra D'),
(6, 6, 'Sub obra E');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `empresa` varchar(125) NOT NULL,
  `ativo` int(11) NOT NULL,
  `centro` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `email`, `empresa`, `ativo`, `centro`) VALUES
(0000000001, 'gabriele', '38f629170ac3ab74b9d6d2cc411c2f3c', 'gabriele@email.com.br', 'Empresa 1', 1, 'locabox');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classificacoes`
--
ALTER TABLE `classificacoes`
  ADD PRIMARY KEY (`id_classificacao`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices para tabela `obras_gerais`
--
ALTER TABLE `obras_gerais`
  ADD PRIMARY KEY (`id_obra_geral`);

--
-- Índices para tabela `pgtos_obras`
--
ALTER TABLE `pgtos_obras`
  ADD PRIMARY KEY (`id_pagamento`);

--
-- Índices para tabela `sub_obras`
--
ALTER TABLE `sub_obras`
  ADD PRIMARY KEY (`id_sub_obra`),
  ADD KEY `fk_obra_geral` (`fk_obra_geral`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classificacoes`
--
ALTER TABLE `classificacoes`
  MODIFY `id_classificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `obras_gerais`
--
ALTER TABLE `obras_gerais`
  MODIFY `id_obra_geral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pgtos_obras`
--
ALTER TABLE `pgtos_obras`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `sub_obras`
--
ALTER TABLE `sub_obras`
  MODIFY `id_sub_obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `sub_obras`
--
ALTER TABLE `sub_obras`
  ADD CONSTRAINT `fk_obra_geral` FOREIGN KEY (`fk_obra_geral`) REFERENCES `obras_gerais` (`id_obra_geral`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
