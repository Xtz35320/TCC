-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19/09/2025 às 11:30
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


INSERT INTO `aplicacoes_biotec` (`id`, `planta_id`, `texto`) VALUES
(1, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.'),
(2, 1, 'A costela-de-adão (Monstera deliciosa) tem aplicações em biotecnologia principalmente na área da micropropagação, onde técnicas de cultura de tecidos são usadas para multiplicar a planta de forma rápida e clonal, preservando características como a variegação. Também é usada como ornamental, purificando o ar e harmonizando ambientes. Seus frutos são comestíveis, embora exijam preparo adequado.'),
(3, 26, 'O Ipê-Amarelo é estudado por suas propriedades medicinais, com compostos antioxidantes e anti-inflamatórios extraídos da casca.'),
(4, 27, 'A Vitória-Régia tem potencial em biotecnologia para extração de compostos naturais utilizados em cosméticos e produtos farmacêuticos.'),
(5, 28, 'O Mandacaru é estudado para produção de biopolímeros e biofertilizantes em regiões áridas.'),
(6, 29, 'A Araucária fornece resinas e compostos voláteis com propriedades antimicrobianas de interesse biotecnológico.'),
(7, 30, 'O Jatobá é fonte de compostos bioativos com uso potencial na indústria farmacêutica e alimentícia.');





INSERT INTO `apoiador` (`id`, `nome`, `email`, `cpf`, `emprego`, `imagem`, `senha`) VALUES
(7, 'admin', 'admin@gmail.com', '12345678910', 'admin', 'uploads/68ea95512228c_Imagem do WhatsApp de 2025-10-07 à(s) 18.38.21_0a6b6c49.jpg', '$2y$10$avfntVAE/6r/rW51Sgcyju/7aNmHYE4HeBDR844JQF27MhomWhSAm');



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
(24, 30, 'Plantae', 'Magnoliophyta', 'Fabales', 'Fabaceae', 'Hymenaea', 'H. courbaril', 'H. courbaril');




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


INSERT INTO `documentos` (`id`, `planta_id`, `tipo`, `titulo`, `link_pdf`) VALUES
(1, 1, 'Artigo Científico', 'Estudo sobre Monstera deliciosa', 'documentos/artigo_monstera.pdf'),
(2, 1, 'Guia de Cultivo', 'Técnicas para cultivo ideal', 'documentos/guia_cultivo.pdf'),
(3, 1, 'Pesquisa Genética', 'Análise genômica da espécie', 'documentos/genetica_monstera.pdf'),
(4, 1, 'Artigo Científico', 'Estudo sobre Monstera deliciosa', 'documentos/artigo_monstera.pdf'),
(5, 1, 'Guia de Cultivo', 'Técnicas para cultivo ideal', 'documentos/guia_cultivo.pdf'),
(6, 1, 'Pesquisa Genética', 'Análise genômica da espécie', 'documentos/genetica_monstera.pdf');



INSERT INTO `imagens` (`id`, `planta_id`, `caminho_imagem`, `descricao`) VALUES
(4, 1, '../assets/img/costela_de_adao.jpg', 'Imagem frontal da planta'),
(25, 22, '../assets/img/68bae3e99b57c_açaí.jpg', 'Imagem de Açaizeiro'),
(26, 23, '../assets/img/68bae75747f01_samambaia.jpg', 'Imagem de Samambaia'),
(27, 24, '../assets/img/68baefcec4a2e_Imperial_palm_trees.JPG', 'Imagem de Palmeira Imperial'),
(28, 25, '../assets/img/68baf21073e55_banana.jpg', 'Imagem de Bananeira'),
(29, 25, '../assets/img/68baf210745ea_Bananeira-1.jpg', 'Imagem de Bananeira'),
(30, 26, '../assets/img/Handroanthus_serratifolius.jpg', NULL),
(31, 26, '../assets/img/ipe_amarelo.jpg', NULL),
(32, 27, '../assets/img/vitoria-regia-1140515.jpg', NULL),
(33, 27, '../assets/img/Vitregias02.jpg', NULL),
(34, 28, '../assets/img/Mandacaru_arvore.webp', NULL),
(35, 28, '../assets/img/Cereus_jamacaru.jpg', NULL),
(36, 29, '../assets/img/araucaria.jpg', NULL),
(37, 29, '../assets/img/Araucaria2.jpg', NULL),
(38, 30, '../assets/img/jatoba.jpg', NULL),
(39, 30, '../assets/img/Jatobá-1-768x1024.jpg', NULL);

INSERT INTO `planta` (`id`, `nome_popular`, `nome_cientifico`, `descricao`, `cuidados`, `video_link`, `apoiador_id`) VALUES
(1, 'Costela-de-Adão', 'Monstera deliciosa', 'A costela-de-adão é uma planta da família das aráceas. Possui folhas grandes, cordiformes, penatífidas perfuradas, com longos pecíolos, flores aromáticas, em espádice comestível, branco-creme, com espata verde, e bagas amarelo-claras.', 'Luz indireta, regas regulares sem encharcar o solo, umidade adequada e substrato bem drenado.', 'https://www.youtube.com/embed/gMGSl1fqQ84?si=xveGqLfD6zexLJ2e', NULL),
(24, 'Palmeira Imperial', 'Roystonea oleracea', 'As palmeiras são plantas perenes, arborescentes, tipicamente com um caule cilíndrico não ramificado do tipo estipe, atingindo grandes alturas, mas por vezes se apresentando como acaules (caule subterrâneo). Não são consideradas árvores porque todas as árvores possuem o crescimento do diâmetro do seu caule para a formação do tronco (crescimento secundário), que produz a madeira e tal não acontece com as palmeiras.\r\n\r\nA seiva de algumas espécies de arecáceas é tradicionalmente fermentada para produzir o vinho de palma, muito apreciado e conhecido em Moçambique com o nome de \"sura\" (onde, para além de ser bebido, é também utilizado como fermento na fabricação de pães e bolos). Em Angola, o vinho de palmeira é conhecido como \"marufo\". O buriti (Mauritia flexuosa) também é fermentado (entre outras formas de consumo), dando origem ao vinho de buriti, e o açaí (Euterpe oleracea) dá o vinho de açaí. No Brasil, a palmeira-imperial (Roystonea oleracea) plantada em 1809 por D. João VI, tornou-se o \"símbolo do império\" em meados do século XIX.', 'Para cuidar de uma palmeira-imperial (Roystonea oleracea), que necessita de sol pleno, solo fértil e bem drenado e rega regular, faça adubações periódicas com fertilizantes próprios ou orgânicos e pode apenas as folhas secas para não prejudicar a planta. Embora seja tolerante à seca quando adulta, a palmeira-imperial precisa de água suficiente durante os primeiros meses de crescimento para se estabelecer e crescer forte. ', 'https://www.youtube.com/embed/6oGZOoJVt4M?si=6A2qeoA1R2gTFdLx', NULL),
(23, 'Samambaia', 'Tracheophyta', 'As samambaias, ou fetos, são vegetais vasculares membros do táxon das pteridófitas (que deixou de ter validade taxonômica e só é utilizado como uma denominação informal). Elas possuem tecidos vasculares (xilema e floema), folhas verdadeiras, se reproduzem através de esporos e não produzem sementes ou flores.', 'Para cuidar bem de uma samambaia, forneça luz indireta abundante, mantenha o solo constantemente úmido, mas nunca encharcado, borrifando água nas folhas para aumentar a umidade do ar. Realize adubações regulares com fertilizantes orgânicos, como húmus de minhoca, e faça a poda de folhas secas ou danificadas. ', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq', NULL),
(22, 'Açaizeiro', 'Euterpe oleracea', 'O açaí é uma palmeira muito comum na região da Amazônia que produz um fruto bacáceo de cor roxa (a parede do órgão ovário amadurece e forma a camada externa comestível), muito utilizado na confecção de alimentos e bebidas. A palmeira do açaí é por vezes confundida, no estado do Pará, com a palmeira juçara, que embora seja outro tipo de palmeira, dá palmito de excelente qualidade.', 'Para cuidar de um açaizeiro, mantenha o solo constantemente úmido, mas sem encharcar, e adube-o com matéria orgânica para garantir os nutrientes necessários. Realize podas regulares para remover folhas velhas ou doentes, ajudando a palmeira a crescer saudável. Monitore a planta em busca de pragas e doenças, adotando medidas de controle quando necessário. É importante também que o local tenha sol pleno e alta umidade.', 'https://www.youtube.com/embed/zylP9UUg5QQ?si=U5k9QdCRGuDfsKdj', NULL),
(25, 'Bananeira', 'Musa', 'As bananeiras, figueiras-de-adão, pacobeiras ou pacoveiras são plantas do gênero Musa, um dos três que compõem a família Musaceae, que inclui as plantas herbáceas vivazes, incluindo as bananeiras cultivadas para a produção de fibras (abacás) e para a produção de bananas.', 'Assim como qualquer planta, frutífera ou não, o sucesso depende de como você faz o cultivo. A bananeira adora ambientes úmidos, mas sem excessos. O ideal é uma taxa de 50% de umidade para que ela se mantenha saudável.\r\n\r\nIsso é essencial para ela crescer bem. Por essa razão, quando é cultivada em ambientes com temperaturas mais amenas, a bananeira deve ser colocada em um local onde possa receber luz solar para crescer e dar frutos.\r\n\r\nAlém disso, analisar as folhas da planta faz parte de como cuidar de bananeira em vaso ou em jardim. Se a tonalidade for amarelada, é sinal de que faltam nutrientes. Então, é hora de caprichar na adubação com nitrogênio na etapa do desenvolvimento e em um fertilizante 15:5:30 regularmente na fase adulta. Para a manutenção, confira outros detalhes!\r\n\r\nElimine infestantes para aumentar o vigor da bananeira e evitar pragas;\r\nRegue a planta com frequência, evitando que o solo fique com aparência seca;\r\nRemova folhas velhas para evitar atrito e danos no cacho de bananas;\r\nUse restos da planta para adubar o solo em volta, mas não diretamente abaixo do tronco.\r\nO último ponto de atenção ocorre em uma fase já mais avançada, na época dos frutos. Após cortar o cacho, é preciso podar o tronco da bananeira à meia-altura. Isso faz com que a planta-filha retire nutrientes do restante do tronco da planta-mãe. Só depois, é possível removê-la totalmente.', 'https://www.youtube.com/embed/45j_-Sxp3gM?si=WVQ7VabU5I5aIZCq', NULL),
(26, 'Ipê-Amarelo', 'Handroanthus albus', 'Árvore nativa do Brasil, muito conhecida por suas flores amarelas intensas e beleza ornamental. É símbolo da resistência e da força da natureza.', 'Prefere sol pleno e solos bem drenados. Regar moderadamente e podar após a floração.', NULL, NULL),
(27, 'Vitória-Régia', 'Victoria amazonica', 'Planta aquática de grande porte, típica da região amazônica, famosa por suas folhas gigantes e flores que abrem à noite.', 'Necessita de lagoas com água quente e tranquila, rica em nutrientes. Não tolera frio intenso.', NULL, NULL),
(28, 'Cacto-Mandacaru', 'Cereus jamacaru', 'Cacto típico do semiárido brasileiro, resistente à seca, com flores brancas grandes que florescem à noite.', 'Evitar excesso de água e manter em local ensolarado. Pode ser cultivado em solos arenosos e secos.', NULL, NULL),
(29, 'Araucária', 'Araucaria angustifolia', 'Árvore símbolo do sul do Brasil, também conhecida como pinheiro-do-paraná. Produz sementes comestíveis chamadas pinhões.', 'Prefere climas frios e solos ácidos. Requer espaçamento amplo para se desenvolver adequadamente.', NULL, NULL),
(30, 'Jatobá', 'Hymenaea courbaril', 'Árvore de grande porte da Mata Atlântica e Amazônia. Possui madeira resistente e frutos utilizados na alimentação e medicina tradicional.', 'Necessita de solo fértil e boa luminosidade. Suporta períodos secos, mas cresce melhor em clima úmido.', NULL, NULL);

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
(28, 21),
(28, 16),
(28, 13),
(28, 24),
(29, 4),
(29, 3),
(29, 1),
(29, 14),
(29, 27),
(29, 23),
(29, 22),
(30, 5),
(30, 18),
(30, 17),
(30, 15),
(30, 22),
(30, 6),
(30, 20),
(30, 26);
