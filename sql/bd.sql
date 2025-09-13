-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12/09/2025 às 15:05
-- Versão do servidor: 8.0.30
-- Versão do PHP: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aplicacoes_biotec`
--

CREATE TABLE `aplicacoes_biotec` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `texto` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aplicacoes_biotec`
--

INSERT INTO `aplicacoes_biotec` (`id`, `planta_id`, `texto`) VALUES
(1, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.'),
(2, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `apoiador`
--

CREATE TABLE `apoiador` (
  `id` int NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `emprego` varchar(255) DEFAULT NULL,
  `imagem` varchar(500) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `apoiador`
--

INSERT INTO `apoiador` (`id`, `nome`, `email`, `cpf`, `emprego`, `imagem`, `senha`) VALUES
(1, 'pedro', 'emailpraetec2025@gmail.com', '12345678910', 'biologo', 'upload/ap_68c43607ca5be.jpg', '$2y$10$KcuX3169Roye3JFxj10gJ.F4.sEzzawFSPSJ9wT73cIM6bYGW1ZLO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `caracteristicas`
--

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

--
-- Despejando dados para a tabela `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `planta_id`, `reino`, `divisao`, `classe`, `ordem`, `familia`, `genero`, `especie`) VALUES
(1, 1, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Alismatales', 'Araceae', 'Monstera', 'M. deliciosa'),
(2, 2, 'Macaco', 'Verdenópolis', 'Frito', 'Nioba', 'Pedro', 'Nariz', 'B. de bola'),
(3, 9, 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste'),
(13, 19, '41414', '141', '441411', '4414', '14141', '4141', '414141'),
(14, 20, 'asdadsad', 'asdsad', 'asdasda', 'sdasd', 'asdasd', 'sadasd', 'adasd'),
(15, 21, 'dasdsad', 'sadsadas', 'dsada', 'sdasd', 'asdsada', 'sdasdas', 'asdasdasd'),
(16, 22, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Arecales', 'Arecaceae', 'Euterpe', 'E. oleracea'),
(17, 23, 'Plantae', 'Polypodiophyta', 'Polypodiopsida', 'Polypodiales', 'Polypodiaceae', 'Phlebodium', 'P. aureum'),
(18, 24, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Arecales', 'Arecaceae', 'Roystonea', 'R. oleracea'),
(19, 25, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Zingiberales', 'Musaceae', 'Musa', 'Musa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `distribuicao_geografica`
--

CREATE TABLE `distribuicao_geografica` (
  `id` int NOT NULL,
  `regiao` varchar(100) DEFAULT NULL,
  `estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `distribuicao_geografica`
--

INSERT INTO `distribuicao_geografica` (`id`, `regiao`, `estado`) VALUES
(24, NULL, 'Santa Catarina'),
(23, NULL, 'Roraima'),
(22, NULL, 'Rondônia'),
(21, NULL, 'Rio Grande do Sul'),
(20, NULL, 'Rio Grande do Norte'),
(19, NULL, 'Rio de Janeiro'),
(18, NULL, 'Piauí'),
(17, NULL, 'Pernambuco'),
(16, NULL, 'Paraná'),
(15, NULL, 'Paraíba'),
(14, NULL, 'Pará'),
(13, NULL, 'Minas Gerais'),
(12, NULL, 'Mato Grosso do Sul'),
(11, NULL, 'Mato Grosso'),
(10, NULL, 'Maranhão'),
(9, NULL, 'Goiás'),
(8, NULL, 'Espírito Santo'),
(7, NULL, 'Distrito Federal'),
(6, NULL, 'Ceará'),
(5, NULL, 'Bahia'),
(4, NULL, 'Amazonas'),
(3, NULL, 'Amapá'),
(2, NULL, 'Alagoas'),
(1, NULL, 'Acre'),
(25, NULL, 'São Paulo'),
(26, NULL, 'Sergipe'),
(27, NULL, 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `link_pdf` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id`, `planta_id`, `tipo`, `titulo`, `link_pdf`) VALUES
(1, 1, 'Artigo Científico', 'Estudo sobre Monstera deliciosa', 'documentos/artigo_monstera.pdf'),
(2, 1, 'Guia de Cultivo', 'Técnicas para cultivo ideal', 'documentos/guia_cultivo.pdf'),
(3, 1, 'Pesquisa Genética', 'Análise genômica da espécie', 'documentos/genetica_monstera.pdf'),
(4, 1, 'Artigo Científico', 'Estudo sobre Monstera deliciosa', 'documentos/artigo_monstera.pdf'),
(5, 1, 'Guia de Cultivo', 'Técnicas para cultivo ideal', 'documentos/guia_cultivo.pdf'),
(6, 1, 'Pesquisa Genética', 'Análise genômica da espécie', 'documentos/genetica_monstera.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL,
  `descricao` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `imagens`
--

INSERT INTO `imagens` (`id`, `planta_id`, `caminho_imagem`, `descricao`) VALUES
(5, 2, '../assets/img/ChatGPT Image 27 de jun. de 2025, 09_16_34.png', 'Imagem frontal da planta'),
(4, 1, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(6, 3, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(7, 4, '../assets/img/ChatGPT Image 27 de jun. de 2025, 09_16_34.png', 'Imagem frontal da planta'),
(8, 5, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(9, 6, '../assets/img/ChatGPT Image 27 de jun. de 2025, 09_16_34.png', 'Imagem frontal da planta'),
(10, 7, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(11, 8, '../assets/img/ChatGPT Image 27 de jun. de 2025, 09_16_34.png', 'Imagem frontal da planta'),
(12, 9, '../assets/img/68bad0a093e63_mapa-teste.png', 'Imagem de teste'),
(25, 22, '../assets/img/68bae3e99b57c_açaí.jpg', 'Imagem de Açaizeiro'),
(26, 23, '../assets/img/68bae75747f01_samambaia.jpg', 'Imagem de Samambaia'),
(17, 9, '../assets/img/açaí.jpg', 'Imagem de teste'),
(24, 21, '../assets/img/68badfd2d4e4e_mapa-teste.png', 'Imagem de sadads'),
(23, 20, '../assets/img/68badf6b81cef_mapa-teste.png', 'Imagem de asdsad'),
(22, 19, '../assets/img/68bade7de4773_mapa-teste.png', 'Imagem de teste 2'),
(27, 24, '../assets/img/68baefcec4a2e_Imperial_palm_trees.JPG', 'Imagem de Palmeira Imperial'),
(28, 25, '../assets/img/68baf21073e55_banana.jpg', 'Imagem de Bananeira'),
(29, 25, '../assets/img/68baf210745ea_Bananeira-1.jpg', 'Imagem de Bananeira');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta`
--

CREATE TABLE `planta` (
  `id` int NOT NULL,
  `nome_popular` varchar(100) DEFAULT NULL,
  `nome_cientifico` varchar(100) DEFAULT NULL,
  `descricao` text,
  `cuidados` text,
  `video_link` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `planta`
--

INSERT INTO `planta` (`id`, `nome_popular`, `nome_cientifico`, `descricao`, `cuidados`, `video_link`) VALUES
(1, 'Costela-de-Adão', 'Monstera deliciosa', 'A costela-de-adão é uma planta da família das aráceas. Possui folhas grandes, cordiformes, penatífidas perfuradas, com longos pecíolos, flores aromáticas, em espádice comestível, branco-creme, com espata verde, e bagas amarelo-claras.', 'Luz indireta, regas regulares sem encharcar o solo, umidade adequada e substrato bem drenado.', 'https://www.youtube.com/embed/gMGSl1fqQ84?si=xveGqLfD6zexLJ2e'),
(24, 'Palmeira Imperial', 'Roystonea oleracea', 'As palmeiras são plantas perenes, arborescentes, tipicamente com um caule cilíndrico não ramificado do tipo estipe, atingindo grandes alturas, mas por vezes se apresentando como acaules (caule subterrâneo). Não são consideradas árvores porque todas as árvores possuem o crescimento do diâmetro do seu caule para a formação do tronco (crescimento secundário), que produz a madeira e tal não acontece com as palmeiras.\r\n\r\nA seiva de algumas espécies de arecáceas é tradicionalmente fermentada para produzir o vinho de palma, muito apreciado e conhecido em Moçambique com o nome de \"sura\" (onde, para além de ser bebido, é também utilizado como fermento na fabricação de pães e bolos). Em Angola, o vinho de palmeira é conhecido como \"marufo\". O buriti (Mauritia flexuosa) também é fermentado (entre outras formas de consumo), dando origem ao vinho de buriti, e o açaí (Euterpe oleracea) dá o vinho de açaí. No Brasil, a palmeira-imperial (Roystonea oleracea) plantada em 1809 por D. João VI, tornou-se o \"símbolo do império\" em meados do século XIX.', 'Para cuidar de uma palmeira-imperial (Roystonea oleracea), que necessita de sol pleno, solo fértil e bem drenado e rega regular, faça adubações periódicas com fertilizantes próprios ou orgânicos e pode apenas as folhas secas para não prejudicar a planta. Embora seja tolerante à seca quando adulta, a palmeira-imperial precisa de água suficiente durante os primeiros meses de crescimento para se estabelecer e crescer forte. ', 'https://www.youtube.com/embed/6oGZOoJVt4M?si=6A2qeoA1R2gTFdLx'),
(23, 'Samambaia', 'Tracheophyta', 'As samambaias, ou fetos, são vegetais vasculares membros do táxon das pteridófitas (que deixou de ter validade taxonômica e só é utilizado como uma denominação informal). Elas possuem tecidos vasculares (xilema e floema), folhas verdadeiras, se reproduzem através de esporos e não produzem sementes ou flores.', 'Para cuidar bem de uma samambaia, forneça luz indireta abundante, mantenha o solo constantemente úmido, mas nunca encharcado, borrifando água nas folhas para aumentar a umidade do ar. Realize adubações regulares com fertilizantes orgânicos, como húmus de minhoca, e faça a poda de folhas secas ou danificadas. ', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq'),
(22, 'Açaizeiro', 'Euterpe oleracea', 'O açaí é uma palmeira muito comum na região da Amazônia que produz um fruto bacáceo de cor roxa (a parede do órgão ovário amadurece e forma a camada externa comestível), muito utilizado na confecção de alimentos e bebidas. A palmeira do açaí é por vezes confundida, no estado do Pará, com a palmeira juçara, que embora seja outro tipo de palmeira, dá palmito de excelente qualidade.', 'Para cuidar de um açaizeiro, mantenha o solo constantemente úmido, mas sem encharcar, e adube-o com matéria orgânica para garantir os nutrientes necessários. Realize podas regulares para remover folhas velhas ou doentes, ajudando a palmeira a crescer saudável. Monitore a planta em busca de pragas e doenças, adotando medidas de controle quando necessário. É importante também que o local tenha sol pleno e alta umidade.', 'https://www.youtube.com/embed/zylP9UUg5QQ?si=U5k9QdCRGuDfsKdj'),
(25, 'Bananeira', 'Musa', 'As bananeiras, figueiras-de-adão, pacobeiras ou pacoveiras são plantas do gênero Musa, um dos três que compõem a família Musaceae, que inclui as plantas herbáceas vivazes, incluindo as bananeiras cultivadas para a produção de fibras (abacás) e para a produção de bananas.', 'Assim como qualquer planta, frutífera ou não, o sucesso depende de como você faz o cultivo. A bananeira adora ambientes úmidos, mas sem excessos. O ideal é uma taxa de 50% de umidade para que ela se mantenha saudável.\r\n\r\nIsso é essencial para ela crescer bem. Por essa razão, quando é cultivada em ambientes com temperaturas mais amenas, a bananeira deve ser colocada em um local onde possa receber luz solar para crescer e dar frutos.\r\n\r\nAlém disso, analisar as folhas da planta faz parte de como cuidar de bananeira em vaso ou em jardim. Se a tonalidade for amarelada, é sinal de que faltam nutrientes. Então, é hora de caprichar na adubação com nitrogênio na etapa do desenvolvimento e em um fertilizante 15:5:30 regularmente na fase adulta. Para a manutenção, confira outros detalhes!\r\n\r\nElimine infestantes para aumentar o vigor da bananeira e evitar pragas;\r\nRegue a planta com frequência, evitando que o solo fique com aparência seca;\r\nRemova folhas velhas para evitar atrito e danos no cacho de bananas;\r\nUse restos da planta para adubar o solo em volta, mas não diretamente abaixo do tronco.\r\nO último ponto de atenção ocorre em uma fase já mais avançada, na época dos frutos. Após cortar o cacho, é preciso podar o tronco da bananeira à meia-altura. Isso faz com que a planta-filha retire nutrientes do restante do tronco da planta-mãe. Só depois, é possível removê-la totalmente.', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta_estado`
--

CREATE TABLE `planta_estado` (
  `id_planta` int NOT NULL,
  `id_estado` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `planta_estado`
--

INSERT INTO `planta_estado` (`id_planta`, `id_estado`) VALUES
(1, 11),
(1, 16),
(1, 19),
(1, 21),
(1, 24),
(1, 25),
(2, 5),
(2, 7),
(2, 8),
(2, 13),
(2, 17),
(2, 20),
(9, 11),
(9, 14),
(9, 22),
(9, 25),
(19, 11),
(19, 12),
(20, 4),
(20, 11),
(21, 4),
(21, 11),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(22, 5),
(22, 8),
(22, 10),
(22, 11),
(22, 14),
(22, 17),
(22, 20),
(22, 22),
(22, 23),
(23, 1),
(23, 2),
(23, 3),
(23, 4),
(23, 5),
(23, 6),
(23, 7),
(23, 8),
(23, 9),
(23, 12),
(23, 13),
(23, 14),
(23, 15),
(23, 16),
(23, 17),
(23, 19),
(23, 20),
(23, 21),
(23, 23),
(23, 24),
(23, 25),
(24, 8),
(24, 13),
(24, 16),
(24, 19),
(24, 21),
(24, 24),
(24, 25),
(25, 1),
(25, 2),
(25, 3),
(25, 4),
(25, 5),
(25, 6),
(25, 7),
(25, 8),
(25, 9),
(25, 10),
(25, 11),
(25, 12),
(25, 13),
(25, 14),
(25, 15),
(25, 16),
(25, 17),
(25, 18),
(25, 19),
(25, 20),
(25, 21),
(25, 22),
(25, 23),
(25, 24),
(25, 25),
(25, 26),
(25, 27);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aplicacoes_biotec`
--
ALTER TABLE `aplicacoes_biotec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Índices de tabela `apoiador`
--
ALTER TABLE `apoiador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Índices de tabela `distribuicao_geografica`
--
ALTER TABLE `distribuicao_geografica`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Índices de tabela `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `planta_estado`
--
ALTER TABLE `planta_estado`
  ADD PRIMARY KEY (`id_planta`,`id_estado`),
  ADD KEY `id_planta` (`id_planta`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aplicacoes_biotec`
--
ALTER TABLE `aplicacoes_biotec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `apoiador`
--
ALTER TABLE `apoiador`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `distribuicao_geografica`
--
ALTER TABLE `distribuicao_geografica`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `planta`
--
ALTER TABLE `planta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
