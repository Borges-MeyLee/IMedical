-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Nov-2022 às 19:55
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `imedical`
--
CREATE DATABASE IF NOT EXISTS `imedical` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `imedical`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_paciente`
--

CREATE TABLE `tb_paciente` (
  `id_paciente` int(11) NOT NULL,
  `fk_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `celular` varchar(30) NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_procedimento`
--

CREATE TABLE `tb_procedimento` (
  `id_procedimento` int(11) NOT NULL,
  `id_tipo_procedimento` int(11) NOT NULL,
  `horario` datetime NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `fk_paciente` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `hr_executado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_procedimento`
--

CREATE TABLE `tb_tipo_procedimento` (
  `id_tipo_procedimento` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_tipo_procedimento`
--

INSERT INTO `tb_tipo_procedimento` (`id_tipo_procedimento`, `descricao`) VALUES
(1, 'Administração medicamentosa'),
(2, 'Curativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `tb_paciente`
--
ALTER TABLE `tb_paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `fk_admin` (`fk_admin`);

--
-- Índices para tabela `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  ADD PRIMARY KEY (`id_procedimento`),
  ADD KEY `fk_tipo_procedimento_idx` (`id_tipo_procedimento`),
  ADD KEY `fk_paciente_idx` (`fk_paciente`);

--
-- Índices para tabela `tb_tipo_procedimento`
--
ALTER TABLE `tb_tipo_procedimento`
  ADD PRIMARY KEY (`id_tipo_procedimento`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente`
--
ALTER TABLE `tb_paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  MODIFY `id_procedimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_tipo_procedimento`
--
ALTER TABLE `tb_tipo_procedimento`
  MODIFY `id_tipo_procedimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`fk_paciente`) REFERENCES `tb_paciente` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_procedimento` FOREIGN KEY (`id_tipo_procedimento`) REFERENCES `tb_tipo_procedimento` (`id_tipo_procedimento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
