/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.5.28 : Database - bydigitalv3
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bydigitalv3` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `bydigitalv3`;

/*Table structure for table `tg001_tpcliente` */

DROP TABLE IF EXISTS `tg001_tpcliente`;

CREATE TABLE `tg001_tpcliente` (
  `co_tpcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nb_tpcliente` text COLLATE utf8_spanish_ci,
  `tp_precio` text COLLATE utf8_spanish_ci COMMENT 'tendra el nombre del campo del precio producto a usar',
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_tpcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg001_tpcliente` */

insert  into `tg001_tpcliente`(`co_tpcliente`,`nb_tpcliente`,`tp_precio`,`in_estatus`) values (1,'Precio 1','nu_precio1',1),(2,'Precio 2','nu_precio2',1),(3,'Precio 3','nu_precio3',1),(4,'Precio 4','nu_precio4',1);

/*Table structure for table `tg002_vendedor` */

DROP TABLE IF EXISTS `tg002_vendedor`;

CREATE TABLE `tg002_vendedor` (
  `co_vendedor` int(11) NOT NULL AUTO_INCREMENT,
  `co_usuario` int(11) NOT NULL,
  `nb_vendedor` text COLLATE utf8_spanish_ci,
  `nu_cedula` text COLLATE utf8_spanish_ci,
  `nu_telefono` text COLLATE utf8_spanish_ci,
  `nu_comision` int(11) DEFAULT NULL,
  `fe_ultima_session` datetime DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_vendedor`),
  KEY `tg002fk1_th001` (`co_usuario`),
  CONSTRAINT `tg002fk1_th001` FOREIGN KEY (`co_usuario`) REFERENCES `th001_usuario` (`co_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg002_vendedor` */

insert  into `tg002_vendedor`(`co_vendedor`,`co_usuario`,`nb_vendedor`,`nu_cedula`,`nu_telefono`,`nu_comision`,`fe_ultima_session`,`in_estatus`) values (1,2,'WEB-Bydigital','14851999','0212-8956325',10,NULL,1),(2,5,'Ernesto Gutierrez Hernandez','16852348','0234-5688997',15,NULL,1);

/*Table structure for table `tg0031_monedas` */

DROP TABLE IF EXISTS `tg0031_monedas`;

CREATE TABLE `tg0031_monedas` (
  `co_monedas` int(11) NOT NULL AUTO_INCREMENT,
  `nb_monedas` text COLLATE utf8_spanish_ci,
  `di_simbolo` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_monedas`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg0031_monedas` */

insert  into `tg0031_monedas`(`co_monedas`,`nb_monedas`,`di_simbolo`,`in_estatus`) values (1,'Dolar Estadounidense','US$',1),(2,'Dolar Australiano','A$',1),(3,'Dolar Canadiense','C$',1),(4,'Peso Colombiano','COL$',1),(5,'Euro','€',1),(6,'Yen','¥',1),(7,'Peso Mexicano','MXN$',1),(8,'Bolivar Fuerte','BsF',1);

/*Table structure for table `tg003_cuentas` */

DROP TABLE IF EXISTS `tg003_cuentas`;

CREATE TABLE `tg003_cuentas` (
  `co_cuentas` int(11) NOT NULL AUTO_INCREMENT,
  `tp_cuentas` text COLLATE utf8_spanish_ci,
  `tx_banco` text COLLATE utf8_spanish_ci,
  `nu_cuenta` text COLLATE utf8_spanish_ci,
  `in_activa` tinyint(1) DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_cuentas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg003_cuentas` */

insert  into `tg003_cuentas`(`co_cuentas`,`tp_cuentas`,`tx_banco`,`nu_cuenta`,`in_activa`,`in_estatus`) values (1,'Corriente','Banco Venezuela','0102-5968-6555-21456983',1,1),(2,'Ahorro','Banco del Tesoro','0201-5968-5974-23569874',1,1),(3,'Corriente','Banco Provincial','0114-5896-5478-25631478',0,1),(4,'Global','Banesco','1254-8965-698532147859',0,1);

/*Table structure for table `tg004_configuracion` */

DROP TABLE IF EXISTS `tg004_configuracion`;

CREATE TABLE `tg004_configuracion` (
  `co_configuracion` int(11) NOT NULL AUTO_INCREMENT,
  `tx_titulo_tienda` text COLLATE utf8_spanish_ci,
  `tx_nombre_empresa` text COLLATE utf8_spanish_ci,
  `tx_rif` text COLLATE utf8_spanish_ci,
  `tx_pie` text COLLATE utf8_spanish_ci,
  `tx_logo` text COLLATE utf8_spanish_ci,
  `in_nuevos_clientes` tinyint(1) DEFAULT NULL,
  `tx_formato` text COLLATE utf8_spanish_ci,
  `co_tpcliente` int(11) NOT NULL,
  `co_vendedor` int(11) NOT NULL,
  `co_monedas` int(11) DEFAULT NULL,
  `in_generar_clave` tinyint(1) DEFAULT NULL,
  `in_usuarios_anonimos` tinyint(1) DEFAULT NULL,
  `nu_mostrar_precios` int(11) DEFAULT NULL,
  `nu_mostrar_cantidad` int(11) DEFAULT NULL,
  `nu_cantidad_stock` int(11) DEFAULT NULL,
  `tx_etiqueta_cero` text COLLATE utf8_spanish_ci,
  `tx_etiqueta_critico` text COLLATE utf8_spanish_ci,
  `tx_etiqueta_superior` text COLLATE utf8_spanish_ci,
  `in_destacados` tinyint(1) DEFAULT NULL,
  `in_stock_cero` tinyint(4) DEFAULT NULL,
  `nu_destacados` int(11) DEFAULT NULL,
  `nu_imagenes_pro` int(11) DEFAULT NULL,
  `nu_productos_pag` int(11) DEFAULT NULL,
  `in_categorias` tinyint(1) DEFAULT NULL,
  `tx_categorias` text COLLATE utf8_spanish_ci,
  `in_lineas` tinyint(1) DEFAULT NULL,
  `tx_lineas` text COLLATE utf8_spanish_ci,
  `in_sublineas` tinyint(1) DEFAULT NULL,
  `tx_sublineas` text COLLATE utf8_spanish_ci,
  `tx_correo_pedidos` text COLLATE utf8_spanish_ci,
  `tx_formato_pedido` text COLLATE utf8_spanish_ci,
  `tx_vencimiento` int(11) DEFAULT NULL,
  `tx_condicion_pago` text COLLATE utf8_spanish_ci,
  `in_img_productocarrito` tinyint(1) DEFAULT NULL,
  `in_iva` tinyint(1) DEFAULT NULL,
  `tx_iva` text COLLATE utf8_spanish_ci,
  `in_deposito` tinyint(1) DEFAULT NULL,
  `in_credito` tinyint(1) DEFAULT NULL,
  `tx_titular` text COLLATE utf8_spanish_ci,
  `tx_direccion` text COLLATE utf8_spanish_ci,
  `tx_telefono` text COLLATE utf8_spanish_ci,
  `tx_correo_contacto` text COLLATE utf8_spanish_ci,
  `in_mapa` tinyint(1) DEFAULT NULL,
  `tx_coordenadas` text COLLATE utf8_spanish_ci,
  `tx_contenidos` text COLLATE utf8_spanish_ci,
  `in_publicidad` tinyint(1) DEFAULT NULL,
  `tx_imgpublicidad` text COLLATE utf8_spanish_ci,
  `tx_linkpublicidad` text COLLATE utf8_spanish_ci,
  `tx_imgpublicidad2` text COLLATE utf8_spanish_ci,
  `tx_linkpublicidad2` text COLLATE utf8_spanish_ci,
  `tx_imgpublicidad3` text COLLATE utf8_spanish_ci,
  `tx_linkpublicidad3` text COLLATE utf8_spanish_ci,
  `tx_img1` text COLLATE utf8_spanish_ci,
  `tx_link1` text COLLATE utf8_spanish_ci,
  `tx_tbanner1` text COLLATE utf8_spanish_ci,
  `tx_img2` text COLLATE utf8_spanish_ci,
  `tx_link2` text COLLATE utf8_spanish_ci,
  `tx_tbanner2` text COLLATE utf8_spanish_ci,
  `tx_img3` text COLLATE utf8_spanish_ci,
  `tx_link3` text COLLATE utf8_spanish_ci,
  `tx_tbanner3` text COLLATE utf8_spanish_ci,
  `nu_categorias` int(11) DEFAULT NULL,
  `co_cat1` int(11) DEFAULT NULL,
  `tx_imgcat1` text COLLATE utf8_spanish_ci,
  `tx_descat1` text COLLATE utf8_spanish_ci,
  `co_cat2` int(11) DEFAULT NULL,
  `tx_imgcat2` text COLLATE utf8_spanish_ci,
  `tx_descat2` text COLLATE utf8_spanish_ci,
  `co_cat3` int(11) DEFAULT NULL,
  `tx_imgcat3` text COLLATE utf8_spanish_ci,
  `tx_descat3` text COLLATE utf8_spanish_ci,
  `co_cat4` int(11) DEFAULT NULL,
  `tx_imgcat4` text COLLATE utf8_spanish_ci,
  `tx_descat4` text COLLATE utf8_spanish_ci,
  `co_cat5` int(11) DEFAULT NULL,
  `tx_imgcat5` text COLLATE utf8_spanish_ci,
  `tx_descat5` text COLLATE utf8_spanish_ci,
  `co_cat6` int(11) DEFAULT NULL,
  `tx_imgcat6` text COLLATE utf8_spanish_ci,
  `tx_descat6` text COLLATE utf8_spanish_ci,
  KEY `tg004fk1_tg001` (`co_tpcliente`),
  KEY `tg004fk2_tg002` (`co_vendedor`),
  KEY `co_configuracion` (`co_configuracion`),
  KEY `tg004fk3_tg0031` (`co_monedas`),
  CONSTRAINT `tg004fk1_tg001` FOREIGN KEY (`co_tpcliente`) REFERENCES `tg001_tpcliente` (`co_tpcliente`) ON UPDATE CASCADE,
  CONSTRAINT `tg004fk2_tg002` FOREIGN KEY (`co_vendedor`) REFERENCES `tg002_vendedor` (`co_vendedor`) ON UPDATE CASCADE,
  CONSTRAINT `tg004fk3_tg0031` FOREIGN KEY (`co_monedas`) REFERENCES `tg0031_monedas` (`co_monedas`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg004_configuracion` */

insert  into `tg004_configuracion`(`co_configuracion`,`tx_titulo_tienda`,`tx_nombre_empresa`,`tx_rif`,`tx_pie`,`tx_logo`,`in_nuevos_clientes`,`tx_formato`,`co_tpcliente`,`co_vendedor`,`co_monedas`,`in_generar_clave`,`in_usuarios_anonimos`,`nu_mostrar_precios`,`nu_mostrar_cantidad`,`nu_cantidad_stock`,`tx_etiqueta_cero`,`tx_etiqueta_critico`,`tx_etiqueta_superior`,`in_destacados`,`in_stock_cero`,`nu_destacados`,`nu_imagenes_pro`,`nu_productos_pag`,`in_categorias`,`tx_categorias`,`in_lineas`,`tx_lineas`,`in_sublineas`,`tx_sublineas`,`tx_correo_pedidos`,`tx_formato_pedido`,`tx_vencimiento`,`tx_condicion_pago`,`in_img_productocarrito`,`in_iva`,`tx_iva`,`in_deposito`,`in_credito`,`tx_titular`,`tx_direccion`,`tx_telefono`,`tx_correo_contacto`,`in_mapa`,`tx_coordenadas`,`tx_contenidos`,`in_publicidad`,`tx_imgpublicidad`,`tx_linkpublicidad`,`tx_imgpublicidad2`,`tx_linkpublicidad2`,`tx_imgpublicidad3`,`tx_linkpublicidad3`,`tx_img1`,`tx_link1`,`tx_tbanner1`,`tx_img2`,`tx_link2`,`tx_tbanner2`,`tx_img3`,`tx_link3`,`tx_tbanner3`,`nu_categorias`,`co_cat1`,`tx_imgcat1`,`tx_descat1`,`co_cat2`,`tx_imgcat2`,`tx_descat2`,`co_cat3`,`tx_imgcat3`,`tx_descat3`,`co_cat4`,`tx_imgcat4`,`tx_descat4`,`co_cat5`,`tx_imgcat5`,`tx_descat5`,`co_cat6`,`tx_imgcat6`,`tx_descat6`) values (1,'Bydigital v3.0.1','Sos DiseÃ±o 2014','J-40372119-0','La mejor tienda web para usted','logo.jpg',1,'WEB-000000',2,1,8,1,1,1,1,50,'Agotados','Agotandose','Disponibles',1,1,15,10,12,1,'CategorÃ­a',1,'LÃ­nea',1,'Sub-Linea','correo@bydigital.com','ABCDE-00000',4,'1',1,1,'13',1,0,'bydigitalv2','San Antonio de los Altos','0212-3737373','atencion@bydigital.com',1,'10.496369, -66.881890','<div></div><div id=\"lipsum\">\r\n<p>\r\n<b><i>Lorem ipsum dolor sit amet,</i></b> consectetur adipiscing elit. Morbi molestie \r\nnulla ac tellus tempor, id auctor enim vehicula. Nam lacinia consequat \r\neleifend. Pellentesque velit metus, dignissim eget fringilla in, \r\ntristique ut sem. <font color=\"#df006f\">Vestibulum elit sapien, volutpat ac tristique et, \r\naccumsan id justo</font>. Nunc a fermentum leo. Nullam at massa sit amet neque \r\ncommodo lacinia. In fringilla, mi sit amet ornare condimentum, lectus \r\ndui condimentum purus, ut laoreet eros odio quis est. Duis vulputate \r\nlorem nec vestibulum dictum. Fusce et quam lectus. Mauris consectetur \r\nlobortis mauris, ultricies accumsan nunc. Curabitur euismod luctus orci \r\nac hendrerit. Suspendisse potenti. Ut non lorem id justo tincidunt \r\nviverra. Aenean ac cursus est. Maecenas bibendum tempor lorem, sit amet \r\nvestibulum enim vestibulum ac. Proin mollis aliquam orci vitae sodales.\r\n</p>\r\n<p>\r\nCras eget laoreet eros, nec molestie ligula. Nunc elementum neque magna,\r\n vel aliquam est bibendum ac. In quis euismod eros, sed consectetur est.\r\n Nam a varius mi. Vestibulum quis sem venenatis, fringilla ligula ac, \r\nefficitur est. Sed quis tortor ac sapien posuere tempor. Praesent \r\nconvallis non lacus non ornare. Sed mollis ipsum nec tellus gravida \r\nmollis. Ut scelerisque, libero ac dictum rhoncus, dolor dolor porttitor \r\nnunc, id malesuada ante risus vitae magna. Sed dapibus odio non est \r\nfermentum laoreet. Morbi nec molestie mauris.\r\n</p>\r\n<p>\r\nPellentesque vel massa<u> finibus, pretium nisi quis</u>, porttitor magna. Sed \r\nvitae metus at ante iaculis pharetra eu sit amet est. Ut pellentesque \r\nipsum gravida dui dictum sollicitudin. Sed feugiat sagittis ligula, \r\nvulputate sodales magna. Vestibulum dignissim luctus diam sed rhoncus. \r\nProin ac varius ex. Mauris faucibus eu nisi vitae efficitur. Ut bibendum\r\n libero vitae cursus scelerisque. Nam scelerisque odio quis leo \r\nconsequat, non bibendum velit malesuada. Integer ornare dolor sed \r\nhendrerit auctor. Nullam bibendum, lacus in blandit volutpat, nisi elit \r\nsagittis odio, sit amet ultrices mauris dolor id neque. Proin pulvinar \r\nmagna eget leo maximus suscipit. Phasellus ornare est erat, eget maximus\r\n enim iaculis id. Pellentesque ut libero non massa euismod efficitur ut \r\neu turpis. Morbi ornare odio id neque fermentum, sed pellentesque libero\r\n rhoncus.\r\n</p>\r\n<p>\r\nEtiam mattis, quam non gravida tempus, mauris tortor vestibulum mauris, \r\neget molestie massa nulla vel arcu. Nunc id fermentum augue. Suspendisse\r\n sagittis neque quis tincidunt aliquet. Pellentesque eu urna et mauris \r\nvarius sagittis vel at quam. Nullam convallis consequat justo eu \r\nvenenatis. Nunc semper sit amet sem in placerat. Praesent iaculis sapien\r\n at dui venenatis sollicitudin. Maecenas porta vehicula elit, quis \r\nsollicitudin dui aliquam bibendum. Ut ullamcorper sollicitudin leo, eu \r\ncondimentum eros auctor a. Vestibulum quis euismod nisl, vitae aliquet \r\nnulla. Aenean lacinia, metus blandit imperdiet congue, nibh sem \r\ndignissim enim, et lacinia augue nisl sed sapien. Praesent ut sem et \r\nturpis dictum pulvinar.\r\n</p></div><h4><strike><i><b></b></i></strike></h4>',1,'publicidad.jpg','http://www.amazon.com/','banner_superior1.jpg','http://www.optimusds.disenosos.com/','banner_superior2.jpg','http://www.disenosos.com/','banner1.jpg','#','Texto ejemplo','banner2.jpg','#','Texto ejemplo','banner3.jpg','#','Texto ejemplo',6,17,'cat1.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.',13,'cat2.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.',12,'cat3.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.',14,'cat4.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.',18,'cat5.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.',15,'cat6.jpg','DescripciÃ³n pequeÃ±a de esta categoria o subcategoria seleccionada.');

/*Table structure for table `tg005_clientes` */

DROP TABLE IF EXISTS `tg005_clientes`;

CREATE TABLE `tg005_clientes` (
  `co_clientes` int(11) NOT NULL AUTO_INCREMENT,
  `co_tpcliente` int(11) NOT NULL,
  `co_usuario` int(11) NOT NULL,
  `nb_clientes` text COLLATE utf8_spanish_ci,
  `nu_rif_cedula` text COLLATE utf8_spanish_ci,
  `nu_telefono` text COLLATE utf8_spanish_ci,
  `fe_registro` datetime DEFAULT NULL,
  `fe_ultima_session` datetime DEFAULT NULL,
  `tx_direccion_fiscal` text COLLATE utf8_spanish_ci,
  `tx_direccion_entrega` text COLLATE utf8_spanish_ci,
  `in_activa` tinyint(1) DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_clientes`),
  KEY `tg005fk1_tg001` (`co_tpcliente`),
  KEY `tg005fk2_th001` (`co_usuario`),
  CONSTRAINT `tg005fk1_tg001` FOREIGN KEY (`co_tpcliente`) REFERENCES `tg001_tpcliente` (`co_tpcliente`) ON UPDATE CASCADE,
  CONSTRAINT `tg005fk2_th001` FOREIGN KEY (`co_usuario`) REFERENCES `th001_usuario` (`co_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg005_clientes` */

insert  into `tg005_clientes`(`co_clientes`,`co_tpcliente`,`co_usuario`,`nb_clientes`,`nu_rif_cedula`,`nu_telefono`,`fe_registro`,`fe_ultima_session`,`tx_direccion_fiscal`,`tx_direccion_entrega`,`in_activa`,`in_estatus`) values (1,1,1,'Administrador',NULL,NULL,NULL,NULL,NULL,NULL,1,1),(2,2,4,'Danny Lopez','V-14851053','(0416)915.34.45','2015-03-03 11:02:40','2016-06-10 11:33:53','Los Teques Estado Miranda','Los Teques Estado Miranda',1,1),(3,1,3,'Dominguez pedros','1958999','0241-2569899','2015-03-03 11:07:04','2016-08-09 11:28:24','caracas venezuela','caracas venezuela',1,1),(4,2,6,'junior mouawad','V-19044542','(0212)941.12.90','2015-04-06 15:10:25','2015-04-06 15:11:36','Calle Bolivar Edifcio Quenetyl Baruta','Calle Bolivar Edifcio Quenetyl Baruta',1,1);

/*Table structure for table `tg006_condicion_pago` */

DROP TABLE IF EXISTS `tg006_condicion_pago`;

CREATE TABLE `tg006_condicion_pago` (
  `co_condicion_pago` int(11) NOT NULL AUTO_INCREMENT,
  `nb_condicion_pago` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_condicion_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg006_condicion_pago` */

insert  into `tg006_condicion_pago`(`co_condicion_pago`,`nb_condicion_pago`,`in_estatus`) values (1,'Contado',1),(15,'Credito a 15 Dias',1),(30,'Credito a 30 Días',1),(45,'Credito a 45 Días',1),(60,'Credito a 60 Días',1),(90,'Credito a 90 Días',1);

/*Table structure for table `tg007_categoria` */

DROP TABLE IF EXISTS `tg007_categoria`;

CREATE TABLE `tg007_categoria` (
  `co_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nb_categoria` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg007_categoria` */

insert  into `tg007_categoria`(`co_categoria`,`nb_categoria`,`in_estatus`) values (1,'Celulares',1),(2,'Calzado',1),(3,'ComputaciÃ³n',1),(4,'Software',1),(5,'Vestimenta',1),(6,'Belleza',1),(7,'Deporte',1);

/*Table structure for table `tg008_linea` */

DROP TABLE IF EXISTS `tg008_linea`;

CREATE TABLE `tg008_linea` (
  `co_linea` int(11) NOT NULL AUTO_INCREMENT,
  `co_categoria` int(11) NOT NULL,
  `nb_linea` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_linea`),
  KEY `tg008fk1_tg007` (`co_categoria`),
  CONSTRAINT `tg008fk1_tg007` FOREIGN KEY (`co_categoria`) REFERENCES `tg007_categoria` (`co_categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg008_linea` */

insert  into `tg008_linea`(`co_linea`,`co_categoria`,`nb_linea`,`in_estatus`) values (7,1,'Accesorios',1),(8,1,'Equipos',1),(9,1,'Forros',1),(10,1,'Baterias',1),(11,2,'Deportivo',1),(12,2,'Casual',1),(13,2,'Playa',1),(17,3,'Memoria ram',1),(18,3,'Disco Duro',1),(19,3,'Case',1),(20,3,'Dispositivos Perfifericos',1),(21,3,'Laptop',1),(23,7,'Baseball',1),(24,7,'Basketball',1),(25,7,'Natacion',1),(26,4,'Juegos',1),(27,4,'Sistema Operativo',1),(28,4,'Educacion',1),(29,5,'Femenino',1),(30,5,'Masculino',1),(31,3,'PC',1),(32,6,'Maquillaje',1),(33,6,'Cremas',1);

/*Table structure for table `tg009_sublineas` */

DROP TABLE IF EXISTS `tg009_sublineas`;

CREATE TABLE `tg009_sublineas` (
  `co_sublineas` int(11) NOT NULL AUTO_INCREMENT,
  `co_linea` int(11) NOT NULL,
  `nb_sublineas` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_sublineas`),
  KEY `tg009fk1_tg008` (`co_linea`),
  CONSTRAINT `tg009fk1_tg008` FOREIGN KEY (`co_linea`) REFERENCES `tg008_linea` (`co_linea`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg009_sublineas` */

insert  into `tg009_sublineas`(`co_sublineas`,`co_linea`,`nb_sublineas`,`in_estatus`) values (16,21,'Lector DVD',1),(17,21,'Lector Blue-Ray',1),(18,21,'Motherboard',1),(19,23,'Guante',1),(20,23,'Pelota',1),(21,23,'Bate',1),(22,24,'Pelota',1),(23,24,'Soporte de Rodilla',1),(24,10,'1000ma',1),(26,10,'2000ma',1),(27,10,'2500ma',1),(28,10,'3000ma',1),(29,19,'ATX',1),(30,19,'Mini-ATX',1),(31,12,'Cuero',1),(32,12,'Semi-Cuero',1),(33,11,'Goma',1),(34,11,'Cuero',1),(35,12,'Gamusa',1),(36,20,'Wi-Fi',1),(37,20,'Bluetooth',1),(38,28,'Microsoft',1),(39,28,'Discovery',1),(40,28,'Nickelodeon',1),(41,8,'HTC',1),(42,8,'Apple',1),(43,8,'Samsung',1),(44,8,'Sony',1),(45,8,'LG',1),(46,29,'Faldas',1),(47,29,'Blusas',1),(48,29,'Ropa Intima',1),(49,9,'HTC',1),(50,9,'LG',1),(51,9,'Samsung',1),(52,26,'Microsoft',1),(53,26,'Nickelodeon',1),(54,26,'Steam',1),(55,30,'Jeans',1),(56,30,'Franela',1),(57,30,'Shorts',1),(58,17,'Kingston',1),(59,17,'Asus',1),(60,17,'Corsair',1),(61,25,'Lentes',1),(62,25,'Traje de baÃ±o',1),(63,25,'Gorros impermeables',1),(64,13,'Pantuflas',1),(65,27,'Windows',1),(66,27,'Apple',1),(67,27,'Linux',1);

/*Table structure for table `tg010_division` */

DROP TABLE IF EXISTS `tg010_division`;

CREATE TABLE `tg010_division` (
  `co_division` int(11) NOT NULL AUTO_INCREMENT,
  `co_sublineas` int(11) NOT NULL,
  `nb_division` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_division`),
  KEY `tg010fk1_tg009` (`co_sublineas`),
  CONSTRAINT `tg010fk1_tg009` FOREIGN KEY (`co_sublineas`) REFERENCES `tg009_sublineas` (`co_sublineas`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg010_division` */

insert  into `tg010_division`(`co_division`,`co_sublineas`,`nb_division`,`in_estatus`) values (4,24,'Samsung',1),(5,24,'HTC',1),(6,24,'Huawei',1),(7,26,'Samsung',1),(8,26,'HTC',1),(9,27,'Samsung',1),(10,27,'HTC',1),(11,28,'Samsung',1),(12,28,'HTC',1),(13,42,'Imac',1),(14,42,'Ipad',1),(15,42,'TV',1),(16,66,'Yosemite',1),(17,59,'1Gb',1),(18,59,'2Gb',1),(19,59,'4Gb',1),(20,29,'V1',1),(21,29,'V2',1),(22,21,'Tamanaco',1),(23,37,'Asus',1),(24,37,'AsRock',1),(25,47,'Zara',1),(26,47,'Maggy London',1),(27,47,'Roxy',1),(28,60,'1Gb',1),(29,60,'2Gb',1),(30,60,'4Gb',1),(31,60,'8Gb',1),(32,34,'Pegados',1),(33,34,'Cocidos',1),(34,31,'Volpe',1),(35,31,'Rush',1),(36,39,'12 a 15 aÃ±os',1),(37,39,'16 a 18 aÃ±os',1),(38,39,'18 aÃ±os en adelante',1),(39,46,'Anne Klein',1),(40,46,'Donna Morgan',1),(41,46,'Rachel Pally',1),(42,56,'Polos',1),(43,56,'Tommy Hilfiger',1),(44,35,'Pegados',1),(45,33,'Cocidos',1),(46,33,'Nike',1),(47,63,'Negro',1),(48,63,'Azul',1),(49,63,'Transparente',1),(50,19,'Tamanaco',1),(51,41,'Serie One',1),(52,41,'Serie Ases',1),(53,55,'Azul',1),(54,55,'Negro',1),(55,58,'4Gb',1),(56,58,'8Gb',1),(57,17,'Velocidad 16x',1),(58,17,'Velocidad 32x',1),(59,16,'Velocidad 16x',1),(60,16,'Velocidad 32x',1),(61,61,'Grandes',1),(62,61,'Medianos',1),(63,45,'Generacion L7',1),(64,45,'Generacion L3',1),(65,50,'Importados',1),(66,50,'Nacionales',1),(67,67,'10.1',1),(68,67,'12.2',1),(69,52,'PEGI 16',1),(70,52,'PEGI 18',1),(71,38,'PEGI 7',1),(72,38,'PEGI 3',1),(73,30,'v1',1),(74,30,'V2',1),(75,18,'Gamers',1),(76,18,'Hogar',1),(77,53,'PEGI 7',1),(78,40,'PEGI 12',1),(79,64,'Reef',1),(80,20,'Tamanaco',1),(81,22,'Lider',1),(82,48,'Hilos',1),(83,48,'Cacheteros',1),(84,43,'2Gb Ram',1),(85,43,'Dualcore',1),(86,51,'Importados',1),(87,51,'Nacionales',1),(88,32,'Pegados',1),(89,32,'Cocidos',1);

/*Table structure for table `tg011_division2` */

DROP TABLE IF EXISTS `tg011_division2`;

CREATE TABLE `tg011_division2` (
  `co_division2` int(11) NOT NULL AUTO_INCREMENT,
  `co_division` int(11) NOT NULL,
  `nb_division2` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_division2`),
  KEY `tg011fk1_tg010` (`co_division`),
  CONSTRAINT `tg011fk1_tg010` FOREIGN KEY (`co_division`) REFERENCES `tg010_division` (`co_division`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg011_division2` */

insert  into `tg011_division2`(`co_division2`,`co_division`,`nb_division2`,`in_estatus`) values (5,17,'Velocidad',1),(6,28,'Velocidad',1),(7,53,'Tallas',1),(8,54,'Tallas',1),(9,85,'Velocidad',1),(10,50,'TamaÃ±o',1),(11,45,'A Mano',1),(12,89,'A Mano',1),(13,32,'A Mano',1),(14,33,'A Mano',1),(15,36,'Aventura',1),(16,37,'Combate',1),(17,38,'RPMG',1),(18,39,'Cortas',1),(19,39,'Largas',1),(20,64,'NA',1),(21,63,'NA',1),(22,89,'Negros',1),(23,45,'Blancos',1),(24,13,'NA',1),(25,5,'NA',1),(26,40,'Largas',1),(27,40,'Cortas',1),(28,62,'Azules',1),(29,55,'NA',1),(30,56,'No aplica',1);

/*Table structure for table `tg012_division3` */

DROP TABLE IF EXISTS `tg012_division3`;

CREATE TABLE `tg012_division3` (
  `co_division3` int(11) NOT NULL AUTO_INCREMENT,
  `co_division2` int(11) NOT NULL,
  `nb_division3` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_division3`),
  KEY `tg012fk1_tg011` (`co_division2`),
  CONSTRAINT `tg012fk1_tg011` FOREIGN KEY (`co_division2`) REFERENCES `tg011_division2` (`co_division2`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg012_division3` */

insert  into `tg012_division3`(`co_division3`,`co_division2`,`nb_division3`,`in_estatus`) values (4,6,'666Gz',1),(5,10,'G',1),(6,7,'32',1),(7,7,'34',1),(8,9,'2.7Gz',1),(9,11,'NA',0),(10,12,'NA',1),(11,13,'NA',1),(12,14,'NA',1),(13,8,'42',1),(14,9,'3.7Gz',1),(15,15,'NA',1),(16,16,'NA',1),(17,17,'NA',1),(18,20,'NA',1),(19,21,'NA',1),(20,29,'NA',1),(21,30,'NA',1),(22,19,'NA',1),(23,18,'NA',1),(24,27,'NA',1);

/*Table structure for table `tg013_productos` */

DROP TABLE IF EXISTS `tg013_productos`;

CREATE TABLE `tg013_productos` (
  `co_productos` int(11) NOT NULL AUTO_INCREMENT,
  `co_categoria` int(11) NOT NULL,
  `co_linea` int(11) NOT NULL,
  `co_sublineas` int(11) NOT NULL,
  `co_division` int(11) NOT NULL,
  `co_division2` int(11) NOT NULL,
  `co_division3` int(11) NOT NULL,
  `nb_productos` text COLLATE utf8_spanish_ci,
  `tx_descripcion` text COLLATE utf8_spanish_ci,
  `tx_descripcion_web` text COLLATE utf8_spanish_ci COMMENT 'descripcion html',
  `nu_stock` int(11) DEFAULT NULL,
  `nu_precio1` decimal(10,2) DEFAULT NULL,
  `nu_precio2` decimal(10,2) DEFAULT NULL,
  `nu_precio3` decimal(10,2) DEFAULT NULL,
  `nu_precio4` decimal(10,2) DEFAULT NULL,
  `nu_precio5` decimal(10,2) DEFAULT NULL,
  `fe_ini_p5` date DEFAULT NULL,
  `fe_fin_p5` date DEFAULT NULL,
  `nu_hits` int(11) DEFAULT NULL COMMENT 'cantidad vendida el producto',
  `in_destacado` tinyint(1) DEFAULT NULL,
  `in_oferta` tinyint(1) DEFAULT NULL,
  `in_bloqueado` tinyint(1) DEFAULT NULL,
  `in_excento` tinyint(1) DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_productos`),
  KEY `tg011fk3_tg009` (`co_sublineas`),
  KEY `tg013fk1_tg007` (`co_categoria`),
  KEY `tg013fk2_tg008` (`co_linea`),
  KEY `tg013fk4_tg010` (`co_division`),
  KEY `tg013fk5_tg011` (`co_division2`),
  KEY `tg013fk6_tg012` (`co_division3`),
  CONSTRAINT `tg011fk3_tg009` FOREIGN KEY (`co_sublineas`) REFERENCES `tg009_sublineas` (`co_sublineas`) ON UPDATE CASCADE,
  CONSTRAINT `tg013fk1_tg007` FOREIGN KEY (`co_categoria`) REFERENCES `tg007_categoria` (`co_categoria`) ON UPDATE CASCADE,
  CONSTRAINT `tg013fk2_tg008` FOREIGN KEY (`co_linea`) REFERENCES `tg008_linea` (`co_linea`) ON UPDATE CASCADE,
  CONSTRAINT `tg013fk4_tg010` FOREIGN KEY (`co_division`) REFERENCES `tg010_division` (`co_division`) ON UPDATE CASCADE,
  CONSTRAINT `tg013fk5_tg011` FOREIGN KEY (`co_division2`) REFERENCES `tg011_division2` (`co_division2`) ON UPDATE CASCADE,
  CONSTRAINT `tg013fk6_tg012` FOREIGN KEY (`co_division3`) REFERENCES `tg012_division3` (`co_division3`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg013_productos` */

insert  into `tg013_productos`(`co_productos`,`co_categoria`,`co_linea`,`co_sublineas`,`co_division`,`co_division2`,`co_division3`,`nb_productos`,`tx_descripcion`,`tx_descripcion_web`,`nu_stock`,`nu_precio1`,`nu_precio2`,`nu_precio3`,`nu_precio4`,`nu_precio5`,`fe_ini_p5`,`fe_fin_p5`,`nu_hits`,`in_destacado`,`in_oferta`,`in_bloqueado`,`in_excento`,`in_estatus`) values (1,2,11,33,45,11,9,'Eternia','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,300,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,1,1,0,1,1),(2,2,11,33,45,11,9,'Scropt L2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ','The Corsair Gaming Series GS600 power supply is the ideal price-performance solution for building or upgrading a Gaming PC. A single +12V rail provides up to 48A of reliable, continuous power for multi-core gaming PCs with multiple graphics cards. The ultra-quiet, dual ball-bearing fan automatically adjusts its speed according to temperature, so it will never intrude on your music and games. Blue LEDs bathe the transparent fan blades in a cool glow. Not feeling blue? You can turn off the lighting with the press of a button.\r\n<h3>Corsair Gaming Series GS600 Features:</h3>\r\n<li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>\r\n<li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>\r\n<li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>\r\n<li>0.99 Active Power Factor Correction provides clean and reliable power</li>\r\n<li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>\r\n<li>Extra long fully-sleeved cables support full tower chassis</li>\r\n<li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>\r\n<li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>\r\n<li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>\r\n<li>MTBF: 100,000 hours</li>\r\n<li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>',50,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,1,0,0,1,1),(3,2,11,33,45,11,9,'Caller Spin','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,30,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,0,1,0,1,1),(4,2,11,33,45,11,9,'Tunder V2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,50,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,1,0,0,1,1),(5,2,11,33,45,11,9,'Caller spin 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,500,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,0,0,0,0,1),(6,2,11,33,45,11,9,'Firebow','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,430,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,0,0,0,0,1),(7,2,11,34,32,13,11,'Tunder','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,270,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,0,1,0,0,1),(8,2,11,34,33,14,12,'Vesta','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,270,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,1,0,0,0,1),(9,2,11,34,33,14,12,'Vesta V3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,270,'2800.00','2760.00','2540.00','2480.00','2400.00',NULL,NULL,0,0,0,0,0,1),(10,2,11,34,33,14,12,'Scropt','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,155,'1850.00','1830.00','1800.00','1750.00','1620.00',NULL,NULL,0,0,0,0,0,1),(11,2,11,34,33,14,12,'Fantas IV','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,50,'2450.00','2400.00','2350.00','2300.00','2100.00',NULL,NULL,0,0,0,0,1,1),(12,2,11,34,33,14,12,'Play U','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,30,'1850.00','1830.00','1800.00','1750.00','1620.00',NULL,NULL,0,0,0,0,1,1),(13,3,17,58,55,29,20,'Blaster 500','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,123,'4546.00','4000.00','3400.00','3200.00','1244.00',NULL,NULL,0,1,1,0,1,1),(14,3,17,58,56,30,21,'Blaster 500 V2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,29,'4500.00','3900.00','3400.00','3400.00','1000.00',NULL,NULL,0,0,0,0,1,1),(15,3,17,58,56,30,21,'Blaster 800','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,40,'4900.00','3000.00','2800.00','2500.00','2300.00',NULL,NULL,0,0,0,0,1,1),(16,3,17,58,55,29,20,'Blaster 800 V5','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,300,'4500.00','4250.00','4300.00','3320.00','1800.00',NULL,NULL,0,0,0,0,1,1),(17,4,28,39,36,15,15,'Cazadores 5','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,234,'5000.00','3000.00','2500.40','2000.00','1800.40',NULL,NULL,0,0,0,0,0,1),(18,5,29,46,39,19,22,'Falda Larga 392','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,123,'5000.00','4850.00','4567.00','3455.00','1275.00',NULL,NULL,0,0,1,0,0,1),(19,5,29,46,39,18,23,'Falda Corta AK','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,24,'5900.00','4544.00','4200.00','3320.00','1278.00',NULL,NULL,0,0,0,0,0,1),(20,4,28,39,37,16,16,'Figthers VI','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ','<div style=\"text-align: center;\"><span style=\"font-family: Verdana, Geneva; line-height: 1.42857143;\">hfkjashfkljh</span><u style=\"font-family: Verdana, Geneva; line-height: 1.42857143;\">sfsdafsd</u><strike style=\"font-family: Verdana, Geneva; line-height: 1.42857143;\"><u>asdfsdfasdfsdf</u>asdfsdaf<font color=\"#7fffff\">sdfsdaf<span style=\"background-color: rgb(111, 63, 255);\">sdfsdfaf</span></font></strike></div>',67,'6000.00','4544.00','4200.00','2000.00','1000.00',NULL,NULL,0,1,0,0,0,1),(21,4,28,39,37,16,16,'Figthers II','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,67,'5500.00','4544.00','4300.00','2000.00','1000.00',NULL,NULL,0,0,0,0,0,1),(22,4,28,39,37,16,16,'Figthers I','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,67,'5500.00','4544.00','4300.00','2000.00','1000.00',NULL,NULL,0,1,0,0,1,1),(23,4,28,39,37,16,16,'Figthers III','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,67,'5500.00','4544.00','4300.00','2000.00','1000.00',NULL,NULL,0,1,0,0,1,1),(24,4,28,39,37,16,16,'Figthers IV','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,67,'5500.00','4544.00','4300.00','2000.00','1000.00',NULL,NULL,0,0,0,0,1,1),(25,4,28,39,37,16,16,'Figthers V','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,67,'5500.00','4544.00','4300.00','2000.00','1000.00',NULL,NULL,0,0,1,0,1,1),(26,2,11,34,33,14,12,'Fantas I','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,50,'2450.00','2400.00','2350.00','2300.00','2100.00',NULL,NULL,0,0,1,0,0,1),(27,2,11,34,33,14,12,'Fantas II','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,50,'2450.00','2400.00','2350.00','2300.00','2100.00',NULL,NULL,0,1,0,0,0,1),(28,2,11,34,33,14,12,'Fantas III','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,50,'2450.00','2400.00','2350.00','2300.00','2100.00',NULL,NULL,0,0,0,0,0,1),(29,3,17,58,55,29,20,'Blaster 800 V1.1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,300,'5500.00','3340.00','4300.00','3320.00','1800.00',NULL,NULL,0,0,0,0,0,1),(30,3,17,58,55,29,20,'Blaster 800 V3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,300,'5350.00','3340.00','4300.00','3320.00','1800.00',NULL,NULL,0,0,0,0,0,1),(31,3,17,58,55,29,20,'Blaster 800 V4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,300,'5350.00','3340.00','4300.00','3320.00','1800.00',NULL,NULL,0,0,1,0,1,1),(32,3,17,58,56,30,21,'Blaster 500 V1.1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ','',29,'5350.00','3900.00','3400.00','3400.00','1000.00',NULL,NULL,0,1,0,0,1,1),(33,3,17,58,56,30,21,'Blaster 500 V3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ','',29,'5300.00','3900.00','3400.00','3400.00','1000.00',NULL,NULL,0,1,1,0,1,1),(34,3,17,58,55,29,20,'Blaster 500 VV','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse efficitur, est consequat tincidunt sagittis, nisl mi porttitor nunc, nec ornare nibh velit ut ipsum. Morbi vehicula varius egestas. Pellentesque ultrices ipsum non sapien vulputate consequat. Cras consequat nibh in est malesuada aliquet a at eros. Praesent facilisis mollis cursus. Vivamus odio ipsum, cursus eget nibh quis, ornare iaculis magna. Donec ultricies, dolor a volutpat pharetra, sapien augue accumsan nulla, et euismod neque risus sit amet orci. Aliquam erat volutpat. Vestibulum placerat vehicula nisi, vitae feugiat ante posuere sodales. ',NULL,123,'4546.00','3800.00','3400.00','3467.00','1244.00',NULL,NULL,0,1,0,0,1,1),(35,2,11,34,33,14,12,'Play Yerk','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,30,'1850.00','1830.00','1800.00','1750.00','1620.00',NULL,NULL,0,0,1,0,1,1),(36,2,11,34,33,14,12,'Play U2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consectetur egestas malesuada. Integer purus eros, ultricies at vehicula ac, lacinia sit amet dui. Donec venenatis, risus nec pellentesque dignissim, dolor est dictum turpis, at ultricies purus lorem at purus. Nullam dictum justo velit, eget finibus nisi commodo vitae. Vivamus pharetra eget elit nec tempus. Suspendisse eu lobortis nisl. In mi risus, eleifend eget leo ut, sodales rutrum nisl. ',NULL,30,'1850.00','1830.00','1800.00','1750.00','1620.00',NULL,NULL,0,0,0,0,0,1),(37,5,29,46,39,19,22,'Falda Larga AK','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,123,'5000.00','4800.00','4567.00','3455.00','1275.00',NULL,NULL,0,0,0,0,0,1),(38,5,29,46,39,19,22,'Falda Larga sky','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,123,'5000.00','4800.00','4567.00','3455.00','1275.00',NULL,NULL,0,0,1,0,0,1),(39,5,29,46,39,19,22,'Falda Larga Jasen','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,123,'5000.00','4800.00','4567.00','3455.00','1275.00',NULL,NULL,0,0,0,0,0,1),(40,5,29,46,39,19,22,'Falda Larga Octa','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum felis sit amet velit sodales auctor. Maecenas ornare ipsum eget turpis consequat, in congue erat iaculis. Curabitur vitae congue neque. Donec id nunc sed tortor condimentum volutpat eget vel ligula. Aliquam fringilla elit non est sagittis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat augue in purus imperdiet, at imperdiet urna malesuada. Etiam tempor ut dui eget tempor. Sed elementum lacus lectus, ut convallis nisi posuere tristique. Donec suscipit eu ante sed pulvinar. ',NULL,123,'5000.00','4800.00','4567.00','3455.00','1275.00',NULL,NULL,0,0,0,0,1,1);

/*Table structure for table `tg014_transporte` */

DROP TABLE IF EXISTS `tg014_transporte`;

CREATE TABLE `tg014_transporte` (
  `co_transporte` int(11) NOT NULL AUTO_INCREMENT,
  `nb_transporte` text COLLATE utf8_spanish_ci,
  `tx_descripcion` text COLLATE utf8_spanish_ci,
  `nu_telefono` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_transporte`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tg014_transporte` */

insert  into `tg014_transporte`(`co_transporte`,`nb_transporte`,`tx_descripcion`,`nu_telefono`,`in_estatus`) values (1,'Por el Cliente','El envio va por riesgo del cliente.','0212-8956325',1),(2,'MRW','Courier Nacional','0243-5788954',1),(3,'Carrera','dfsdfsdf','054646132132',1),(6,'Continente','Cualquiera','02125887444',1);

/*Table structure for table `th001_usuario` */

DROP TABLE IF EXISTS `th001_usuario`;

CREATE TABLE `th001_usuario` (
  `co_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `co_nivel_usuario` int(11) NOT NULL,
  `nb_usuario` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tx_clave` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `in_mconf` tinyint(1) DEFAULT NULL,
  `in_mcliente` tinyint(1) DEFAULT NULL,
  `in_mpedido` tinyint(1) DEFAULT NULL,
  `in_mvendedor` tinyint(1) DEFAULT NULL,
  `in_mclasifica` tinyint(1) DEFAULT NULL,
  `in_mbanca` tinyint(1) DEFAULT NULL,
  `in_transporte` tinyint(1) DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_usuario`),
  KEY `th001fk1_th002` (`co_nivel_usuario`),
  CONSTRAINT `th001fk1_th002` FOREIGN KEY (`co_nivel_usuario`) REFERENCES `th002_nivel_usuario` (`co_nivel_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `th001_usuario` */

insert  into `th001_usuario`(`co_usuario`,`co_nivel_usuario`,`nb_usuario`,`tx_clave`,`in_mconf`,`in_mcliente`,`in_mpedido`,`in_mvendedor`,`in_mclasifica`,`in_mbanca`,`in_transporte`,`in_estatus`) values (1,1,'admin','202cb962ac59075b964b07152d234b70',1,1,1,1,1,1,1,1),(2,3,'vendedor@vendedor.com','202cb962ac59075b964b07152d234b70',0,0,0,0,0,0,0,1),(3,2,'usuario@usuario.com','202cb962ac59075b964b07152d234b70',0,0,0,0,0,0,0,1),(4,2,'dannyrlopezh@gmail.com','202cb962ac59075b964b07152d234b70',0,0,0,0,0,0,0,1),(5,3,'vendedor3@gmail.com','202cb962ac59075b964b07152d234b70',0,0,0,0,0,0,0,1),(6,2,'mouawadjunior@gmail.com','55f577c2d393e5ecd475e7ab7df84b53',0,0,0,0,0,0,0,1),(7,2,'adjunior@gmail.com','d41d8cd98f00b204e9800998ecf8427e',0,0,0,0,0,0,0,1);

/*Table structure for table `th002_nivel_usuario` */

DROP TABLE IF EXISTS `th002_nivel_usuario`;

CREATE TABLE `th002_nivel_usuario` (
  `co_nivel_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nb_nivel` text COLLATE utf8_spanish_ci,
  `tx_descripcion` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `th002_nivel_usuario` */

insert  into `th002_nivel_usuario`(`co_nivel_usuario`,`nb_nivel`,`tx_descripcion`,`in_estatus`) values (1,'Administrador','Administrador',1),(2,'Cliente',NULL,1),(3,'Vendedor',NULL,1);

/*Table structure for table `tr001_pedidos` */

DROP TABLE IF EXISTS `tr001_pedidos`;

CREATE TABLE `tr001_pedidos` (
  `co_pedidos` int(11) NOT NULL AUTO_INCREMENT,
  `co_clientes` int(11) NOT NULL,
  `co_vendedor` int(11) NOT NULL,
  `co_condicion_pago` int(11) NOT NULL,
  `co_transporte` int(11) NOT NULL,
  `nu_pedido` text COLLATE utf8_spanish_ci COMMENT 'numero de pedido con codigo bydigital',
  `nu_total` decimal(10,2) DEFAULT NULL,
  `fe_fecha` datetime DEFAULT NULL,
  `nu_estatus` text COLLATE utf8_spanish_ci,
  `tx_iva` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_pedidos`),
  KEY `tr001fk1_tg005` (`co_clientes`),
  KEY `tr001fk2_tg002` (`co_vendedor`),
  KEY `tr001fk3_tg006` (`co_condicion_pago`),
  KEY `tr001fk4_tg014` (`co_transporte`),
  CONSTRAINT `tr001fk1_tg005` FOREIGN KEY (`co_clientes`) REFERENCES `tg005_clientes` (`co_clientes`) ON UPDATE CASCADE,
  CONSTRAINT `tr001fk2_tg002` FOREIGN KEY (`co_vendedor`) REFERENCES `tg002_vendedor` (`co_vendedor`) ON UPDATE CASCADE,
  CONSTRAINT `tr001fk3_tg006` FOREIGN KEY (`co_condicion_pago`) REFERENCES `tg006_condicion_pago` (`co_condicion_pago`) ON UPDATE CASCADE,
  CONSTRAINT `tr001fk4_tg014` FOREIGN KEY (`co_transporte`) REFERENCES `tg014_transporte` (`co_transporte`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tr001_pedidos` */

insert  into `tr001_pedidos`(`co_pedidos`,`co_clientes`,`co_vendedor`,`co_condicion_pago`,`co_transporte`,`nu_pedido`,`nu_total`,`fe_fecha`,`nu_estatus`,`tx_iva`,`in_estatus`) values (1,2,1,1,1,'PW00001','7643.32','2016-06-08 16:22:19','Por Procesar','13',1),(2,2,1,1,1,'PW00002','15896.84','2016-04-01 16:22:23','Procesado','13',1),(3,2,1,1,1,'PW00003','17337.59','2016-04-06 16:22:25','Por Procesar','13',1),(4,2,1,1,1,'PW00004','5593.50','2016-05-19 16:26:04','Procesado','13',1),(5,2,1,1,1,'PW00005','12068.40','2015-05-07 16:43:03','Sin Notificar Pago','13',0),(6,2,1,1,1,'PW00006','54240.00','2016-03-09 19:21:52','Por Procesar','13',1),(7,2,1,1,1,'PW00007','70286.00','2016-03-15 21:49:49','Sin Notificar Pago','13',0),(8,2,1,1,1,'PW00008','62376.00','2016-03-16 21:53:00','Procesado','13',1),(9,4,1,1,1,'PW00009','3118.80','2016-02-23 15:11:56','Sin Notificar Pago','13',0),(10,3,1,1,1,'ABCDE-00010','12656.00','2016-02-15 12:59:27','Sin Notificar Pago','13',0),(11,2,1,1,1,'ABCDE-00011','25863.44','2016-01-13 10:56:29','Por Procesar','13',1),(12,3,1,1,1,'ABCDE-00012','6328.00','2016-01-26 11:35:52','Sin Notificar Pago','13',0),(13,2,1,1,1,'ABCDE-00013','27374.25','2016-06-10 11:35:00','Por Procesar','13',1);

/*Table structure for table `tr002_reng_pedidos` */

DROP TABLE IF EXISTS `tr002_reng_pedidos`;

CREATE TABLE `tr002_reng_pedidos` (
  `co_reng_pedidos` int(11) NOT NULL AUTO_INCREMENT,
  `co_pedidos` int(11) NOT NULL,
  `co_productos` int(11) NOT NULL,
  `nu_cantidad` int(11) DEFAULT NULL COMMENT 'cantidad comprada',
  `nu_sub_total` decimal(10,2) DEFAULT NULL,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_reng_pedidos`),
  KEY `tr002fk1_tr001` (`co_pedidos`),
  KEY `tr002fk2_tr001` (`co_productos`),
  CONSTRAINT `tr002fk1_tr001` FOREIGN KEY (`co_pedidos`) REFERENCES `tr001_pedidos` (`co_pedidos`) ON UPDATE CASCADE,
  CONSTRAINT `tr002fk2_tr001` FOREIGN KEY (`co_productos`) REFERENCES `tg013_productos` (`co_productos`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tr002_reng_pedidos` */

insert  into `tr002_reng_pedidos`(`co_reng_pedidos`,`co_pedidos`,`co_productos`,`nu_cantidad`,`nu_sub_total`,`in_estatus`) values (1,1,4,1,'2760.00',1),(2,1,13,1,'1244.00',1),(3,1,2,1,'2760.00',1),(4,2,4,1,'2760.00',1),(5,2,13,1,'1244.00',1),(6,2,2,1,'2760.00',1),(7,2,8,1,'2760.00',1),(8,2,20,1,'4544.00',1),(9,3,4,1,'2760.00',1),(10,3,13,1,'1244.00',1),(11,3,2,1,'2760.00',1),(12,3,8,1,'2760.00',1),(13,3,20,1,'4544.00',1),(14,3,18,1,'1275.00',1),(15,4,1,1,'2400.00',1),(16,4,18,2,'2550.00',1),(17,5,8,1,'2760.00',1),(18,5,4,1,'2760.00',1),(19,5,2,1,'2760.00',1),(20,5,1,1,'2400.00',1),(21,6,3,20,'48000.00',1),(22,7,13,50,'62200.00',1),(23,8,4,20,'55200.00',1),(24,9,2,1,'2760.00',1),(25,10,2,2,'5600.00',1),(26,10,4,2,'5600.00',1),(27,11,2,2,'5520.00',1),(28,11,4,3,'8280.00',1),(29,11,22,2,'9088.00',1),(30,12,2,2,'5600.00',1),(31,13,13,3,'3732.00',1),(32,13,2,7,'19320.00',1),(33,13,18,3,'3825.00',1);

/*Table structure for table `tr003_pagos` */

DROP TABLE IF EXISTS `tr003_pagos`;

CREATE TABLE `tr003_pagos` (
  `co_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `co_pedidos` int(11) NOT NULL,
  `co_cuentas` int(11) DEFAULT NULL,
  `tp_pagos` int(11) DEFAULT NULL,
  `tx_banco` text COLLATE utf8_spanish_ci COMMENT 'nombre del banco de donde se deposito o transfirio',
  `tx_depositante` text COLLATE utf8_spanish_ci,
  `nu_monto` decimal(10,2) DEFAULT NULL,
  `fe_fecha` datetime DEFAULT NULL,
  `nu_transaccion` text COLLATE utf8_spanish_ci,
  `in_estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`co_pagos`),
  KEY `tr003fk1_tr001` (`co_pedidos`),
  CONSTRAINT `tr003fk1_tr001` FOREIGN KEY (`co_pedidos`) REFERENCES `tr001_pedidos` (`co_pedidos`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tr003_pagos` */

insert  into `tr003_pagos`(`co_pagos`,`co_pedidos`,`co_cuentas`,`tp_pagos`,`tx_banco`,`tx_depositante`,`nu_monto`,`fe_fecha`,`nu_transaccion`,`in_estatus`) values (1,1,1,1,'','daiana','1000.00','2015-03-26 19:25:51','74598374593759',1),(2,1,2,1,'','daiana','1000.00','2015-03-26 23:25:51','74598374593759',1),(3,1,1,1,'','daiana','5643.32','2015-03-26 19:28:38','45354345345',1),(4,2,1,2,'Banco Venezuela','daiana','15896.84','2015-03-26 19:34:47','74598374593759',1),(5,3,2,2,'Banesco','daiana','5000.00','2015-03-26 19:38:58','74598374593759',1),(6,6,1,1,'','daiana','15000.00','2015-03-26 22:18:39','74598374593759',1),(7,4,2,1,'','daiana','5593.50','2015-03-26 22:25:13','7459837459375935434',1),(8,11,1,2,'provincial','Yo','10000.00','2015-04-22 10:57:33','268478',1),(9,13,1,1,'','danny lopez','27374.25','2016-06-10 11:36:20','45646846846',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
