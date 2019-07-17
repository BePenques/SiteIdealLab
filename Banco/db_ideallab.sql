-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Jun-2019 às 20:23
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ideallab`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clie`
--

CREATE TABLE `tb_clie` (
  `clie_id` int(11) NOT NULL,
  `clie_nome` varchar(80) NOT NULL,
  `clie_email` varchar(80) NOT NULL,
  `clie_tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_equi`
--

CREATE TABLE `tb_equi` (
  `equi_id` int(11) NOT NULL,
  `fabr_id` int(11) DEFAULT NULL,
  `forn_id` int(11) DEFAULT NULL,
  `equi_nome` varchar(255) NOT NULL,
  `equi_fabr` varchar(255) NOT NULL,
  `equi_forn` varchar(255) NOT NULL,
  `equi_mod` varchar(255) NOT NULL,
  `equi_marc` varchar(100) DEFAULT NULL,
  `equi_img` varchar(255) NOT NULL,
  `equi_desc` varchar(255) NOT NULL,
  `equi_val` decimal(9,0) NOT NULL,
  `equi_cara` text NOT NULL,
  `equi_tipo_basi` varchar(13) NOT NULL,
  `equi_tipo_inter` varchar(13) NOT NULL,
  `equi_tipo_avan` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_exij`
--

CREATE TABLE `tb_exij` (
  `exij_id` int(11) NOT NULL,
  `exij_tit` varchar(80) NOT NULL,
  `exij_desc` text NOT NULL,
  `exij_font` varchar(80) NOT NULL,
  `exij_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fabr`
--

CREATE TABLE `tb_fabr` (
  `fabr_id` int(11) NOT NULL,
  `fabr_nome` tinytext NOT NULL,
  `fabr_end` tinytext NOT NULL,
  `fabr_resp` tinytext NOT NULL,
  `fabr_mail` varchar(50) NOT NULL,
  `fabr_tel` varchar(20) NOT NULL,
  `fabr_cnpj` varchar(20) NOT NULL,
  `fabr_ie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_forn`
--

CREATE TABLE `tb_forn` (
  `forn_id` int(11) NOT NULL,
  `forn_nome` tinytext NOT NULL,
  `forn_end` tinytext NOT NULL,
  `forn_resp` tinytext NOT NULL,
  `forn_mail` varchar(50) NOT NULL,
  `forn_tel` varchar(20) NOT NULL,
  `forn_cnpj` varchar(20) NOT NULL,
  `forn_ie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_labo`
--

CREATE TABLE `tb_labo` (
  `labo_id` int(11) NOT NULL,
  `labo_tipo` varchar(80) NOT NULL,
  `labo_alt` decimal(9,2) NOT NULL,
  `labo_lar` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_norm`
--

CREATE TABLE `tb_norm` (
  `norm_id` int(11) NOT NULL,
  `norm_tit` varchar(80) NOT NULL,
  `norm_desc` text NOT NULL,
  `norm_font` varchar(80) NOT NULL,
  `norm_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_noti`
--

CREATE TABLE `tb_noti` (
  `noti_id` int(11) NOT NULL,
  `usua_id` int(11) DEFAULT NULL,
  `noti_tit` varchar(120) NOT NULL,
  `noti_txt` text NOT NULL,
  `noti_img` varchar(255) NOT NULL,
  `noti_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `email`, `senha`, `tipo`) VALUES
(1, 'joao@teste01', '12345', 'SUP'),
(2, 'maria@teste02', '23456', 'ADM'),
(3, 'betiza@teste03', '45677', 'ADM'),
(4, 'rosana@teste04', '87998', 'SUP'),
(5, 'be@hthth', '1234', 'SUP'),
(6, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(9, '', '', ''),
(10, 'teste@teste2', 'hahaha', ''),
(11, '', '', ''),
(12, '', '', ''),
(13, '', '', ''),
(14, '', '', ''),
(15, 'teste2@haha', 'huhu', ''),
(16, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usua`
--

CREATE TABLE `tb_usua` (
  `usua_id` int(11) NOT NULL,
  `usua_nome` varchar(80) NOT NULL,
  `usua_senha` varchar(80) NOT NULL,
  `usua_tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_clie`
--
ALTER TABLE `tb_clie`
  ADD PRIMARY KEY (`clie_id`);

--
-- Indexes for table `tb_equi`
--
ALTER TABLE `tb_equi`
  ADD PRIMARY KEY (`equi_id`),
  ADD KEY `fabr_id` (`fabr_id`),
  ADD KEY `forn_id` (`forn_id`);

--
-- Indexes for table `tb_exij`
--
ALTER TABLE `tb_exij`
  ADD PRIMARY KEY (`exij_id`);

--
-- Indexes for table `tb_fabr`
--
ALTER TABLE `tb_fabr`
  ADD PRIMARY KEY (`fabr_id`);

--
-- Indexes for table `tb_forn`
--
ALTER TABLE `tb_forn`
  ADD PRIMARY KEY (`forn_id`);

--
-- Indexes for table `tb_labo`
--
ALTER TABLE `tb_labo`
  ADD PRIMARY KEY (`labo_id`);

--
-- Indexes for table `tb_norm`
--
ALTER TABLE `tb_norm`
  ADD PRIMARY KEY (`norm_id`);

--
-- Indexes for table `tb_noti`
--
ALTER TABLE `tb_noti`
  ADD PRIMARY KEY (`noti_id`),
  ADD KEY `usua_id` (`usua_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_usua`
--
ALTER TABLE `tb_usua`
  ADD PRIMARY KEY (`usua_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_clie`
--
ALTER TABLE `tb_clie`
  MODIFY `clie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_equi`
--
ALTER TABLE `tb_equi`
  MODIFY `equi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_exij`
--
ALTER TABLE `tb_exij`
  MODIFY `exij_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_fabr`
--
ALTER TABLE `tb_fabr`
  MODIFY `fabr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_forn`
--
ALTER TABLE `tb_forn`
  MODIFY `forn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_labo`
--
ALTER TABLE `tb_labo`
  MODIFY `labo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_norm`
--
ALTER TABLE `tb_norm`
  MODIFY `norm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_noti`
--
ALTER TABLE `tb_noti`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_usua`
--
ALTER TABLE `tb_usua`
  MODIFY `usua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_equi`
--
ALTER TABLE `tb_equi`
  ADD CONSTRAINT `tb_equi_ibfk_1` FOREIGN KEY (`fabr_id`) REFERENCES `tb_fabr` (`fabr_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_equi_ibfk_2` FOREIGN KEY (`forn_id`) REFERENCES `tb_forn` (`forn_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_noti`
--
ALTER TABLE `tb_noti`
  ADD CONSTRAINT `tb_noti_ibfk_1` FOREIGN KEY (`usua_id`) REFERENCES `tb_usua` (`usua_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
