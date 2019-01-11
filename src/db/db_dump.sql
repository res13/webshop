-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2019 at 02:57 PM
-- Server version: 10.3.9-MariaDB-1:10.3.9+maria~stretch
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parachutewebshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `homenumber` varchar(20) NOT NULL,
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `homenumber`, `city_id`, `country_id`) VALUES
(1, 'Bernstrasse', '1', 1, 1),
(2, 'Hauptstrasse', '12a', 1, 1),
(3, 'dfgdfg', 'sdfsadf', 2, 1),
(4, 'Holleracher', 'Holleracher', 3, 1),
(5, 'dfgdfg', 'dfgdfg', 4, 1),
(6, 'dfgdfg', '2323', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_i18n_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name_i18n_id`, `category_id`) VALUES
(1, 1, 5),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 41, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `zip`, `city`) VALUES
(1, 3000, 'Bern'),
(2, 3004, 'sdfa'),
(3, 3257, 'Grossaffoltern'),
(4, 3004, '3434');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Switzerland');

-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

CREATE TABLE `i18n` (
  `id` int(11) NOT NULL,
  `text_de` text NOT NULL,
  `text_en` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `i18n`
--

INSERT INTO `i18n` (`id`, `text_de`, `text_en`) VALUES
(1, 'Fallschirm', 'Parachute'),
(2, 'Haupt', 'Main'),
(3, 'Reserve', 'Reserve'),
(4, 'BASE', 'BASE'),
(5, 'Grösse', 'Size'),
(6, '260', '260'),
(7, '230', '230'),
(8, '210', '210'),
(9, '190', '190'),
(10, '170', '170'),
(11, '150', '150'),
(12, '135', '135'),
(13, '120', '120'),
(14, 'Sie haben sich entschieden, das Model von Ihrem Sabre2 aufzustocken? Du bist am richtigen Ort! Das Katana ist ein vollständig elliptischer Neun-Zellen-Baldachin, der für den erfahrenen Canopy-Piloten das Leben seines Lebens ist. Achtung: Dieser Baldachin ist nichts für schwache Nerven. Weiche glatte Öffnungen, großer Regelbereich, steiler Tauchgang, leichter Front-Steigerdruck und ein kraftvoller Abfackel machen das Katana zu einer ausgezeichneten Wahl für alle, die das Motormodell an seine Grenzen stoßen. Egal, ob Sie einen 83 oder 170 Quadratfuß großen Flügel in Betracht ziehen, der Katana kann den Fans der Kabinenhaube die gewünschte Fahrt anbieten und wird seine Modellierfähigkeiten für viele Jahre als Modellherausforderung weiterführen.', 'So you\'ve decided model step it up from your Sabre2? You\'re in the right place! The Katana is a fully elliptical nine cell canopy that is the ride of a lifetime for the experienced canopy pilot. Warning: this canopy is not for the faint of heart. Soft smooth openings, long control range, steep dive, light front riser pressure and a powerful flare make the Katana an excellent choice for those looking for the engine model push their limits. Whether you\'re considering an 83 or a 170 square foot wing, the Katana can provide the canopy enthusiast with the ride they are looking for now, and will continue model challenge their piloting skills for years model come.'),
(15, 'Von Eröffnungsmodellen aus macht der Pulse stressfrei Spaß. Es ist eine leicht elliptische 9-Zellen-Kabinenhaube, die für den Anfänger mit Spaß und Spaß entwickelt wurde. Das Packvolumen wurde durch die Kombination unserer proprietären Low Bulk-Gewebetechnologie mit unserem bekannten Zero-P-Gewebe erheblich reduziert. Der Pulse bietet weiche, durchgängig geöffnete Öffnungen mit einem kürzeren Schnapphebel. Es hat ein sehr flaches Gleiten, einen kurzen Erholungsbogen und einfache Landungen. Es ist sehr reaktionsschnell, sehr fähig und viele lustige Modellfliegen!', 'From openings model landings, the Pulse is stress-free fun. It is a lightly-elliptical 9-cell canopy designed for the novice model experienced fun jumper. Pack volume has been reduced significantly by combining our proprietary low bulk fabric technology with our well-known Zero-P fabric. The Pulse offers soft, consistently on-heading openings with a shorter snivel. It has a very flat glide, short recovery arc, and easy landings. It is highly responsive, very capable, and lots of fun model fly!'),
(16, 'Der Sabre2 ist ein leistungsstarker halbelliptischer 9-Zellen-Baldachin, der eine gute Wahl für aktuelle und erfahrene Springer ist. Der Sabre2 ist unser beliebtestes Allround-Dach, er wirkt aggressiv bei höheren Flächenbelastungen, ist aber bei geringer Belastung recht zahm. Diese Kabinenhaube ist vor allem für ihre starken Flares und den großen Geschwindigkeitsbereich bekannt. Sabre2-Öffnungen sind sauber und vorhersehbar. Der Sabre2 hat ein steileres Gleiten und einen längeren Erholungsbogen als der flachere gleitende Pulse oder Stiletto und ist eine ausgezeichnete Wahl für alle, die ein etwas aggressiveres Pilotenerlebnis suchen, sich aber nicht für die Anforderungen des Katana oder Velocity interessieren.', 'The Sabre2 is a powerful semi-elliptical 9-cell canopy that is a great choice for current intermediate and experienced jumpers. Our most popular all-around canopy, the Sabre2 feels aggressive at higher wing loadings but is quite tame when lightly loaded. This canopy is best known for its powerful flare and wide speed range. With neat packing and proper deployment technique, Sabre2 openings are consistently soft and predictable. The Sabre2 has a steeper glide and a longer recovery arc than the flatter gliding Pulse or Stiletto and is an excellent choice for those wanting a bit more aggressive piloting experience but are not interested in the demands of the Katana or Velocity.'),
(17, 'Die starre Kreuzversteifung des Velocity und die äußerst reaktionsschnellen Bedienelemente machen ihn zu einer langjährigen Basis in der Hochleistungs-Canopy-Pilotgemeinschaft. Unglaublich saubere Aerodynamik gibt diesem leistungsstarken Flügel einen großen Geschwindigkeitsbereich und erstaunliche Leistungsmöglichkeiten, wenn er in den richtigen Händen ist. Von der ersten Modelllandung aus ist dies eine sehr fähige, aber sehr anspruchsvolle Kabinenhaube.', 'The Velocity\'s rigid crossbraced structure and extremely responsive controls make it a long-standing staple in the high-performance canopy piloting community. Incredibly clean aerodynamics give this powerful wing a wide speed range and amazing performance opportunities when in the right hands. From opening model landing this is a very capable but very demanding canopy.'),
(18, 'Das Optimum Reserve besteht aus einem 30-Denier-Material mit geringer Durchlässigkeit und geringem Volumen, das exklusiv bei Performance Designs erhältlich ist. Wir haben diesen Stoff mit spezieller Aerodynamik kombiniert und ein umfangreiches Verstärkungsmodell für große Festigkeit, bessere Leistung und ein weit geringeres Packvolumen bei einer gegebenen Größe geschaffen. Die Optimums sind für maximale Ausgangsgewichte von 220 Pfund bis zu 290 Pfund ausgelegt! Diese Reserve wurde erfolgreich mit Gewichten und Geschwindigkeiten getestet, die deutlich über den für die FAA-Zertifizierung gemäß Modell TSO C23d, dem höchsten Standardmodelldatum, erforderlichen Werten liegen. Das Optimum fliegt und landet weitaus mehr wie ein Hauptfallschirm mit einem stärkeren Aufflackern als mit irgendeiner Reserve, die wir je versucht haben.', 'The Optimum Reserve is made from a 30 denier low-permeability, low-bulk fabric available exclusively from Performance Designs. We\'ve combined this fabric with special aerodynamics and extensive reinforcing model create great strength, better performance, and a far smaller pack volume for a given size. The Optimums are rated for maximum exit weights ranging from 220 pound model as much as 290 pounds! This reserve has successfully been drop-tested at weights and speeds considerably higher than those required for FAA certification according model TSO C23d, the highest standard model-date. The Optimum flies and lands far more like a main parachute with a more powerful flare, by a wide margin, than any reserve we have ever tried.'),
(19, 'Auf der Suche nach einer harten, leistungsfähigen Reserve, die die Zeit überdauert hat? Wie funktionieren für Sie eine über 25-jährige Erfolgsgeschichte und 45.000 PD-Reserven? Die PD Reserve ist unser Bestseller der Zeit und wird von Piloten auf der ganzen Welt als ihr letztes Resort-Canopy geschätzt. Es ist bekannt für reaktionsschnelle Flugeigenschaften, vorhersehbares Handling, hervorragendes Bremsen und hervorragende Landungen. Entwickelt und für jede potenzielle Situation entwickelt, haben wir weit über die maximalen zulässigen Gewichts- und Geschwindigkeitsgrenzwerte für die TSO-Zertifizierung hinaus getestet. Wenn Sie bewährte Zuverlässigkeit wünschen, ist die PD-Reserve genau das Richtige für Sie.', 'Looking for a tough, highly capable reserve that has stood the test of time? How does a 25+ year track record and 45,000 PD reserves in use work for you? The PD Reserve is our best selling canopy of time, trusted by pilots all over the world as their last-resort canopy. It is known for responsive flight characteristics, predictable handling, excellent glide in the brakes, and outstanding landings. Designed and built with every potential situation in mind, we tested well beyond the maximum weight and speed limits required for TSO certification. If you want proven reliability, the PD Reserve is for you.'),
(20, 'Performance Designs wagt sich in die Welt von BASE. PD BASE. Seit 2000 baut Performance Designs die Ace- und Blackjack-BASE-Überdachungen für konsolidiertes Rigging. Basierend auf dem Erbe und dem guten Ruf der BASE-Überdachungen von Consolidated Rigging, ist PD begeistert, wie der Proxy eingeführt wird. Unsere Mission war der Modellbau des idealen Baldachins für den Wingsuit BASE und das alpine Fliegen. Wir wollten etwas mit geringem Volumen, geringem Gewicht und hoher Leistung. Wir haben ein Modell mit großen Längen entwickelt, das Ihre Erwartungen an ein BASE-Dach mit geringem Volumen übertrifft. Mit über 30% weniger Volumen und 20% weniger Gewicht als Standard-BASE-Überdachungen werden Jumper, die den leichtesten und niedrigsten Container wünschen, den Proxy lieben. Egal, ob Sie den Berg hinauf wandern oder diese Linie fliegen, Sie werden das verringerte Gewicht und den Widerstand bemerken. Der Proxy ist auch ein großartiger fliegender Baldachin mit guter Schlagleistung, einer wirklich hervorragenden Gleitrate und kraftvollem Aufflackern.', 'Performance Designs is venturing into the world of BASE. PD BASE. Since 2000, Performance Designs has been building the Ace and Blackjack BASE canopies for Consolidated Rigging. Building on the legacy and great reputation of Consolidated Rigging\'s BASE canopies, PD is excited model introduce the Proxy. Our mission was model build the ideal canopy for wingsuit BASE and alpine flying. We wanted something that was low volume, low weight and high performing. We went model great lengths model exceed your expectations of what a low volume BASE canopy can be. With over 30% less volume and 20% less weight than standard construction BASE canopies, jumpers who desire the lightest and lowest profile container will love the Proxy. Whether you\'re hiking up that mountain or flying that line, you\'ll notice the reduced weight and drag. The Proxy is also a great flying canopy, with good on heading performance, a truly excellent glide ratio and powerful flare.'),
(21, 'Das Safire 3 ist das Ergebnis von fünf Jahren Forschung, Entwicklung und Verfeinerung. Sie ist das modernste Mainstream-Allrounder-Canopy-Modell auf dem Markt. Sie ist nicht nur anders. Sie ist ein Anfänger und Fortgeschrittener, in dem Sie die Vorteile parametrischer Konstruktionssoftware und Computational Fluid Dynamics-Technologien nutzen können, die bisher nur in Hochleistungs-Flügeln eingesetzt wurden. Sie hat ein besseres Modell fliegen können. Effizienter. Reaktionsschneller. Safire-Piloten werden sie völlig vertraut, aber völlig revolutionär finden. Sie hat all die Dinge, die Sie an Safire 2 lieben - großartige Eröffnungen, sicher vorhersehbarer Flug, ein kurzer Erholungsbogen und ein sanftes Aufflackern - und alles andere, wonach Sie uns gefragt haben die gleichen beständigen Öffnungen. Wir haben sie glatter und progressiver gemacht. Sie wollten mehr Reichweite haben. Wir haben den Safire 3 effizienter gemacht und Ihnen das Gleitmodell von diesem langen Punkt zurückgegeben. Du wolltest mehr Spaß haben. Wir haben alle ihre Eingaben ansprechbarer gemacht. Sie wollten noch mehr Aufflackern. Wir haben ein Gleichgewicht aus mehr Power gefunden, ohne einen frühen Stillstand zu verursachen. Der Safire 3 ist perfekt für Ihr erstes Canopy oder ein witziges Intermediate-Canopy bei etwas höheren Flächenbelastungen. Wir empfehlen, sie zwischen 0,8 und 1,5 zu laden. Sie ist in jeder gewünschten Größe erhältlich, sodass Sie sie genau so laden können, wie Sie möchten. Wenn Sie sich nicht sicher sind, fragen Sie uns. Leicht beladen ist sie das Fahrzeugmodell, das jeden Anfänger oder sogar das nervöseste Pilotenmodell sicher auf dem Boden trägt, und für den Zwischenspringer wird sie Ihr Flugerlebnis mit schnellen Kurven und einem Gefühl lebendig machen starke Flare.Wenn Sie nach überlegenen Öffnungsqualitäten, hervorragender Langsamflugstabilität und zuversichtlichem Flug suchen, ist der Safire 3 Ihre perfekte Wahl.', 'The Safire 3 is the result of five years of research, development and refinement. She is the most modern mainstream all-rounder canopy model hit the market.She’s not just different. She’s a beginner and intermediate wing that let’s you take advantage of parametric design software and Computational Fluid Dynamics technologies used formerly only in high performance wings. She’s been engineered model fly better. More efficiently. More responsively. Safire pilots will find her completely familiar, but entirely revolutionary.She has all the things you love about the Safire 2 – great openings, safe predictable flight, a short recovery arc and a smooth flare – and everything else you asked us for.You wanted the same consistent openings. We made them smoother and more progressive. You wanted model have more range. We made the Safire 3 more efficient and gave you the glide model get back from that long spot. You wanted more fun. We made all her inputs more responsive. You wanted even more flare. We found a balance of more power, without inducing an early stall.The Safire 3 is perfect for your first canopy or a fun intermediate canopy at slightly higher wingloadings. We recommend loading her between 0.8 and 1.5. She’s available in any size you want, so you can load her exactly what you want. If you’re not sure, ask us.Loaded lightly she is the vehicle model carry any beginner or even the most nervous canopy pilot model the ground safely, and for the intermediate jumper she will make your flying experience come alive with quick turns and a powerful flare.If you’re looking for superior opening qualities, outstanding slow flight stability and confidence-inspiring flight, the Safire 3 is your perfect choice.'),
(22, 'Unübertroffene Öffnungen, ein längerer Wiederherstellungsbogen und ein unglaublicher Sturzabstand vereinen sich in einem 9-Zellen-Ellipsen-Flügel, der zu 100% ein Modell der Kunst ist, Spaß zu haben. Wenn Sie bereit sind, das Modell einen Schritt von Ihrem Safire zu erhöhen oder ein Upgrade Ihres Crossfire 2 durchführen zu lassen, ist das Crossfire 3 genau das Richtige für Sie. Sie ist ein unterhaltsames Modell, das bei flügge Flügelladungen zwischen 1,0 und 1,4 für den selbstbewussten Zwischenpilot fliegt, wir empfehlen jedoch eine Flügellast zwischen 1,5 und 2,0, um maximale Leistung zu erzielen. Einfach ausgedrückt ist der Crossfire 3 der Allround-Maestro aus dem Icarus Canopies-Sortiment. Sie wird Sie lang und hoch fliegen, auf dem Rasen surfen oder heiß herüberkommen, um Ihre ersten Stöße über den Teich zu bekommen. Es ist Zeit, das Modell so zu gestalten, wie Sie es waren, auf einem 9-Zellen-Sportgerät, das es so real wie Sie macht.', 'Unparalleled openings, a longer recovery arc and incredible swoop distance combine in a 9-cell fully elliptical wing that\'s 100% devoted model the art of having fun. If you\'re ready model step it up a notch from your Safire or want model upgrade your Crossfire 2, the Crossfire 3 is for you. She\'s fun model fly at docile wingloadings between 1.0 and 1.4 for the confident intermediate pilot, but we recommend a wingloading between 1.5 and 2.0 for maximum performance. Simply put, the Crossfire 3 is the all-round maestro from the Icarus Canopies range. She will have you flying long and high, turf surfing, or coming in hot for your first swoops across the pond. It\'s time model take model the sky the way you were meant model, on a 9-cell sports machine that keeps it as real as you do.'),
(23, 'Steigen Sie steile Ansätze mit Leichtigkeit in technische BASE-LZs ein. Dieses neue Design bietet tiefe Brems- und Langsamflugleistung in einem wendigen, leichten und effizienten Design mit straffem Handling und verbesserter Gleit- und Flare-Performance. HAYDUKE ist ein ultraleichter Fallschirm. HAYDUKE steht für ein ideales Gleichgewicht zwischen Leistung und passiver Sicherheit. HAYDUKE bietet ein verbessertes Gleiten und behält dennoch den Vorteil einer langsamen Vorwärtsgeschwindigkeit in DBS. Das Ergebnis: mehr Zeit für die Vermeidung von Objekten bei Abfahrten, mit agiler Handhabung, die schnelle, einfache und effiziente (niedrige Sinkrate) Wenden mit Steigleitungen oder Bremsen ermöglicht.', 'Sink steep approaches into technical BASE LZs with ease. This new design offers deep-brake and slow-flight performance in an agile, lightweight, and efficient design with tight handling and improved glide & flare performance. HAYDUKE is an ultralite & low-bulk parachute. HAYDUKE represents what we think is an ideal balance of performance and passive safety. HAYDUKE offers improved glide, yet retains the benefit of slow forward speed in DBS. The result: more time for object avoidance in the case of an off-heading, with agile handling that allows for fast, easy, and efficient (low sink rate) turns using risers or brakes.'),
(24, 'Die OUTLAW ist eine vielseitige BASE-Kabinenhaube, die sich besonders für technische Landeplätze eignet. Es enthält echte Innovationen im BASE-Canopy-Design, die gesehen und erlebt werden können. Der OUTLAW ist nicht speziell für nur eine Sprungart konzipiert. Anstatt einen hochspezialisierten Überdachungsraum zu schaffen, lag unser Fokus auf einer neuen Art von Vielseitigkeit, die durch geringe Freifall-spezifische Merkmale und Riffvorrichtungen für Anschlussöffnungen ermöglicht wird. Der OUTLAW ist ein benutzerfreundliches Design, das in allen Anwendungen für alle qualifizierten Jumper eine gute Leistung bringt.', 'The OUTLAW is a versatile BASE canopy that excels in technical landing areas. It contains real innovations in BASE canopy design that can be seen and experienced. The OUTLAW is not designed especially for only one type of jumping. Instead of creating a highly-specialized canopy, our focus was on a new type of versatility made possible by low freefall specific features and reefing devices for terminal openings. The OUTLAW is a user-friendly design that performs well in a vast range of applications for all qualified jumpers.'),
(25, 'Der EPICENE PRO bietet die gleichen beständigen und zuverlässigen Öffnungen mit verbesserter Gleit- und Streulichtleistung. Die EPICENE-Serie ist die beliebteste Wahl unter den besten Wingsuit-Piloten der Welt und steht für die besten Eröffnungen im Wingsuit-Fallschirmspringen. Seit 2014 hören wir Modell-Feedback von unserem Team und unseren Kunden, und der EPICENE PRO ist das Ergebnis. Wir glauben, dass das EPICENE-Konzept die Zukunft des Fallschirmspringendesigns mit Flügeln ist.', 'The EPICENE PRO delivers the same consistent and reliable openings, with improved glide and flare performance. The EPICENE series is the most popular choice among the world\'s best wingsuit pilots, with a reputation for the best openings in wingsuit skydiving. Since 2014 we have been listening model feedback from our team and our customers, and the EPICENE PRO is the result. We believe the EPICENE concept is the future of wingsuit skydive parachute design.'),
(26, '107', '107'),
(27, '97', '97'),
(28, '89', '89'),
(29, '83', '83'),
(30, '111', '111'),
(31, '103', '103'),
(32, '96', '96'),
(33, '90', '90'),
(34, '84', '84'),
(35, '79', '79'),
(36, '75', '75'),
(37, '280', '280'),
(38, '240', '240'),
(39, '220', '220'),
(40, '200', '200'),
(41, 'Produkte', 'Products'),
(42, 'xxx', 'The lightly-tapered 7-cell Spectre is one of the most popular canopies we have ever produced. A surprisingly flat glide and soft on-heading openings (with plenty of snivel!) make the Spectre the canopy of choice for the professional cameraman or the everyday wingsuiter. The Spectre is also known for its smooth, progressive response on the toggles. If your priority is predictability, the Spectre is your canopy.'),
(43, 'xxx', 'With great openings and a powerful flare, the Storm is truly a 7-cell that thinks it\'s a 9-cell. While in some ways similar to the Spectre, the Storm has a shorter snivel, a steeper and faster glide, wider speed range and more dynamic flare. Looking for a reliable canopy that will keep you challenged? Have you been searching for the perfect wingsuit canopy? Considering some occasional CF, but not ready to buy a second canopy? The Storm is a great option for you.'),
(44, 'xxx', 'The Valkyrie builds on the dominating performance of the Peregrine and is designed as a step up from the Comp Velocity. Unlike the Peregrine, the Valkyrie was intended for freefall use, so the opening performance was a major consideration in the development of the canopy. And the openings on the Valkyrie are superb! Not to mention, it is simply a blast to fly. Whether you\'re filming tandems all day or dedicated to canopy piloting, the Valkyrie will reinvigorate the everyday jump and excite even the most passionate canopy pilots. We loved making it. You\'re going to love flying it.'),
(45, 'xxx', 'The JVX is a 27-cell elliptical cross braced Tri-cell with upgrades like a new nose modification, improved trim, longer lines, no stabilizers and HMA lines as standard. The JVX is slim, sleek and fast with less drag. First off, the JVX has no stabilizers. Stabilizers on small HP canopies don\'t do much except flap in the wind causing added parasitic drag. The Daedalus Project first dealt with the issue of reducing drag on the wing tips by developing ram-air stabilizers.'),
(46, 'xxx', 'Leia is not a canopy built to the standards of a mere workhorse, but to the impossibly high standards of a modern competition canopy. With advanced panel shaping and the latest generation planform initiated with Petra, she is the most modern wing you can buy short of a full comp-specific sail fabric parachute. Her high ellipticity, optimized wing tips and signature Powerband nose make for a leading edge that simply slices through air.'),
(47, 'xxx', 'Petra is the arrival of a game-changing adjustment in the way we think about flying our parachutes. With a high roll rate, a long recovery arc and high maximal glide ratio, Petra delivers unrivalled power in the turn, plane out and flare. Combined with a highly elliptical planform and very high sweep, a record-breaking wing is born.'),
(48, 'xxx', 'Ask anyone who has jumped a Pilot and they will tell you the openings are the best you can get, it is fun to fly and easy to land. Since its introduction the Pilot has charmed beginners and experienced jumpers alike. Whether your cup of tea is a conventional approach or a little more playful, the Pilot will surprise you with its stable flight, responsive turns and comfortable flare. This canopy can really do it all.'),
(49, 'xxx', 'Aerodyne’s hot 9-cell wing. A true high performance non-crossbraced canopy, aggressive and nimble with positive reliable on-heading openings at a reasonable 9-cell price. It was designed using Computational Fluid Dynamics (CFD) simulation software using sophisticated aerodynamic principles to create a versatile high performance aerofoil.'),
(50, 'xxx', 'The Smart reserve combines more than 30 year of experience in the parachute industry and incorporates the latest 7-cell technology. Thousands of real life cutaways and landings are testimony to the quick and reliable openings, the solid flight performance and the powerful landing flare.');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `image`) VALUES
(1, 'Performance Design', '/images/manufacturer/performance.jpg'),
(2, 'NZ Aerosport', '/images/manufacturers/nz.jpg'),
(3, 'Squirrel', '/images/manufacturers/squirrel.jpg'),
(4, 'Aerodyne', '/images/manufacturers/aerodyne.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name_i18n_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name_i18n_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `option_value`
--

CREATE TABLE `option_value` (
  `id` int(11) NOT NULL,
  `name_i18n_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option_value`
--

INSERT INTO `option_value` (`id`, `name_i18n_id`, `options_id`) VALUES
(1, 6, 1),
(2, 7, 1),
(3, 8, 1),
(4, 9, 1),
(5, 10, 1),
(6, 11, 1),
(7, 12, 1),
(8, 13, 1),
(9, 26, 1),
(10, 27, 1),
(11, 28, 1),
(12, 29, 1),
(13, 30, 1),
(14, 31, 1),
(15, 32, 1),
(16, 33, 1),
(17, 34, 1),
(18, 35, 1),
(19, 36, 1),
(20, 37, 1),
(21, 38, 1),
(22, 39, 1),
(23, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `billingfirstname` varchar(50) DEFAULT NULL,
  `billinglastname` varchar(50) DEFAULT NULL,
  `billingaddress_id` int(11) DEFAULT NULL,
  `deliveryfirstname` varchar(50) DEFAULT NULL,
  `deliverylastname` varchar(50) DEFAULT NULL,
  `deliveryaddress_id` int(11) DEFAULT NULL,
  `purchasedate` datetime DEFAULT NULL,
  `paymentmethod` tinyint(1) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `person_id`, `billingfirstname`, `billinglastname`, `billingaddress_id`, `deliveryfirstname`, `deliverylastname`, `deliveryaddress_id`, `purchasedate`, `paymentmethod`, `state`) VALUES
(1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 3, '2019-01-02 17:06:46', NULL, 1),
(3, 1, NULL, NULL, NULL, 'Andreas', 'Erb', 4, '2019-01-05 17:18:52', NULL, 1),
(4, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-09 16:41:31', NULL, 1),
(6, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:02:20', NULL, 1),
(7, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:03:35', NULL, 1),
(8, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:06:35', NULL, 1),
(9, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:08:18', NULL, 1),
(10, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:08:34', NULL, 1),
(11, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:08:53', NULL, 1),
(12, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:13:48', NULL, 1),
(13, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:19:46', NULL, 1),
(14, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:19:57', NULL, 1),
(15, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:21:56', NULL, 1),
(16, 2, NULL, NULL, NULL, 'regr', 'dsfgdfg', 5, '2019-01-10 18:34:08', NULL, 1),
(18, 1, NULL, NULL, NULL, 'Andreas', 'Erb', 4, '2019-01-11 14:14:30', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `address_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `resetpassword` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `firstname`, `lastname`, `username`, `email`, `birthdate`, `phone`, `passwordhash`, `address_id`, `role_id`, `lang`, `resetpassword`) VALUES
(1, 'Andreas', 'Erb', 'res13', 'andreas.erb@gmx.ch', '1993-11-13', '0041797951835', '$2y$10$CqX.Ipw8tiLSH8os21wcpOtshsiJJF4xrnuNafL6RYoZZCHhJJMP6', 1, 2, 'de', 0),
(2, 'Nik', 'Arm', 'nik', 'nik@nik.ch', '1994-05-25', '0041791234567', '$2y$10$KM9VWsN6O4m6iE/robealePEimKXL0NggwnR2ER9CMuMMUWyRRhjG', 2, 2, 'de', 0),
(3, 'Admin', 'Admin', 'admin', 'admin@parachute-webshop.ch', '1994-05-25', '0041791234567', '$2y$10$D67rb5RRJWMLDJWlQuLS3.nSW/jyx3LjtcrzaUzBTHL8IIcZOnhKq', 2, 2, 'de', 0),
(4, 'Hansi', 'Hintersee', 'hansi', 'hansi@hansi.ch', '2019-12-31', '0318620771', '$2y$10$wz8yCOY755pgxJFSKegd/.R6Sbs4EWjQ0WtXz0R496Pmq54n7xuUG', 6, 1, 'de', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description_i18n_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pname`, `price`, `description_i18n_id`, `image`, `category_id`, `manufacturer_id`) VALUES
(1, 'Katana', '2350.00', 14, 'img/products/katana.jpg', 2, 1),
(2, 'Pulse', '2320.00', 15, 'img/products/pulse.jpg', 2, 1),
(3, 'Sabre2', '2330.00', 16, 'img/products/sabre2.jpg', 2, 1),
(4, 'Velocity', '3025.00', 17, 'img/products/velocity.jpg', 2, 1),
(5, 'Optimum', '1730.00', 18, 'img/products/optimum.jpg', 3, 1),
(6, 'PD Reserve', '1403.00', 19, 'img/products/reserve.jpg', 3, 1),
(7, 'Proxy', '2090.00', 20, 'img/products/proxy.jpg', 4, 1),
(8, 'Safire 3', '2350.00', 21, 'img/products/safire.jpg', 2, 2),
(9, 'Crossfire 3', '2540.00', 22, 'img/products/crossfire.jpg', 2, 2),
(10, 'Hayduke', '2390.00', 23, 'img/products/hayduke.jpg', 4, 3),
(11, 'Outlaw', '2350.00', 24, 'img/products/outlaw.jpg', 4, 3),
(12, 'Epiciene Pro', '2190.00', 25, 'img/products/epicene.jpg', 2, 3),
(13, 'Spectre', '2230.00', 42, 'img/products/spectre.jpg', 2, 1),
(14, 'Storm', '2230.00', 43, 'img/products/storm.jpg', 2, 1),
(15, 'Valkyrie', '3445.00', 44, 'img/products/valkyrie.jpg', 2, 1),
(16, 'JVX ', '2930.00', 45, 'img/products/jvx.jpg', 2, 2),
(17, 'Leia', '3630.00', 46, 'img/products/leia.jpg', 2, 2),
(18, 'Petra', '3750.00', 47, 'img/products/petra.jpg', 2, 2),
(19, 'Pilot', '2285.00', 48, 'img/products/pilot.jpg', 2, 4),
(20, 'Zulu', '2335.00', 49, 'img/products/zulu.jpg', 2, 4),
(21, 'Smart', '1350.00', 50, 'img/products/smart.jpg', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_value`
--

CREATE TABLE `product_option_value` (
  `product_id` int(11) NOT NULL,
  `optionvalue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_value`
--

INSERT INTO `product_option_value` (`product_id`, `optionvalue_id`) VALUES
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(4, 8),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(7, 1),
(7, 20),
(7, 21),
(7, 22),
(7, 23),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(10, 1),
(10, 20),
(10, 21),
(10, 22),
(10, 23),
(11, 1),
(11, 20),
(11, 21),
(11, 22),
(11, 23),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 6),
(12, 7),
(12, 8),
(12, 9),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(13, 7),
(13, 8),
(13, 9),
(13, 10),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(14, 9),
(14, 10),
(15, 10),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(15, 17),
(15, 18),
(15, 19),
(16, 10),
(16, 11),
(16, 12),
(16, 13),
(16, 14),
(16, 15),
(16, 16),
(16, 17),
(16, 18),
(16, 19),
(17, 10),
(17, 11),
(17, 12),
(17, 13),
(17, 14),
(17, 15),
(17, 16),
(17, 17),
(17, 18),
(17, 19),
(18, 10),
(18, 11),
(18, 12),
(18, 13),
(18, 14),
(18, 15),
(18, 16),
(18, 17),
(18, 18),
(18, 19),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(19, 6),
(19, 7),
(19, 8),
(19, 9),
(19, 10),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(20, 5),
(20, 6),
(20, 7),
(20, 8),
(20, 9),
(20, 10),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8),
(21, 9),
(21, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`id`, `orders_id`, `product_id`, `pname`, `price`, `quantity`) VALUES
(1, 1, 1, 'Katana', '2350.00', 2),
(2, 2, 1, 'Katana', '2350.00', 1),
(3, 2, 17, 'Leia', '3630.00', 1),
(4, 3, 2, 'Pulse', '2320.00', 4),
(5, 4, 1, 'Katana', '2350.00', 1),
(7, 6, 1, 'Katana', '2350.00', 2),
(8, 7, 1, 'Katana', '2350.00', 1),
(9, 8, 1, 'Katana', '2350.00', 1),
(11, 9, 1, 'Katana', '2350.00', 1),
(12, 10, 2, 'Pulse', '2320.00', 1),
(13, 11, 1, 'Katana', '2350.00', 1),
(14, 12, 1, 'Katana', '2350.00', 1),
(15, 13, 1, 'Katana', '2350.00', 1),
(16, 14, 1, 'Katana', '2350.00', 1),
(17, 15, 2, 'Pulse', '2320.00', 1),
(18, 16, 2, 'Pulse', '2320.00', 1),
(21, 18, 1, 'Katana', '2350.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_orders_option_value`
--

CREATE TABLE `product_orders_option_value` (
  `productorders_id` int(11) NOT NULL,
  `optionvalue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_orders_option_value`
--

INSERT INTO `product_orders_option_value` (`productorders_id`, `optionvalue_id`) VALUES
(1, 5),
(2, 5),
(3, 10),
(4, 1),
(5, 5),
(7, 5),
(8, 5),
(9, 5),
(11, 5),
(12, 1),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 1),
(18, 1),
(21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'client'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_foreign_key_country_id` (`country_id`),
  ADD KEY `address_foreign_key_city_id` (`city_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_foreign_key_category_id` (`category_id`),
  ADD KEY `category_foreign_key_name_i18n_id` (`name_i18n_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_foreign_key_name_i18n_id` (`name_i18n_id`);

--
-- Indexes for table `option_value`
--
ALTER TABLE `option_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_value_foreign_key_options_id` (`options_id`),
  ADD KEY `option_value_foreign_key_name_i18n_id` (`name_i18n_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_foreign_key_person_id` (`person_id`),
  ADD KEY `orders_foreign_key_billingaddress_id` (`billingaddress_id`),
  ADD KEY `orders_foreign_key_deliveryaddress_id` (`deliveryaddress_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `person_unique_email` (`email`),
  ADD UNIQUE KEY `person_unique_username` (`username`),
  ADD KEY `person_foreign_key_address_id` (`address_id`),
  ADD KEY `person_foreign_key_role_id` (`role_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_foreign_key_category_id` (`category_id`),
  ADD KEY `product_foreign_key_manufacturer_id` (`manufacturer_id`),
  ADD KEY `product_foreign_key_description_i18n_id` (`description_i18n_id`);

--
-- Indexes for table `product_option_value`
--
ALTER TABLE `product_option_value`
  ADD PRIMARY KEY (`product_id`,`optionvalue_id`),
  ADD KEY `product_option_value_foreign_key_optionvalue_id` (`optionvalue_id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_orders_foreign_key_orders_id` (`orders_id`),
  ADD KEY `product_orders_foreign_key_product_id` (`product_id`);

--
-- Indexes for table `product_orders_option_value`
--
ALTER TABLE `product_orders_option_value`
  ADD KEY `product_orders_option_value_foreign_key_product_orders_id` (`productorders_id`),
  ADD KEY `product_orders_option_value_foreign_key_optionvalue_id` (`optionvalue_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `option_value`
--
ALTER TABLE `option_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_foreign_key_city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `address_foreign_key_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_foreign_key_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `category_foreign_key_name_i18n_id` FOREIGN KEY (`name_i18n_id`) REFERENCES `i18n` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_foreign_key_name_i18n_id` FOREIGN KEY (`name_i18n_id`) REFERENCES `i18n` (`id`);

--
-- Constraints for table `option_value`
--
ALTER TABLE `option_value`
  ADD CONSTRAINT `option_value_foreign_key_name_i18n_id` FOREIGN KEY (`name_i18n_id`) REFERENCES `i18n` (`id`),
  ADD CONSTRAINT `option_value_foreign_key_options_id` FOREIGN KEY (`options_id`) REFERENCES `options` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_foreign_key_billingaddress_id` FOREIGN KEY (`billingaddress_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `orders_foreign_key_deliveryaddress_id` FOREIGN KEY (`deliveryaddress_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `orders_foreign_key_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_foreign_key_address_id` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `person_foreign_key_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_foreign_key_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_foreign_key_description_i18n_id` FOREIGN KEY (`description_i18n_id`) REFERENCES `i18n` (`id`),
  ADD CONSTRAINT `product_foreign_key_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`);

--
-- Constraints for table `product_option_value`
--
ALTER TABLE `product_option_value`
  ADD CONSTRAINT `product_option_value_foreign_key_optionvalue_id` FOREIGN KEY (`optionvalue_id`) REFERENCES `option_value` (`id`),
  ADD CONSTRAINT `product_option_value_foreign_key_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD CONSTRAINT `product_orders_foreign_key_orders_id` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_orders_foreign_key_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_orders_option_value`
--
ALTER TABLE `product_orders_option_value`
  ADD CONSTRAINT `product_orders_option_value_foreign_key_optionvalue_id` FOREIGN KEY (`optionvalue_id`) REFERENCES `option_value` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_orders_option_value_foreign_key_product_orders_id` FOREIGN KEY (`productorders_id`) REFERENCES `product_orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
