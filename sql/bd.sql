
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `aplicacoes_biotec` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `texto` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `apoiador` (
  `id` int NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `emprego` varchar(255) DEFAULT NULL,
  `imagem` varchar(500) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `caracteristicas` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `reino` varchar(50) DEFAULT NULL,
  `divisao` varchar(100) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `ordem` varchar(100) DEFAULT NULL,
  `familia` varchar(100) DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `especie` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `distribuicao_geografica` (
  `id` int NOT NULL,
  `regiao` varchar(100) DEFAULT NULL,
  `estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `documentos` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `link_pdf` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `imagens` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL,
  `descricao` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `planta` (
  `id` int NOT NULL,
  `nome_popular` varchar(100) DEFAULT NULL,
  `nome_cientifico` varchar(100) DEFAULT NULL,
  `descricao` text,
  `cuidados` text,
  `video_link` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `planta_estado` (
  `id_planta` int NOT NULL,
  `id_estado` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `aplicacoes_biotec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

ALTER TABLE `apoiador`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);


ALTER TABLE `distribuicao_geografica`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);


ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `planta_estado`
  ADD PRIMARY KEY (`id_planta`,`id_estado`),
  ADD KEY `id_planta` (`id_planta`),
  ADD KEY `id_estado` (`id_estado`);


ALTER TABLE `aplicacoes_biotec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `apoiador`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `caracteristicas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;


ALTER TABLE `distribuicao_geografica`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;


ALTER TABLE `documentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `imagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


ALTER TABLE `planta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;
