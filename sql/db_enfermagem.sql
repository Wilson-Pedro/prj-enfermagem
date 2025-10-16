-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/10/2025 às 02:20
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
  `rh` varchar(255) NOT NULL,
  `sinais_vitais` varchar(255) NOT NULL,
  `ja_aconteceu_antes` tinyint(1) NOT NULL,
  `tem_doencas_cronicas` tinyint(1) NOT NULL,
  `doencas_cronicas` varchar(255) NOT NULL,
  `tem_alergias` tinyint(1) NOT NULL,
  `alergias` varchar(255) NOT NULL,
  `usa_medicamentos_continuos` tinyint(1) NOT NULL,
  `medicamentos_continuos` varchar(255) NOT NULL,
  `tem_doencas_familia` tinyint(1) NOT NULL,
  `doencas_familia` varchar(255) NOT NULL,
  `outras_drogas` varchar(255) NOT NULL,
  `outras_drogas_descricao` varchar(255) NOT NULL,
  `fuma` tinyint(1) NOT NULL,
  `ingere_alcool` tinyint(1) NOT NULL,
  `atividade_fisica` tinyint(1) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_endereco`
--

CREATE TABLE `tbl_endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `complemento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_endereco`
--

INSERT INTO `tbl_endereco` (`id`, `cep`, `rua`, `bairro`, `cidade`, `complemento`) VALUES
(2, '68971970', 'Rua da Luz', 'Goiabas', 'Belo Horizonte', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_exame_fisico`
--

CREATE TABLE `tbl_exame_fisico` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `pa` varchar(100) NOT NULL,
  `glicemia` varchar(100) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `tipagem_sanguinea` varchar(30) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_paciente`
--

CREATE TABLE `tbl_paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nome_mae` varchar(255) NOT NULL,
  `nome_mae_consta` tinyint(1) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `ssp` varchar(10) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cartao_sus` varchar(255) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_paciente`
--

INSERT INTO `tbl_paciente` (`id`, `nome`, `data_nascimento`, `nome_mae`, `nome_mae_consta`, `cpf`, `rg`, `ssp`, `telefone`, `cartao_sus`, `id_endereco`, `registro`) VALUES
(2, 'Rafaela', '1999-10-14', 'Julia', 0, '34276512387', '45646546', 'MA', '(11) 98881-2345', '', 2, '2025-10-15 23:53:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_prontuario`
--

CREATE TABLE `tbl_prontuario` (
  `id` int(11) NOT NULL,
  `numero_prontuario` int(11) NOT NULL,
  `data_atendimento` date NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_prontuario`
--

INSERT INTO `tbl_prontuario` (`id`, `numero_prontuario`, `data_atendimento`, `id_paciente`, `registro`) VALUES
(1, 1234, '2025-10-15', 2, '2025-10-15 23:53:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`id`, `tipo_usuario`) VALUES
(1, 'admin'),
(2, 'professor'),
(3, 'aluno');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `id_tipo_usuario`, `nome`, `matricula`, `cpf`, `senha`, `data_registro`) VALUES
(3, 1, 'Ana', '2025', '11111111111', '$2y$10$WtZ1xf1ubQ4IRnCTKwyho.wA9mYRoB8nKs5ftASRxXSU5qCEi3ul6', '2025-10-15 23:18:29'),
(8, 2, 'Carla da Silva', '20251', '1234567', '$2y$10$Ganf9XyoHw6JwtiiMWcPBuDRyTS1NCdBY3wqHqAvzThMnlLFOC.Aq', '2025-10-12 12:11:50'),
(9, 3, 'Murilo SIlva', '20252', '123456', '$2y$10$zZRLD1o0v/yp4M84x4fwV.RBDumQt7UxPIe99nx3u9cAzVmJs6YvK', '2025-10-12 12:21:55');

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
-- Índices de tabela `tbl_exame_fisico`
--
ALTER TABLE `tbl_exame_fisico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exame_fisica_paciente` (`id_paciente`);

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
-- Índices de tabela `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula_unica` (`matricula`),
  ADD KEY `fk_user_tipo_usuario` (`id_tipo_usuario`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_exame_fisico`
--
ALTER TABLE `tbl_exame_fisico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de tabela `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_anamnese`
--
ALTER TABLE `tbl_anamnese`
  ADD CONSTRAINT `fk_anamnese_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tbl_paciente` (`id`);

--
-- Restrições para tabelas `tbl_exame_fisico`
--
ALTER TABLE `tbl_exame_fisico`
  ADD CONSTRAINT `fk_exame_fisica_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tbl_paciente` (`id`);

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

--
-- Restrições para tabelas `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_user_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
