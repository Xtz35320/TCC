-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20251111.102c4d8cbc
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2025 at 11:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplicacoes_biotec`
--

CREATE TABLE `aplicacoes_biotec` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `texto` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aplicacoes_biotec`
--

INSERT INTO `aplicacoes_biotec` (`id`, `planta_id`, `texto`) VALUES
(1, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.'),
(2, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.'),
(3, 26, 'O Ipê-Amarelo é estudado por suas propriedades medicinais, com compostos antioxidantes e anti-inflamatórios extraídos da casca.'),
(4, 27, 'A Vitória-Régia tem potencial em biotecnologia para extração de compostos naturais utilizados em cosméticos e produtos farmacêuticos.'),
(5, 28, 'O Mandacaru é estudado para produção de biopolímeros e biofertilizantes em regiões áridas.'),
(6, 29, 'A Araucária fornece resinas e compostos voláteis com propriedades antimicrobianas de interesse biotecnológico.'),
(7, 30, 'O Jatobá é fonte de compostos bioativos com uso potencial na indústria farmacêutica e alimentícia.');

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int UNSIGNED NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `planta_id` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caracteristicas`
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
-- Dumping data for table `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `planta_id`, `reino`, `divisao`, `classe`, `ordem`, `familia`, `genero`, `especie`) VALUES
(1, 1, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Alismatales', 'Araceae', 'Monstera', 'M. deliciosa'),
(16, 22, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Arecales', 'Arecaceae', 'Euterpe', 'E. oleracea'),
(17, 23, 'Plantae', 'Polypodiophyta', 'Polypodiopsida', 'Polypodiales', 'Polypodiaceae', 'Phlebodium', 'P. aureum'),
(18, 24, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Arecales', 'Arecaceae', 'Roystonea', 'R. oleracea'),
(19, 25, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Zingiberales', 'Musaceae', 'Musa', 'Musa'),
(20, 26, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Bignoniaceae', 'Handroanthus', 'H. albus'),
(21, 27, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Nymphaeales', 'Nymphaeaceae', 'Victoria', 'V. amazonica'),
(22, 28, 'Plantae', 'Magnoliophyta', 'Caryophyllales', 'Cactales', 'Cactaceae', 'Cereus', 'C. jamacaru'),
(23, 29, 'Plantae', 'Pinophyta', 'Pinopsida', 'Pinales', 'Araucariaceae', 'Araucaria', 'A. angustifolia'),
(24, 30, 'Plantae', 'Magnoliophyta', 'Fabales', 'Fabaceae', 'Hymenaea', 'H. courbaril', 'H. courbaril'),
(25, 31, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Asparagales', 'Asparagaceae', 'Sansevieria', 'S. trifasciata'),
(27, 33, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Asparagales', 'Orchidaceae', 'Phalaenopsis', 'Phalaenopsis sp'),
(28, 34, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Poales', 'Poaceae', 'Bambusa', 'B. vulgaris'),
(29, 35, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Alismatales', 'Araceae', 'Zantedeschia', 'Z. aethiopica'),
(30, 36, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Asterales', 'Asteraceae', 'Helianthus', 'H. annuus'),
(31, 37, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Lamiaceae', 'Lavandula', 'L. angustifolia'),
(32, 38, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Lamiaceae', 'Mentha', 'M. spicata'),
(33, 39, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Rosales', 'Rosaceae', 'Rosa', 'Rosa spp'),
(34, 40, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Solanales', 'Solanaceae', 'Solanum', 'S. lycopersicum'),
(35, 41, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Lamiaceae', 'Ocimum', 'O. basilicum'),
(36, 42, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Caryophyllales', 'Cactaceae', 'Vários', 'Cactaceae'),
(37, 43, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Asterales', 'Asteraceae', 'Lactuca', 'L. sativa'),
(38, 44, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Asterales', 'Asteraceae', 'Chrysanthemum', 'C. morifolium'),
(39, 45, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Solanales', 'Solanaceae', 'Capsicum', 'C. annuum'),
(40, 46, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Lamiaceae', 'Salvia', 'S. officinalis'),
(41, 47, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Lamiaceae', 'Rosmarinus', 'R. officinalis'),
(42, 48, 'Plantae', 'Magnoliophyta', 'Liliopsida', 'Asparagales', 'Amaryllidaceae', 'Allium', 'A. fistulosum'),
(43, 49, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Lamiales', 'Gesneriaceae', 'Saintpaulia', 'S. ionantha'),
(44, 50, 'Plantae', 'Magnoliophyta', 'Magnoliopsida', 'Apiales', 'Apiaceae', 'Coriandrum', 'C. sativum');

-- --------------------------------------------------------

--
-- Table structure for table `distribuicao_geografica`
--

CREATE TABLE `distribuicao_geografica` (
  `id` int NOT NULL,
  `regiao` varchar(100) DEFAULT NULL,
  `estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `distribuicao_geografica`
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
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `link_pdf` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id`, `planta_id`, `tipo`, `titulo`, `link_pdf`) VALUES
(1, 1, 'Artigo Científico', 'Estudo sobre Monstera deliciosa', '../assets/documentos/aaaa.pdf'),
(2, 1, 'Guia de Cultivo', 'Técnicas para cultivo ideal', '../assets/documentos/Fluxograma1.pdf'),
(3, 1, 'Pesquisa Genética', 'Análise genômica da espécie', '../assets/documentos/teste.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `imagens`
--

CREATE TABLE `imagens` (
  `id` int NOT NULL,
  `planta_id` int DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL,
  `descricao` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `imagens`
--

INSERT INTO `imagens` (`id`, `planta_id`, `caminho_imagem`, `descricao`) VALUES
(4, 1, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(25, 22, '../assets/img/68bae3e99b57c_açaí.jpg', 'Imagem de Açaizeiro'),
(26, 23, '../assets/img/68bae75747f01_samambaia.jpg', 'Imagem de Samambaia'),
(27, 24, '../assets/img/68baefcec4a2e_Imperial_palm_trees.JPG', 'Imagem de Palmeira Imperial'),
(28, 25, '../assets/img/68baf21073e55_banana.jpg', 'Imagem de Bananeira'),
(29, 25, '../assets/img/68baf210745ea_Bananeira-1.jpg', 'Imagem de Bananeira'),
(30, 26, '../assets/img/Handroanthus_serratifolius.jpg', 'Imagem de ipe'),
(31, 26, '../assets/img/ipe_amarelo.jpg', 'Imagem de ipe'),
(32, 27, '../assets/img/vitoria-regia-1140515.jpg', 'Imagem de vitoria regia'),
(33, 27, '../assets/img/Vitregias02.jpg', 'Imagem de vitoria regia'),
(34, 28, '../assets/img/Mandacaru_arvore.webp', NULL),
(35, 28, '../assets/img/Cereus_jamacaru.jpg', NULL),
(36, 29, '../assets/img/araucaria.jpg', 'Imagem de araucaria'),
(37, 29, '../assets/img/Araucaria2.jpg', 'Imagem de araucaria'),
(38, 30, '../assets/img/jatoba.jpg', 'Imagem de jatoba'),
(39, 30, '../assets/img/Jatobá-1-768x1024.jpg', 'Imagem de jatoba'),
(40, 31, '../assets/img/espada-de-sao-jorge.webp', NULL),
(41, 31, '../assets/img/espada-de-sao-jorge.webp', NULL),
(42, 32, '../assets/img/suculenta.webp', NULL),
(43, 32, '../assets/img/suculenta2.webp', NULL),
(44, 33, '../assets/img/orquidea.jpg', NULL),
(45, 33, '../assets/img/orquidea2.webp', NULL),
(46, 34, '../assets/img/bambu.jpg', NULL),
(47, 34, '../assets/img/bambu2.jpeg', NULL),
(48, 35, '../assets/img/copo de leite.webp', NULL),
(49, 35, '../assets/img/copo-de-leite2.jpeg', NULL),
(50, 36, '../assets/img/girassol.jpeg', NULL),
(51, 36, '../assets/img/girassol2.jpeg', NULL),
(52, 37, '../assets/img/lavanda.jpeg', NULL),
(53, 37, '../assets/img/lavanda2.webp', NULL),
(54, 38, '../assets/img/hortela.jpeg', NULL),
(55, 38, '../assets/img/hortela.jpg', NULL),
(56, 39, '../assets/img/rosa.jpeg', NULL),
(57, 39, '../assets/img/rosa2.jpeg', NULL),
(58, 40, '../assets/img/tomate.jpeg', NULL),
(59, 40, '../assets/img/tomate2.jpeg', NULL),
(60, 41, '../assets/img/manjericao.jpg', NULL),
(61, 41, '../assets/img/manjericao2.webp', NULL),
(62, 43, '../assets/img/alface.jpeg', NULL),
(63, 43, '../assets/img/alface2.jpg', NULL),
(64, 44, '../assets/img/crisantemo.jpeg', NULL),
(65, 44, '../assets/img/crisantemo2.jpeg', NULL),
(66, 45, '../assets/img/pimenta_1.webp', NULL),
(67, 45, '../assets/img/pimenta2.webp', NULL),
(68, 46, '../assets/img/salvia.jpeg', NULL),
(69, 46, '../assets/img/salvia2.jpeg', NULL),
(72, 47, '../assets/img/alecrim.jpeg', NULL),
(73, 47, '../assets/img/alecrim2.webp', NULL),
(74, 48, '../assets/img/cebolinha.webp', NULL),
(75, 48, '../assets/img/cebolinha2.jpg', NULL),
(76, 49, '../assets/img/violeta.jpeg', NULL),
(77, 49, '../assets/img/violeta2.jpeg', NULL),
(78, 50, '../assets/img/coentro.webp', NULL),
(79, 50, '../assets/img/coentro2.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planta`
--

CREATE TABLE `planta` (
  `id` int NOT NULL,
  `nome_popular` varchar(100) DEFAULT NULL,
  `nome_cientifico` varchar(100) DEFAULT NULL,
  `descricao` text,
  `cuidados` text,
  `video_link` varchar(255) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `planta`
--

INSERT INTO `planta` (`id`, `nome_popular`, `nome_cientifico`, `descricao`, `cuidados`, `video_link`, `usuario_id`) VALUES
(1, 'Costela-de-Adão', 'Monstera deliciosa', 'A costela-de-adão é uma planta da família das aráceas. Possui folhas grandes, cordiformes, penatífidas perfuradas, com longos pecíolos, flores aromáticas, em espádice comestível, branco-creme, com espata verde, e bagas amarelo-claras.', 'Luz indireta, regas regulares sem encharcar o solo, umidade adequada e substrato bem drenado.', 'https://www.youtube.com/embed/gMGSl1fqQ84?si=xveGqLfD6zexLJ2e', NULL),
(24, 'Palmeira Imperial', 'Roystonea oleracea', 'As palmeiras são plantas perenes, arborescentes, tipicamente com um caule cilíndrico não ramificado do tipo estipe, atingindo grandes alturas, mas por vezes se apresentando como acaules (caule subterrâneo). Não são consideradas árvores porque todas as árvores possuem o crescimento do diâmetro do seu caule para a formação do tronco (crescimento secundário), que produz a madeira e tal não acontece com as palmeiras.\r\n\r\nA seiva de algumas espécies de arecáceas é tradicionalmente fermentada para produzir o vinho de palma, muito apreciado e conhecido em Moçambique com o nome de \"sura\" (onde, para além de ser bebido, é também utilizado como fermento na fabricação de pães e bolos). Em Angola, o vinho de palmeira é conhecido como \"marufo\". O buriti (Mauritia flexuosa) também é fermentado (entre outras formas de consumo), dando origem ao vinho de buriti, e o açaí (Euterpe oleracea) dá o vinho de açaí. No Brasil, a palmeira-imperial (Roystonea oleracea) plantada em 1809 por D. João VI, tornou-se o \"símbolo do império\" em meados do século XIX.', 'Para cuidar de uma palmeira-imperial (Roystonea oleracea), que necessita de sol pleno, solo fértil e bem drenado e rega regular, faça adubações periódicas com fertilizantes próprios ou orgânicos e pode apenas as folhas secas para não prejudicar a planta. Embora seja tolerante à seca quando adulta, a palmeira-imperial precisa de água suficiente durante os primeiros meses de crescimento para se estabelecer e crescer forte. ', 'https://www.youtube.com/embed/6oGZOoJVt4M?si=6A2qeoA1R2gTFdLx', NULL),
(23, 'Samambaia', 'Tracheophyta', 'As samambaias, ou fetos, são vegetais vasculares membros do táxon das pteridófitas (que deixou de ter validade taxonômica e só é utilizado como uma denominação informal). Elas possuem tecidos vasculares (xilema e floema), folhas verdadeiras, se reproduzem através de esporos e não produzem sementes ou flores.', 'Para cuidar bem de uma samambaia, forneça luz indireta abundante, mantenha o solo constantemente úmido, mas nunca encharcado, borrifando água nas folhas para aumentar a umidade do ar. Realize adubações regulares com fertilizantes orgânicos, como húmus de minhoca, e faça a poda de folhas secas ou danificadas. ', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq', NULL),
(22, 'Açaizeiro', 'Euterpe oleracea', 'O açaí é uma palmeira muito comum na região da Amazônia que produz um fruto bacáceo de cor roxa (a parede do órgão ovário amadurece e forma a camada externa comestível), muito utilizado na confecção de alimentos e bebidas. A palmeira do açaí é por vezes confundida, no estado do Pará, com a palmeira juçara, que embora seja outro tipo de palmeira, dá palmito de excelente qualidade.', 'Para cuidar de um açaizeiro, mantenha o solo constantemente úmido, mas sem encharcar, e adube-o com matéria orgânica para garantir os nutrientes necessários. Realize podas regulares para remover folhas velhas ou doentes, ajudando a palmeira a crescer saudável. Monitore a planta em busca de pragas e doenças, adotando medidas de controle quando necessário. É importante também que o local tenha sol pleno e alta umidade.', 'https://www.youtube.com/embed/zylP9UUg5QQ?si=U5k9QdCRGuDfsKdj', NULL),
(25, 'Bananeira', 'Musa', 'As bananeiras, figueiras-de-adão, pacobeiras ou pacoveiras são plantas do gênero Musa, um dos três que compõem a família Musaceae, que inclui as plantas herbáceas vivazes, incluindo as bananeiras cultivadas para a produção de fibras (abacás) e para a produção de bananas.', 'Assim como qualquer planta, frutífera ou não, o sucesso depende de como você faz o cultivo. A bananeira adora ambientes úmidos, mas sem excessos. O ideal é uma taxa de 50% de umidade para que ela se mantenha saudável.\r\n\r\nIsso é essencial para ela crescer bem. Por essa razão, quando é cultivada em ambientes com temperaturas mais amenas, a bananeira deve ser colocada em um local onde possa receber luz solar para crescer e dar frutos.\r\n\r\nAlém disso, analisar as folhas da planta faz parte de como cuidar de bananeira em vaso ou em jardim. Se a tonalidade for amarelada, é sinal de que faltam nutrientes. Então, é hora de caprichar na adubação com nitrogênio na etapa do desenvolvimento e em um fertilizante 15:5:30 regularmente na fase adulta. Para a manutenção, confira outros detalhes!\r\n\r\nElimine infestantes para aumentar o vigor da bananeira e evitar pragas;\r\nRegue a planta com frequência, evitando que o solo fique com aparência seca;\r\nRemova folhas velhas para evitar atrito e danos no cacho de bananas;\r\nUse restos da planta para adubar o solo em volta, mas não diretamente abaixo do tronco.\r\nO último ponto de atenção ocorre em uma fase já mais avançada, na época dos frutos. Após cortar o cacho, é preciso podar o tronco da bananeira à meia-altura. Isso faz com que a planta-filha retire nutrientes do restante do tronco da planta-mãe. Só depois, é possível removê-la totalmente.', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq', NULL),
(26, 'Ipê-Amarelo', 'Handroanthus albus', 'Árvore nativa do Brasil, muito conhecida por suas flores amarelas intensas e beleza ornamental. É símbolo da resistência e da força da natureza.', 'Prefere sol pleno e solos bem drenados. Regar moderadamente e podar após a floração.', 'https://www.youtube.com/embed/aM-SZPxcjJE?si=NnoZ2SHX9fIWivj7', NULL),
(27, 'Vitória-Régia', 'Victoria amazonica', 'Planta aquática de grande porte, típica da região amazônica, famosa por suas folhas gigantes e flores que abrem à noite.', 'Necessita de lagoas com água quente e tranquila, rica em nutrientes. Não tolera frio intenso.', 'https://www.youtube.com/embed/5KIcFR2RPJc?si=kXpuXv2hsDc1iGCX', NULL),
(28, 'Cacto-Mandacaru', 'Cereus jamacaru', 'Cacto típico do semiárido brasileiro, resistente à seca, com flores brancas grandes que florescem à noite.', 'Evitar excesso de água e manter em local ensolarado. Pode ser cultivado em solos arenosos e secos.', 'https://www.youtube.com/embed/QKLcgZvKtes?si=hl1ZkypTKX0hqwxv', NULL),
(29, 'Araucária', 'Araucaria angustifolia', 'Árvore símbolo do sul do Brasil, também conhecida como pinheiro-do-paraná. Produz sementes comestíveis chamadas pinhões.', 'Prefere climas frios e solos ácidos. Requer espaçamento amplo para se desenvolver adequadamente.', 'https://www.youtube.com/embed/V5NN7rOf40M?si=UWhJrFfJS-DUGeaX', NULL),
(30, 'Jatobá', 'Hymenaea courbaril', 'Árvore de grande porte da Mata Atlântica e Amazônia. Possui madeira resistente e frutos utilizados na alimentação e medicina tradicional.', 'Necessita de solo fértil e boa luminosidade. Suporta períodos secos, mas cresce melhor em clima úmido.', 'https://www.youtube.com/embed/YdggLryynO4?si=Fgtpe_maDyjyT8hl', NULL),
(31, 'Espada-de-São-Jorge', 'Sansevieria trifasciata', 'Planta herbácea de folhas longas, eretas e rígidas, com padrões variegados em tons de verde. Muito utilizada como ornamental em ambientes internos e externos, é conhecida por sua extrema resistência e baixa manutenção. A Espada-de-São-Jorge é nativa da África Ocidental e possui a capacidade de purificar o ar, removendo toxinas como formaldeído e benzeno.', 'Para um cultivo saudável da Espada-de-São-Jorge, recomenda-se posicioná-la em locais com luz indireta brilhante ou meia-sombra, embora tolere condições de pouca luz. As regas devem ser bastante espaçadas - aguarde sempre que o solo esteja completamente seco entre uma rega e outra, normalmente a cada 2-3 semanas. Utilize solo bem drenado, preferencialmente uma mistura para cactos e suculentas. A planta é sensível ao excesso de água, que pode causar apodrecimento das raízes. Durante o inverno, reduza ainda mais as regas. A adubação pode ser feita a cada 2-3 meses com fertilizante balanceado diluído.', 'https://www.youtube.com/embed/L9acdeOZNxU?si=4gVQCEu22cpRemW0', NULL),
(32, 'Suculenta', 'Crassula ovata', 'Conhecida popularmente como Planta-Jade ou Árvore-da-Amizade, esta suculenta apresenta folhas carnudas, ovais e de coloração verde-jade, podendo desenvolver tons avermelhados nas bordas quando exposta ao sol intenso. É uma planta de crescimento lento que pode atingir até 1 metro de altura quando cultivada em condições ideais, desenvolvendo um caule lenhoso que lhe confere aspecto arbustivo.', 'As suculentas necessitam de sol pleno por pelo menos 4-6 horas diárias para um desenvolvimento adequado. O solo deve ser extremamente bem drenado - recomenda-se uma mistura específica para cactos e suculentas, com areia grossa e perlita. As regas devem ser moderadas: espere o solo secar completamente antes de regar novamente. No verão, regue a cada 7-10 dias; no inverno, reduza para a cada 3-4 semanas. Evite molhar as folhas para prevenir doenças fúngicas. Faça adubação mensal durante a primavera e verão com fertilizante específico para suculentas.', 'https://www.youtube.com/embed/un0-40ZiPTc?si=7bMazcV0ARF9jVLV', NULL),
(33, 'Orquídea', 'Phalaenopsis sp', 'Conhecida como Orquídea-Borboleta, esta espécie epífita é caracterizada por suas flores elegantes que se assemelham a borboletas em voo. As flores apresentam-se em diversas cores - branco, rosa, amarelo e roxo - e podem durar até três meses. Suas raízes aéreas são grossas e esverdeadas, participando ativamente da fotossíntese da planta.', 'As orquídeas Phalaenopsis preferem luz indireta brilhante, sem exposição direta ao sol que pode queimar suas folhas. Mantenha em local bem ventilado com temperatura entre 18-28°C. A rega deve ser feita quando as raízes estiverem prateadas - normalmente 1-2 vezes por semana no verão e a cada 10-15 dias no inverno. Utilize substrato específico para orquídeas (casca de pinus, musgo sphagnum). A umidade ideal é de 50-70%. Adube quinzenalmente com fertilizante específico para orquídeas, reduzindo no inverno. Após a floração, corte a haste acima do segundo nó para estimular nova floração.', 'https://www.youtube.com/embed/WMwjaMzINjk?si=YRtmSO5idGap49Gg', NULL),
(34, 'Bambu', 'Bambusa vulgaris', 'Planta da família Poaceae, o bambu é conhecido por seu crescimento extremamente rápido - algumas espécies podem crescer até 1 metro por dia. Apresenta colmos ocos e segmentados, com folhas lanceoladas de coloração verde-brilhante. É amplamente utilizado na fabricação de móveis, construções, artesanato e como planta ornamental em jardins.', 'O bambu necessita de sol pleno para um desenvolvimento vigoroso, embora tolere meia-sombra. Prefere solos úmidos, férteis e bem drenados, com pH entre 6.0 e 6.5. As regas devem ser frequentes, mantendo o solo sempre úmido mas não encharcado. Em períodos de estiagem, regue diariamente. A adubação deve ser rica em nitrogênio - utilize esterco curtido ou fertilizante NPK 20-10-10 mensalmente durante a estação de crescimento. Controle a expansão instalando barreiras físicas no solo, pois o bambu pode se tornar invasivo.', 'https://www.youtube.com/embed/PvvDNzSpR1w?si=AXbCjhd8wTsK8F9s', NULL),
(35, 'Copo-de-Leite', 'Zantedeschia aethiopica', 'Planta herbácea perene conhecida por suas elegantes inflorescências brancas em forma de cálice (espata) que envolvem uma espiga amarela (espádice). As folhas são grandes, sagitadas e de coloração verde-brilhante. Muito utilizada em arranjos florais e jardins aquáticos, simbolizando pureza e elegância.', 'O Copo-de-Leite prospera em meia-sombra, podendo tolerar sol pleno em regiões mais frias. Prefere solos constantemente úmidos, ricos em matéria orgânica e com boa drenagem. Em regiões quentes, mantenha o solo sempre úmido - regue a cada 2-3 dias no verão. A planta aprecia alta umidade ambiental. Adube a cada 2 meses com fertilizante orgânico ou NPK 10-10-10. No inverno, reduza as regas e proteja de geadas. Pode ser cultivada em margens de lagos ou em vasos com bom sistema de drenagem.', 'https://www.youtube.com/embed/-If48SVnr-4?si=00FQVPN8yWygOuGO', NULL),
(36, 'Girassol', 'Helianthus annuus', 'Planta anual de grande porte, conhecida por suas grandes inflorescências amarelas que seguem a trajetória do sol (heliotropismo). Os girassóis podem atingir até 3 metros de altura, com caules robustos e folhas grandes e ásperas. Suas sementes são amplamente utilizadas na alimentação humana e animal, além da produção de óleo vegetal.', 'Os girassóis necessitam de sol pleno por pelo menos 6-8 horas diárias para um desenvolvimento adequado. O solo deve ser fértil, bem drenado e rico em matéria orgânica. As regas devem ser regulares, mantendo o solo úmido mas não encharcado - regue a cada 2-3 dias, aumentando a frequência em períodos de calor intenso. Adube a cada 3 semanas com fertilizante rico em fósforo para estimular a floração. Estaqueie plantas altas para evitar quebra pelo vento. Colha as sementes quando a parte de trás do capítulo ficar amarela-marrom.', 'https://www.youtube.com/embed/dTk1DuOHAZQ?si=lpXHOB1_CQu7j9Xj', NULL),
(37, 'Lavanda', 'Lavandula angustifolia', 'Arbusto perene da família Lamiaceae, conhecido por suas flores aromáticas em tons de lilás-azulado e folhas cinza-esverdeadas. A lavanda é amplamente cultivada para extração de óleo essencial utilizado na perfumaria, aromaterapia e produtos de higiene. Suas flores secas são usadas em sachês e pot-pourris.', 'A lavanda necessita de sol pleno (pelo menos 6 horas diárias) e solo alcalino, bem drenado e arenoso. Regue moderadamente, permitindo que o solo seque entre as regas - excesso de umidade causa apodrecimento das raízes. Podas anuais após a floração mantêm a planta compacta e estimulam novo crescimento. Adube com composto orgânico na primavera, evitando excesso de nitrogênio que reduz a produção de óleo essencial. Em regiões chuvosas, cultive em canteiros elevados para melhor drenagem.', 'https://www.youtube.com/embed/C6-nM8pjezk?si=4Bs-xJXAg28Kkb9H', NULL),
(38, 'Hortelã', 'Mentha spicata', 'Planta herbácea aromática da família Lamiaceae, com folhas verdes brilhantes e serrilhadas. Conhecida por seu aroma refrescante e sabor característico, é amplamente utilizada na culinária, chás e produtos de higiene bucal. Cresce rapidamente formando touceiras densas através de rizomas subterrâneos.', 'A hortelã prefere meia-sombra a sol pleno, especialmente em regiões muito quentes. O solo deve ser mantido constantemente úmido, rico em matéria orgânica e com boa drenagem. Regue diariamente em climas quentes, mantendo o solo sempre úmido mas não encharcado. Adube a cada 2 meses com composto orgânico ou fertilizante balanceado. Por ser invasiva, recomenda-se cultivo em vasos ou com barreiras físicas no solo. Colha as folhas regularmente para estimular novo crescimento.', 'https://www.youtube.com/embed/o3izScVc2Pg?si=LeO5sAzZi8bNq_Wp', NULL),
(39, 'Rosa', 'Rosa spp', 'Arbusto lenhoso da família Rosaceae, cultivado há milênios por suas flores perfumadas e elegantes. Existem milhares de variedades com diferentes cores, formas e tamanhos. As rosas são símbolo de amor e beleza, utilizadas em jardins ornamentais, floricultura e produção de essências para perfumaria.', 'As rosas necessitam de sol pleno (mínimo 6 horas diárias) e solo fértil, rico em matéria orgânica e com pH entre 6.0-6.5. Regue profundamente 2-3 vezes por semana, evitando molhar as folhas para prevenir doenças fúngicas. Adube mensalmente com fertilizante específico para rosas (rico em fósforo). Faça podas anuais no inverno para remover galhos mortos e estimular nova floração. Controle pragas como pulgões e ácaros com inseticidas naturais quando necessário.', 'https://www.youtube.com/embed/-y4MP1rQs6U?si=qbipOO2Zyb_WeJSa', NULL),
(40, 'Tomate', 'Solanum lycopersicum', 'Planta herbácea da família Solanaceae, cultivada mundialmente por seus frutos saborosos e nutritivos. Os tomateiros podem ser determinados (crescimento limitado) ou indeterminados (crescimento contínuo), com frutos que variam em tamanho, forma e cor - vermelho, amarelo, laranja ou roxo.', 'Os tomateiros necessitam de sol pleno (8-10 horas diárias) e solo fértil, bem drenado e rico em matéria orgânica. Mantenha o solo uniformemente úmido, regando na base da planta para evitar molhar as folhas. Adube a cada 3-4 semanas com fertilizante rico em fósforo e potássio. Estaqueie ou utilize gaiolas para suporte das plantas. Realize podas de ladrões em variedades indeterminadas. Colha os frutos quando estiverem completamente coloridos e firmes.', 'https://www.youtube.com/embed/oCal3khm3Pc?si=SIXYIL2kOeYav7yx', NULL),
(41, 'Manjericão', 'Ocimum basilicum', 'Erva aromática anual da família Lamiaceae, com folhas verdes brilhantes e aroma característico. Amplamente utilizada na culinária mediterrânea e asiática, especialmente no molho pesto. Existem diversas variedades com sabores e aromas distintos, incluindo manjericão-doce, manjericão-roxo e manjericão-tailandês.', 'O manjericão necessita de sol pleno (6-8 horas diárias) e solo fértil, bem drenado e rico em matéria orgânica. Mantenha o solo consistentemente úmido, regando sempre que a superfície estiver seca. Adube a cada 4-6 semanas com composto orgânico. Pince as pontas regularmente para evitar floração precoce e estimular crescimento arbustivo. Colha as folhas pela manhã, quando o aroma está mais intenso. Proteja de ventos fortes e geadas.', 'https://www.youtube.com/embed/QDIcFNr-9Eg?si=RrTqQooBWOhgj-0t', NULL),
(43, 'Alface', 'Lactuca sativa', 'Hortaliça folhosa anual da família Asteraceae, cultivada mundialmente para consumo in natura em saladas. Existem diversas variedades com diferentes texturas, cores e formas - crespa, lisa, americana, roxa. De crescimento rápido, é rica em vitaminas A, C e K, além de fibras e minerais.', 'A alface prefere clima ameno e pode ser cultivada em sol pleno ou meia-sombra em regiões quentes. O solo deve ser fértil, rico em matéria orgânica e mantido constantemente úmido. Regue regularmente, preferencialmente pela manhã, evitando molhar as folhas para prevenir doenças. Adube com composto orgânico antes do plantio. Colha as folhas externas conforme necessidade ou a planta inteira quando estiver bem formada. Em regiões quentes, prefira variedades tolerantes ao calor.', 'https://www.youtube.com/embed/iODR0oRzizg?si=yXTVs0O7tX5cbv1h', NULL),
(44, 'Crisântemo', 'Chrysanthemum morifolium', 'Planta herbácea perene da família Asteraceae, conhecida como \"Flor de Ouro\" no oriente. Apresenta inflorescências diversificadas em forma, tamanho e cor - branco, amarelo, rosa, vermelho, roxo. Simboliza longevidade e felicidade na cultura oriental, sendo amplamente utilizada em arranjos florais e jardins.', 'Os crisântemos necessitam de sol pleno (pelo menos 5-6 horas diárias) para floração abundante. O solo deve ser fértil, bem drenado e rico em matéria orgânica. Mantenha o solo uniformemente úmido, regando quando a superfície estiver seca. Adube a cada 2-3 semanas com fertilizante balanceado durante o crescimento. Pince os brotos laterais para estimular floração mais vigorosa. Após a floração, pode a planta e proteja do frio intenso. Multiplique por divisão de touceiras na primavera.', 'https://www.youtube.com/embed/LyaEWrGhbJM?si=MP3eN2HnL1KXkjGk', NULL),
(45, 'Pimenta', 'Capsicum annuum', 'Planta arbustiva da família Solanaceae, cultivada por seus frutos picantes ou doces. Existem centenas de variedades com diferentes níveis de picância, formas, cores e tamanhos. As pimentas contêm capsaicina, composto responsável pela sensação de ardência, e são ricas em vitaminas A e C.', 'As pimenteiras necessitam de sol pleno (8-10 horas diárias) e solo fértil, bem drenado e rico em matéria orgânica. Mantenha o solo uniformemente úmido, regando regularmente mas evitando encharcamento. Adube a cada 4-6 semanas com fertilizante rico em fósforo e potássio. Estaqueie plantas maiores para suporte. Colha os frutos quando atingirem a coloração característica da variedade. Quanto mais pimentas colher, mais a planta produzirá.', 'https://www.youtube.com/embed/bYyW_WNLDCU?si=mCxlRN0RsULCmyet', NULL),
(46, 'Sálvia', 'Salvia officinalis', 'Arbusto perene da família Lamiaceae, com folhas cinza-esverdeadas e textura aveludada. Conhecida por suas propriedades medicinais e uso culinário, possui aroma forte e sabor ligeiramente amargo. As flores são pequenas, de cor azul-violeta, e atraem polinizadores como abelhas e beija-flores.', 'A sálvia necessita de sol pleno e solo bem drenado, preferencialmente alcalino e não muito fértil. Regue moderadamente, permitindo que o solo seque entre as regas - excesso de água pode apodrecer as raízes. Podas regulares mantêm a planta compacta e estimulam novo crescimento. Adube levemente na primavera com composto orgânico. Colha as folhas pela manhã, após o orvalho secar, para melhor aroma. É tolerante à seca uma vez estabelecida.', 'https://www.youtube.com/embed/mna6LkhbNXI?si=s2b1XYGBCB_nu-kz', NULL),
(47, 'Alecrim', 'Rosmarinus officinalis', 'Arbusto perene aromático da família Lamiaceae, com folhas finas e aciculares de coloração verde-escura na face superior e prateada na inferior. Conhecido por seu aroma característico e uso culinário, medicinal e ornamental. Pode atingir até 1,5 metro de altura e produz pequenas flores azuis.', 'O alecrim necessita de sol pleno e solo bem drenado, preferencialmente arenoso e alcalino. Regue moderadamente, permitindo que o solo seque completamente entre as regas. É muito tolerante à seca e sensível ao excesso de umidade. Podas anuais após a floração mantêm a planta compacta. Adube levemente na primavera com composto orgânico. Em regiões frias, proteja de geadas intensas. Pode ser cultivado em vasos com excelente drenagem.', 'https://www.youtube.com/embed/YKPRVobYqVw?si=QwSOPU_c94jnMEPH', NULL),
(48, 'Cebolinha', 'Allium fistulosum', 'Erva perene da família Amaryllidaceae, com folhas cilíndricas e ocos de coloração verde-viva. Muito utilizada na culinária como condimento, possui sabor suave similar à cebola. Forma touceiras densas através de bulbos agregados e produz inflorescências globosas esbranquiçadas.', 'A cebolinha cresce bem em sol pleno ou meia-sombra. Prefere solo fértil, rico em matéria orgânica e mantido constantemente úmido. Regue regularmente, especialmente em períodos secos. Adube a cada 2-3 meses com composto orgânico ou fertilizante balanceado. Colha as folhas cortando na base, deixando sempre alguns centímetros para rebrota. Divida as touceiras a cada 2-3 anos para rejuvenescimento. É de fácil cultivo tanto em canteiros quanto em vasos.', 'https://www.youtube.com/embed/usH_reWduDY?si=7UP4BxnUpEKeNxwG', NULL),
(49, 'Violeta', 'Saintpaulia ionantha', 'Pequena planta herbácea perene da família Gesneriaceae, nativa da Tanzânia. Conhecida por suas folhas aveludadas e flores achatadas nas cores roxo, rosa, branco ou azul. Muito popular como planta de interior, adapta-se bem a ambientes com pouca luminosidade natural.', 'As violetas preferem luz indireta brilhante, sem exposição direta ao sol. Mantenha o solo uniformemente úmido, regando preferencialmente por baixo (no prato) para evitar molhar as folhas e flores. Utilize solo específico para violetas, com boa drenagem. Mantenha temperatura entre 18-24°C e umidade moderada. Adube mensalmente com fertilizante específico para violetas. Remova flores e folhas murchas regularmente. Evite correntes de ar e mudanças bruscas de temperatura.', 'https://www.youtube.com/embed/tpwlXe7AxKE?si=GrOpCshkeBuyDIMR', NULL),
(50, 'Coentro', 'Coriandrum sativum', 'Erva anual da família Apiaceae, com folhas delicadas e aroma característico. Amplamente utilizada na culinária latino-americana, asiática e mediterrânea. Toda a planta é comestível - folhas, talos, sementes - cada parte com sabor e aplicações culinárias distintas.', 'O coentro prefere clima ameno e pode ser cultivado em sol pleno ou meia-sombra em regiões quentes. O solo deve ser fértil, rico em matéria orgânica e mantido constantemente úmido. Regue regularmente, evitando encharcamento. Adube com composto orgânico antes do plantio. Colha as folhas conforme necessidade, começando pelas externas. É de crescimento rápido e tende a florescer rapidamente em climas quentes - para produção contínua de folhas, faça plantios sucessivos a cada 3-4 semanas.', 'https://www.youtube.com/embed/vQNk-ZLQ3BI?si=PyEY0VC4TkaA71kC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planta_estado`
--

CREATE TABLE `planta_estado` (
  `id_planta` int NOT NULL,
  `id_estado` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `planta_estado`
--

INSERT INTO `planta_estado` (`id_planta`, `id_estado`) VALUES
(1, 11),
(1, 16),
(1, 19),
(1, 21),
(1, 24),
(1, 25),
(2, 8),
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
(25, 27),
(26, 1),
(26, 3),
(26, 4),
(26, 5),
(26, 6),
(26, 7),
(26, 8),
(26, 9),
(26, 10),
(26, 11),
(26, 12),
(26, 13),
(26, 14),
(26, 15),
(26, 16),
(26, 17),
(26, 18),
(26, 19),
(26, 21),
(26, 22),
(26, 23),
(26, 24),
(26, 25),
(26, 26),
(27, 1),
(27, 2),
(27, 3),
(27, 4),
(27, 5),
(27, 6),
(27, 7),
(27, 8),
(27, 9),
(27, 10),
(27, 11),
(27, 12),
(27, 13),
(27, 14),
(27, 15),
(27, 16),
(27, 17),
(27, 18),
(27, 19),
(27, 20),
(27, 22),
(27, 23),
(27, 25),
(27, 26),
(27, 27),
(28, 13),
(28, 16),
(28, 21),
(28, 24),
(29, 1),
(29, 3),
(29, 4),
(29, 14),
(29, 22),
(29, 23),
(29, 27),
(30, 5),
(30, 6),
(30, 15),
(30, 17),
(30, 18),
(30, 20),
(30, 22),
(30, 26),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(31, 5),
(31, 6),
(31, 7),
(31, 8),
(31, 9),
(31, 10),
(31, 11),
(31, 12),
(31, 13),
(31, 14),
(31, 15),
(31, 16),
(31, 17),
(31, 18),
(31, 19),
(31, 20),
(31, 21),
(31, 22),
(31, 23),
(31, 24),
(31, 25),
(31, 26),
(31, 27),
(33, 1),
(33, 2),
(33, 4),
(33, 5),
(33, 8),
(33, 13),
(33, 14),
(33, 16),
(33, 19),
(33, 21),
(33, 24),
(33, 25),
(33, 26),
(34, 1),
(34, 4),
(34, 5),
(34, 8),
(34, 10),
(34, 13),
(34, 14),
(34, 16),
(34, 19),
(34, 21),
(34, 24),
(34, 25),
(34, 27),
(35, 8),
(35, 13),
(35, 16),
(35, 19),
(35, 21),
(35, 24),
(35, 25),
(36, 13),
(36, 16),
(36, 21),
(36, 24),
(36, 25),
(36, 27),
(37, 13),
(37, 16),
(37, 21),
(37, 24),
(37, 25),
(38, 1),
(38, 2),
(38, 3),
(38, 4),
(38, 5),
(38, 6),
(38, 7),
(38, 8),
(38, 9),
(38, 10),
(38, 11),
(38, 12),
(38, 13),
(38, 14),
(38, 15),
(38, 16),
(38, 17),
(38, 18),
(38, 19),
(38, 20),
(38, 21),
(38, 22),
(38, 23),
(38, 24),
(38, 25),
(38, 26),
(38, 27),
(39, 8),
(39, 13),
(39, 16),
(39, 19),
(39, 21),
(39, 24),
(39, 25),
(39, 27),
(40, 1),
(40, 2),
(40, 3),
(40, 4),
(40, 5),
(40, 6),
(40, 7),
(40, 8),
(40, 9),
(40, 10),
(40, 11),
(40, 12),
(40, 13),
(40, 14),
(40, 15),
(40, 16),
(40, 17),
(40, 18),
(40, 19),
(40, 20),
(40, 21),
(40, 22),
(40, 23),
(40, 24),
(40, 25),
(40, 26),
(40, 27),
(41, 1),
(41, 2),
(41, 3),
(41, 4),
(41, 5),
(41, 6),
(41, 7),
(41, 8),
(41, 9),
(41, 10),
(41, 11),
(41, 12),
(41, 13),
(41, 14),
(41, 15),
(41, 16),
(41, 17),
(41, 18),
(41, 19),
(41, 20),
(41, 21),
(41, 22),
(41, 23),
(41, 24),
(41, 25),
(41, 26),
(41, 27),
(42, 5),
(42, 6),
(42, 9),
(42, 10),
(42, 13),
(42, 16),
(42, 18),
(42, 20),
(42, 26),
(42, 27),
(43, 1),
(43, 2),
(43, 3),
(43, 4),
(43, 5),
(43, 6),
(43, 7),
(43, 8),
(43, 9),
(43, 10),
(43, 11),
(43, 12),
(43, 13),
(43, 14),
(43, 15),
(43, 16),
(43, 17),
(43, 18),
(43, 19),
(43, 20),
(43, 21),
(43, 22),
(43, 23),
(43, 24),
(43, 25),
(43, 26),
(43, 27),
(44, 13),
(44, 16),
(44, 19),
(44, 21),
(44, 24),
(44, 25),
(45, 1),
(45, 2),
(45, 3),
(45, 4),
(45, 5),
(45, 6),
(45, 7),
(45, 8),
(45, 9),
(45, 10),
(45, 11),
(45, 12),
(45, 13),
(45, 14),
(45, 15),
(45, 16),
(45, 17),
(45, 18),
(45, 19),
(45, 20),
(45, 21),
(45, 22),
(45, 23),
(45, 24),
(45, 25),
(45, 26),
(45, 27),
(46, 13),
(46, 16),
(46, 19),
(46, 21),
(46, 24),
(46, 25),
(46, 27),
(47, 5),
(47, 6),
(47, 8),
(47, 9),
(47, 13),
(47, 16),
(47, 18),
(47, 19),
(47, 20),
(47, 21),
(47, 24),
(47, 25),
(47, 26),
(47, 27),
(48, 1),
(48, 2),
(48, 3),
(48, 4),
(48, 5),
(48, 6),
(48, 7),
(48, 8),
(48, 9),
(48, 10),
(48, 11),
(48, 12),
(48, 13),
(48, 14),
(48, 15),
(48, 16),
(48, 17),
(48, 18),
(48, 19),
(48, 20),
(48, 21),
(48, 22),
(48, 23),
(48, 24),
(48, 25),
(48, 26),
(48, 27),
(49, 7),
(49, 8),
(49, 13),
(49, 16),
(49, 19),
(49, 21),
(49, 24),
(49, 25),
(49, 27),
(50, 1),
(50, 2),
(50, 3),
(50, 4),
(50, 5),
(50, 6),
(50, 7),
(50, 8),
(50, 9),
(50, 10),
(50, 11),
(50, 12),
(50, 13),
(50, 14),
(50, 15),
(50, 16),
(50, 17),
(50, 18),
(50, 19),
(50, 20),
(50, 21),
(50, 22),
(50, 23),
(50, 24),
(50, 25),
(50, 26),
(50, 27);

-- --------------------------------------------------------

--
-- Table structure for table `planta_tags`
--

CREATE TABLE `planta_tags` (
  `id` int NOT NULL,
  `tag_id` int DEFAULT NULL,
  `planta_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `nome_tag` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `emprego` varchar(255) DEFAULT NULL,
  `imagem` varchar(500) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `tipo` enum('user','admin','apoiador') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `emprego`, `imagem`, `senha`, `tipo`) VALUES
(8, 'Pedro Otavio', 'Pedro.otavio@gmail.com', '12312312310', 'Botanico', 'uploads/68ed26f35419b_2pac.jpg', '$2y$10$LeJjICS9hOSvHNgrwcsZSu4/.m0rKiRTbD9ou9A8v3ZZvrEAeil8C', 'user'),
(9, 'Leonardo', 'leomunizetec@gmail.com', '12145678952', 'admin', 'uploads/68f11f944de7b_eminem.jpg', '$2y$10$LeJjICS9hOSvHNgrwcsZSu4/.m0rKiRTbD9ou9A8v3ZZvrEAeil8C', 'admin'),
(10, 'Miguel', 'miguelnas190@gmail.com', '11111111111', 'admin', 'uploads/68f122815189a_snoop_dogg_photo_by_estevan_oriol_archive_photos_getty_455616412.jpg', '$2y$10$Il9PfNhpxOOpsrTtCicLKethKUlXZw73KnWArQt9iH2/eQtnB7.He', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplicacoes_biotec`
--
ALTER TABLE `aplicacoes_biotec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `distribuicao_geografica`
--
ALTER TABLE `distribuicao_geografica`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planta_estado`
--
ALTER TABLE `planta_estado`
  ADD PRIMARY KEY (`id_planta`,`id_estado`),
  ADD KEY `id_planta` (`id_planta`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `planta_tags`
--
ALTER TABLE `planta_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplicacoes_biotec`
--
ALTER TABLE `aplicacoes_biotec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `distribuicao_geografica`
--
ALTER TABLE `distribuicao_geografica`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `planta`
--
ALTER TABLE `planta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `planta_tags`
--
ALTER TABLE `planta_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_planta` FOREIGN KEY (`planta_id`) REFERENCES `planta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_avaliacao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
