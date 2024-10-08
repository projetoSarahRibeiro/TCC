-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/10/2024 às 00:28
-- Versão do servidor: 10.11.9-MariaDB
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u301136860_pqe`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `criancas`
--

CREATE TABLE `criancas` (
  `id_cria` int(11) NOT NULL,
  `nome_cria` varchar(255) DEFAULT NULL,
  `email_cria` varchar(255) DEFAULT NULL,
  `senha_cria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `criancas`
--

INSERT INTO `criancas` (`id_cria`, `nome_cria`, `email_cria`, `senha_cria`) VALUES
(0, 'Laura', 'laura@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estrutura para tabela `psicologos`
--

CREATE TABLE `psicologos` (
  `id_psi` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `fk_criancas_id_cria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `psicologos`
--

INSERT INTO `psicologos` (`id_psi`, `nome`, `email`, `senha`, `fk_criancas_id_cria`) VALUES
(0, 'Sarah ', 'sarah@gmail.com', '123', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `criancas`
--
ALTER TABLE `criancas`
  ADD PRIMARY KEY (`id_cria`);

--
-- Índices de tabela `psicologos`
--
ALTER TABLE `psicologos`
  ADD PRIMARY KEY (`id_psi`),
  ADD KEY `FK_psicologos_2` (`fk_criancas_id_cria`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `psicologos`
--
ALTER TABLE `psicologos`
  ADD CONSTRAINT `FK_psicologos_2` FOREIGN KEY (`fk_criancas_id_cria`) REFERENCES `criancas` (`id_cria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
