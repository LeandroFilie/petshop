-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 21-Dez-2020 às 21:18
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `petshop`
--
/* CREATE DATABASE IF NOT EXISTS `petshop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `petshop`; */

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE IF NOT EXISTS `agendamento` (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `cod_animal` int(11) NOT NULL,
  `hora` varchar(5) NOT NULL,
  `dia` date NOT NULL,
  PRIMARY KEY (`id_agendamento`),
  KEY `cod_animal` (`cod_animal`),
  KEY `cod_animal_2` (`cod_animal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agendamento`, `cod_animal`, `hora`, `dia`) VALUES
(7, 6, '13:00', '2020-12-24'),
(8, 5, '11:00', '2020-12-24'),
(10, 8, '12:00', '2020-12-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_raca` int(11) NOT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `cod_cliente` (`cod_cliente`),
  KEY `cod_raca` (`cod_raca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id_animal`, `nome`, `cod_cliente`, `cod_raca`) VALUES
(5, 'Thor', 18, 8),
(6, 'Luna', 19, 5),
(8, 'Thor', 20, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `telefone`, `email`) VALUES
(18, 'Leandro Gomes', '33333333333', '16999999999', 'leandro@email.com'),
(19, 'Julia Costa', '11111111111', '16999999998', 'julia@email.com'),
(20, 'Jose', '22222222222', '1699999997', 'jose@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especie`
--

CREATE TABLE IF NOT EXISTS `especie` (
  `id_especie` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `especie`
--

INSERT INTO `especie` (`id_especie`, `nome`) VALUES
(1, 'Cachorro'),
(2, 'Gato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca`
--

CREATE TABLE IF NOT EXISTS `raca` (
  `id_raca` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod_especie` int(11) NOT NULL,
  PRIMARY KEY (`id_raca`),
  KEY `cod_especie` (`cod_especie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `raca`
--

INSERT INTO `raca` (`id_raca`, `nome`, `cod_especie`) VALUES
(1, 'Akita', 1),
(2, 'American staffordshire terrier', 1),
(3, 'Persa', 2),
(4, 'Angora', 2),
(5, 'Pinsher', 1),
(6, 'Sem Raça Definida', 1),
(7, 'Sem Raça Definida', 2),
(8, 'Pastor-Alemão', 1),
(9, 'Labrador', 1),
(10, 'Golden', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` char(32) NOT NULL,
  `permissao` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `permissao`) VALUES
('1', 'admin@sistema.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('11111111111', 'julia@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('22222222222', 'jose@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('33333333333', 'leandro.gf03@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`cod_animal`) REFERENCES `animal` (`id_animal`);

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`cod_raca`) REFERENCES `raca` (`id_raca`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `raca`
--
ALTER TABLE `raca`
  ADD CONSTRAINT `raca_ibfk_1` FOREIGN KEY (`cod_especie`) REFERENCES `especie` (`id_especie`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
