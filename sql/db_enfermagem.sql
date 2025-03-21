-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/03/2025 às 12:39
-- Versão do servidor: 10.6.15-MariaDB
-- Versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_enfermagem`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_anamnese`
--

CREATE TABLE `tbl_anamnese` (
  `id` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `inicio_sintoma` date NOT NULL,
  `descricao_sintoma` varchar(255) NOT NULL,
  `ja_aconteceu_antes` tinyint(1) NOT NULL,
  `tem_doencas_cronicas` tinyint(1) NOT NULL,
  `doencas_cronicas` varchar(255) NOT NULL,
  `tem_alergias` tinyint(1) NOT NULL,
  `alergias` varchar(255) NOT NULL,
  `usa_medicamentos_continuos` tinyint(1) NOT NULL,
  `medicamentos_continuos` varchar(255) NOT NULL,
  `tem_doencas_familia` tinyint(1) NOT NULL,
  `doencas_familia` varchar(255) NOT NULL,
  `fuma` tinyint(1) NOT NULL,
  `ingere_alcool` tinyint(1) NOT NULL,
  `atividade_fisica` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_endereco`
--

CREATE TABLE `tbl_endereco` (
  `id` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_paciente`
--

CREATE TABLE `tbl_paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nome_pai` varchar(255) NOT NULL,
  `nome_pai_consta` tinyint(1) NOT NULL,
  `nome_mae` varchar(255) NOT NULL,
  `nome_mae_consta` tinyint(1) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `ssp` varchar(10) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cartao_sus` varchar(255) NOT NULL,
  `id_endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_prontuario`
--

CREATE TABLE `tbl_prontuario` (
  `id` int(11) NOT NULL,
  `numero_formulario` int(11) NOT NULL,
  `data_atendimento` date NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_endereco`
--
ALTER TABLE `tbl_endereco`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paciente_endereco` (`id_endereco`);

--
-- Índices de tabela `tbl_prontuario`
--
ALTER TABLE `tbl_prontuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prontuario_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_endereco`
--
ALTER TABLE `tbl_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_prontuario`
--
ALTER TABLE `tbl_prontuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD CONSTRAINT `fk_paciente_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id`);

--
-- Restrições para tabelas `tbl_prontuario`
--
ALTER TABLE `tbl_prontuario`
  ADD CONSTRAINT `fk_prontuario_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tbl_paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
