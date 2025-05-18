-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/09/2024 às 19:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco-site-trailher`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_Endereco` int(11) NOT NULL,
  `Rua` varchar(255) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Bairro` varchar(255) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `fk_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredienteativo`
--

CREATE TABLE `ingredienteativo` (
  `fk_Ingrediente` int(11) NOT NULL,
  `fk_Produto` int(11) NOT NULL,
  `Ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_Ingrediente` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_Pedido` int(11) NOT NULL,
  `PrecoTotal` decimal(10,2) NOT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `fk_Usuario` int(11) DEFAULT NULL,
  `fk_Produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_Produto` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Preco` double NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `fk_TipoProduto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtofavorito`
--

CREATE TABLE `produtofavorito` (
  `fk_Usuario` int(11) DEFAULT NULL,
  `fk_Produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoproduto`
--

CREATE TABLE `tipoproduto` (
  `id_TipoProduto` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `fk_Endereco` int(11) DEFAULT NULL,
  `UsuarioAdiministrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_Endereco`),
  ADD KEY `fk_Usuario` (`fk_Usuario`);

--
-- Índices de tabela `ingredienteativo`
--
ALTER TABLE `ingredienteativo`
  ADD KEY `fk_Ingrediente` (`fk_Ingrediente`),
  ADD KEY `fk_Produto` (`fk_Produto`);

--
-- Índices de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_Ingrediente`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_Pedido`),
  ADD KEY `fk_Usuario` (`fk_Usuario`),
  ADD KEY `fk_Produto` (`fk_Produto`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_Produto`),
  ADD KEY `fk_TipoProduto` (`fk_TipoProduto`);

--
-- Índices de tabela `produtofavorito`
--
ALTER TABLE `produtofavorito`
  ADD KEY `fk_Usuario` (`fk_Usuario`),
  ADD KEY `fk_Produto` (`fk_Produto`);

--
-- Índices de tabela `tipoproduto`
--
ALTER TABLE `tipoproduto`
  ADD PRIMARY KEY (`id_TipoProduto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD KEY `fk_Endereco` (`fk_Endereco`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_Endereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_Ingrediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_Produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipoproduto`
--
ALTER TABLE `tipoproduto`
  MODIFY `id_TipoProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`fk_Usuario`) REFERENCES `usuario` (`id_Usuario`);

--
-- Restrições para tabelas `ingredienteativo`
--
ALTER TABLE `ingredienteativo`
  ADD CONSTRAINT `ingredienteativo_ibfk_1` FOREIGN KEY (`fk_Ingrediente`) REFERENCES `ingredientes` (`id_Ingrediente`),
  ADD CONSTRAINT `ingredienteativo_ibfk_2` FOREIGN KEY (`fk_Produto`) REFERENCES `produto` (`id_Produto`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`fk_Usuario`) REFERENCES `usuario` (`id_Usuario`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`fk_Produto`) REFERENCES `produto` (`id_Produto`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`fk_TipoProduto`) REFERENCES `tipoproduto` (`id_TipoProduto`);

--
-- Restrições para tabelas `produtofavorito`
--
ALTER TABLE `produtofavorito`
  ADD CONSTRAINT `produtofavorito_ibfk_1` FOREIGN KEY (`fk_Usuario`) REFERENCES `usuario` (`id_Usuario`),
  ADD CONSTRAINT `produtofavorito_ibfk_2` FOREIGN KEY (`fk_Produto`) REFERENCES `produto` (`id_Produto`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_Endereco`) REFERENCES `endereco` (`id_Endereco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
