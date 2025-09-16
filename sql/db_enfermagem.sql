-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/09/2025 às 12:20
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
  `id_paciente` int(11) NOT NULL,
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

--
-- Despejando dados para a tabela `tbl_anamnese`
--

INSERT INTO `tbl_anamnese` (`id`, `id_paciente`, `motivo`, `inicio_sintoma`, `descricao_sintoma`, `ja_aconteceu_antes`, `tem_doencas_cronicas`, `doencas_cronicas`, `tem_alergias`, `alergias`, `usa_medicamentos_continuos`, `medicamentos_continuos`, `tem_doencas_familia`, `doencas_familia`, `fuma`, `ingere_alcool`, `atividade_fisica`) VALUES
(12, 3, 'Dores de cabeça', '2025-09-03', 'dores na cabeça constante', 1, 0, 'sem doenças crônicas', 0, 'sem alergias', 0, 'não toma medicamentos contínuos', 0, 'Não tem doenças familiares', 0, 0, 1);

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

--
-- Despejando dados para a tabela `tbl_endereco`
--

INSERT INTO `tbl_endereco` (`id`, `rua`, `bairro`, `cidade`) VALUES
(6, 'Rua da Luz', 'Maças', 'Belo Horizonte'),
(10, 'Rua da Luz', 'Maças', 'Cidade do Relógio');

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

--
-- Despejando dados para a tabela `tbl_paciente`
--

INSERT INTO `tbl_paciente` (`id`, `nome`, `nome_pai`, `nome_pai_consta`, `nome_mae`, `nome_mae_consta`, `cpf`, `rg`, `ssp`, `telefone`, `cartao_sus`, `id_endereco`) VALUES
(3, 'Júlio', 'Julião', 0, 'Julia', 0, '1234567', '32432432', 'MA', '(11) 98881-2345', '2342343244', 6),
(7, 'Rafael', 'Julião', 0, 'Julia', 0, '1234567', '32432432', 'MA', '(11) 98881-2345', '2342343244', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_prontuario`
--

CREATE TABLE `tbl_prontuario` (
  `id` int(11) NOT NULL,
  `numero_prontuario` int(11) NOT NULL,
  `data_atendimento` date NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_prontuario`
--

INSERT INTO `tbl_prontuario` (`id`, `numero_prontuario`, `data_atendimento`, `id_paciente`) VALUES
(2, 1, '2025-03-22', 3),
(6, 2, '2025-09-14', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `nome`, `email`, `senha`, `data_registro`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$aqVzwRK/RTo4p25xP05wsus2OhkzYdnb4xRwDQdI5xcK5lpPhLKFm', '2025-03-30 17:40:52');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anamnese_paciente` (`id_paciente`);

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
-- Índices de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tbl_endereco`
--
ALTER TABLE `tbl_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_prontuario`
--
ALTER TABLE `tbl_prontuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  ADD CONSTRAINT `fk_anamnese_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tbl_paciente` (`id`);

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
