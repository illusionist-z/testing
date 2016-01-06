CREATE TABLE IF NOT EXISTS `bug` (
  `id` serial,
  `name` varchar(100) NOT NULL,
  `robot_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`robot_id`)
);

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id` serial,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `part` (
  `id` serial,
  `name` varchar(1020) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `purpose` (
  `id` serial,
  `name` varchar(100) NOT NULL,
  `robot_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`robot_id`)
);

CREATE TABLE IF NOT EXISTS `robot` (
  `id` serial,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `manufacturer_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`parent_id`),
  KEY (`manufacturer_id`)
);

CREATE TABLE IF NOT EXISTS `robot_part` (
  `robot_id` bigint unsigned NOT NULL,
  `part_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`robot_id`, `part_id`)
);

INSERT INTO `bug` (`id`,`name`,`robot_id`) VALUES (1,'a-0',10),(2,'b-0',80),(3,'c-0',18),(4,'d-0',127),(5,'e-0',53),(6,'f-0',94),(7,'g-0',134),(8,'h-0',156),(9,'i-0',127),(10,'j-0',45),(11,'k-0',41),(12,'l-0',51),(13,'m-0',68),(14,'n-0',4),(15,'o-0',144),(16,'p-0',23),(17,'q-0',34),(18,'r-0',146),(19,'s-0',55),(20,'t-0',39),(21,'u-0',66),(22,'v-0',33),(23,'w-0',44),(24,'x-0',74),(25,'y-0',89),(26,'z-0',46),(27,'a-1',67),(28,'b-1',150),(29,'c-1',29),(30,'d-1',50),(31,'e-1',133),(32,'f-1',151),(33,'g-1',122),(34,'h-1',158),(35,'i-1',158),(36,'j-1',167),(37,'k-1',194),(38,'l-1',169),(39,'m-1',81),(40,'n-1',18),(41,'o-1',143),(42,'p-1',5),(43,'q-1',110),(44,'r-1',48),(45,'s-1',13),(46,'t-1',79),(47,'u-1',34),(48,'v-1',47),(49,'w-1',23),(50,'x-1',175),(51,'y-1',74),(52,'z-1',27),(53,'a-2',114),(54,'b-2',139),(55,'c-2',200),(56,'d-2',109),(57,'e-2',3),(58,'f-2',19),(59,'g-2',29),(60,'h-2',116),(61,'i-2',22),(62,'j-2',29),(63,'k-2',63),(64,'l-2',70),(65,'m-2',51),(66,'n-2',103),(67,'o-2',12),(68,'p-2',60),(69,'q-2',104),(70,'r-2',54),(71,'s-2',149),(72,'t-2',2),(73,'u-2',96),(74,'v-2',53),(75,'w-2',93),(76,'x-2',158),(77,'y-2',175),(78,'z-2',167),(79,'a-3',39),(80,'b-3',33),(81,'c-3',64),(82,'d-3',167),(83,'e-3',14),(84,'f-3',73),(85,'g-3',190),(86,'h-3',45),(87,'i-3',131),(88,'j-3',89),(89,'k-3',143),(90,'l-3',198),(91,'m-3',158),(92,'n-3',191),(93,'o-3',21),(94,'p-3',197),(95,'q-3',84),(96,'r-3',77),(97,'s-3',42),(98,'t-3',102),(99,'u-3',34),(100,'v-3',134),(101,'w-3',46),(102,'x-3',39),(103,'y-3',129),(104,'z-3',174),(105,'a-4',136),(106,'b-4',79),(107,'c-4',190),(108,'d-4',177),(109,'e-4',29),(110,'f-4',199),(111,'g-4',91),(112,'h-4',108),(113,'i-4',76),(114,'j-4',129),(115,'k-4',28),(116,'l-4',195),(117,'m-4',57),(118,'n-4',59),(119,'o-4',25),(120,'p-4',85),(121,'q-4',99),(122,'r-4',31),(123,'s-4',75),(124,'t-4',43),(125,'u-4',188),(126,'v-4',77),(127,'w-4',10),(128,'x-4',155),(129,'y-4',198),(130,'z-4',41),(131,'a-5',72),(132,'b-5',174),(133,'c-5',144),(134,'d-5',52),(135,'e-5',80),(136,'f-5',162),(137,'g-5',20),(138,'h-5',47),(139,'i-5',2),(140,'j-5',22),(141,'k-5',57),(142,'l-5',9),(143,'m-5',107),(144,'n-5',99);

INSERT INTO `manufacturer` (`id`,`name`) VALUES (1,'a-0'),(2,'b-0'),(3,'c-0'),(4,'d-0'),(5,'e-0'),(6,'f-0'),(7,'g-0'),(8,'h-0'),(9,'i-0'),(10,'j-0'),(11,'k-0'),(12,'l-0'),(13,'m-0'),(14,'n-0'),(15,'o-0'),(16,'p-0'),(17,'q-0'),(18,'r-0'),(19,'s-0'),(20,'t-0'),(21,'u-0'),(22,'v-0'),(23,'w-0'),(24,'x-0'),(25,'y-0'),(26,'z-0'),(27,'a-1'),(28,'b-1'),(29,'c-1'),(30,'d-1'),(31,'e-1'),(32,'f-1'),(33,'g-1'),(34,'h-1'),(35,'i-1'),(36,'j-1'),(37,'k-1'),(38,'l-1'),(39,'m-1'),(40,'n-1'),(41,'o-1'),(42,'p-1'),(43,'q-1'),(44,'r-1'),(45,'s-1'),(46,'t-1'),(47,'u-1'),(48,'v-1'),(49,'w-1'),(50,'x-1'),(51,'y-1'),(52,'z-1'),(53,'a-2'),(54,'b-2'),(55,'c-2'),(56,'d-2'),(57,'e-2'),(58,'f-2'),(59,'g-2'),(60,'h-2'),(61,'i-2'),(62,'j-2'),(63,'k-2'),(64,'l-2'),(65,'m-2'),(66,'n-2'),(67,'o-2'),(68,'p-2'),(69,'q-2'),(70,'r-2'),(71,'s-2'),(72,'t-2'),(73,'u-2'),(74,'v-2'),(75,'w-2'),(76,'x-2'),(77,'y-2'),(78,'z-2'),(79,'a-3'),(80,'b-3'),(81,'c-3'),(82,'d-3'),(83,'e-3'),(84,'f-3'),(85,'g-3'),(86,'h-3'),(87,'i-3'),(88,'j-3'),(89,'k-3'),(90,'l-3'),(91,'m-3'),(92,'n-3'),(93,'o-3'),(94,'p-3'),(95,'q-3'),(96,'r-3'),(97,'s-3'),(98,'t-3'),(99,'u-3'),(100,'v-3');

INSERT INTO `part` (`id`,`name`) VALUES (1,'a-0'),(2,'b-0'),(3,'c-0'),(4,'d-0'),(5,'e-0'),(6,'f-0'),(7,'g-0'),(8,'h-0'),(9,'i-0'),(10,'j-0'),(11,'k-0'),(12,'l-0'),(13,'m-0'),(14,'n-0'),(15,'o-0'),(16,'p-0'),(17,'q-0'),(18,'r-0'),(19,'s-0'),(20,'t-0'),(21,'u-0'),(22,'v-0'),(23,'w-0'),(24,'x-0'),(25,'y-0'),(26,'z-0'),(27,'a-1'),(28,'b-1'),(29,'c-1'),(30,'d-1'),(31,'e-1'),(32,'f-1'),(33,'g-1'),(34,'h-1'),(35,'i-1'),(36,'j-1'),(37,'k-1'),(38,'l-1'),(39,'m-1'),(40,'n-1'),(41,'o-1'),(42,'p-1'),(43,'q-1'),(44,'r-1'),(45,'s-1'),(46,'t-1'),(47,'u-1'),(48,'v-1'),(49,'w-1'),(50,'x-1'),(51,'y-1'),(52,'z-1'),(53,'a-2'),(54,'b-2'),(55,'c-2'),(56,'d-2'),(57,'e-2'),(58,'f-2'),(59,'g-2'),(60,'h-2'),(61,'i-2'),(62,'j-2'),(63,'k-2'),(64,'l-2'),(65,'m-2'),(66,'n-2'),(67,'o-2'),(68,'p-2'),(69,'q-2'),(70,'r-2'),(71,'s-2'),(72,'t-2'),(73,'u-2'),(74,'v-2'),(75,'w-2'),(76,'x-2'),(77,'y-2'),(78,'z-2'),(79,'a-3'),(80,'b-3'),(81,'c-3'),(82,'d-3'),(83,'e-3'),(84,'f-3'),(85,'g-3'),(86,'h-3'),(87,'i-3'),(88,'j-3'),(89,'k-3'),(90,'l-3'),(91,'m-3'),(92,'n-3'),(93,'o-3'),(94,'p-3'),(95,'q-3'),(96,'r-3'),(97,'s-3'),(98,'t-3'),(99,'u-3'),(100,'v-3');

INSERT INTO `purpose` (`id`,`name`,`robot_id`) VALUES (1,'a-0',1),(2,'b-0',2),(3,'c-0',3),(4,'d-0',4),(5,'e-0',5),(6,'f-0',6),(7,'g-0',7),(8,'h-0',8),(9,'i-0',9),(10,'j-0',10),(11,'k-0',11),(12,'l-0',12),(13,'m-0',13),(14,'n-0',14),(15,'o-0',15),(16,'p-0',16),(17,'q-0',17),(18,'r-0',18),(19,'s-0',19),(20,'t-0',20),(21,'u-0',21),(22,'v-0',22),(23,'w-0',23),(24,'x-0',24),(25,'y-0',25),(26,'z-0',26),(27,'a-1',27),(28,'b-1',28),(29,'c-1',29),(30,'d-1',30),(31,'e-1',31),(32,'f-1',32),(33,'g-1',33),(34,'h-1',34),(35,'i-1',35),(36,'j-1',36),(37,'k-1',37),(38,'l-1',38),(39,'m-1',39),(40,'n-1',40),(41,'o-1',41),(42,'p-1',42),(43,'q-1',43),(44,'r-1',44),(45,'s-1',45),(46,'t-1',46),(47,'u-1',47),(48,'v-1',48),(49,'w-1',49),(50,'x-1',50),(51,'y-1',51),(52,'z-1',52),(53,'a-2',53),(54,'b-2',54),(55,'c-2',55),(56,'d-2',56),(57,'e-2',57),(58,'f-2',58),(59,'g-2',59),(60,'h-2',60),(61,'i-2',61),(62,'j-2',62),(63,'k-2',63),(64,'l-2',64),(65,'m-2',65),(66,'n-2',66),(67,'o-2',67),(68,'p-2',68),(69,'q-2',69),(70,'r-2',70),(71,'s-2',71),(72,'t-2',72),(73,'u-2',73),(74,'v-2',74),(75,'w-2',75),(76,'x-2',76),(77,'y-2',77),(78,'z-2',78),(79,'a-3',79),(80,'b-3',80),(81,'c-3',81),(82,'d-3',82),(83,'e-3',83),(84,'f-3',84),(85,'g-3',85),(86,'h-3',86),(87,'i-3',87),(88,'j-3',88),(89,'k-3',89),(90,'l-3',90),(91,'m-3',91),(92,'n-3',92),(93,'o-3',93),(94,'p-3',94),(95,'q-3',95),(96,'r-3',96),(97,'s-3',97),(98,'t-3',98),(99,'u-3',99),(100,'v-3',100),(101,'w-3',101),(102,'x-3',102),(103,'y-3',103),(104,'z-3',104),(105,'a-4',105),(106,'b-4',106),(107,'c-4',107),(108,'d-4',108),(109,'e-4',109),(110,'f-4',110),(111,'g-4',111),(112,'h-4',112),(113,'i-4',113),(114,'j-4',114),(115,'k-4',115),(116,'l-4',116),(117,'m-4',117),(118,'n-4',118),(119,'o-4',119),(120,'p-4',120),(121,'q-4',121),(122,'r-4',122),(123,'s-4',123),(124,'t-4',124),(125,'u-4',125),(126,'v-4',126),(127,'w-4',127),(128,'x-4',128),(129,'y-4',129),(130,'z-4',130),(131,'a-5',131),(132,'b-5',132),(133,'c-5',133),(134,'d-5',134),(135,'e-5',135),(136,'f-5',136),(137,'g-5',137),(138,'h-5',138),(139,'i-5',139),(140,'j-5',140),(141,'k-5',141),(142,'l-5',142),(143,'m-5',143),(144,'n-5',144),(145,'o-5',145),(146,'p-5',146),(147,'q-5',147),(148,'r-5',148),(149,'s-5',149),(150,'t-5',150),(151,'u-5',151),(152,'v-5',152),(153,'w-5',153),(154,'x-5',154),(155,'y-5',155),(156,'z-5',156),(157,'a-6',157),(158,'b-6',158),(159,'c-6',159),(160,'d-6',160),(161,'e-6',161),(162,'f-6',162),(163,'g-6',163),(164,'h-6',164),(165,'i-6',165),(166,'j-6',166),(167,'k-6',167),(168,'l-6',168),(169,'m-6',169),(170,'n-6',170),(171,'o-6',171),(172,'p-6',172),(173,'q-6',173),(174,'r-6',174),(175,'s-6',175),(176,'t-6',176),(177,'u-6',177),(178,'v-6',178),(179,'w-6',179),(180,'x-6',180),(181,'y-6',181),(182,'z-6',182),(183,'a-7',183),(184,'b-7',184),(185,'c-7',185),(186,'d-7',186),(187,'e-7',187),(188,'f-7',188),(189,'g-7',189),(190,'h-7',190),(191,'i-7',191),(192,'j-7',192),(193,'k-7',193),(194,'l-7',194),(195,'m-7',195),(196,'n-7',196),(197,'o-7',197),(198,'p-7',198),(199,'q-7',199),(200,'r-7',200);

INSERT INTO `robot` (`id`,`name`,`parent_id`,`manufacturer_id`) VALUES (1,'a-0',NULL,85),(2,'b-0',1,92),(3,'c-0',1,64),(4,'d-0',NULL,16),(5,'e-0',NULL,43),(6,'f-0',NULL,2),(7,'g-0',6,48),(8,'h-0',NULL,83),(9,'i-0',8,81),(10,'j-0',1,75),(11,'k-0',3,61),(12,'l-0',NULL,61),(13,'m-0',6,78),(14,'n-0',4,100),(15,'o-0',4,71),(16,'p-0',NULL,47),(17,'q-0',7,96),(18,'r-0',9,87),(19,'s-0',16,17),(20,'t-0',NULL,99),(21,'u-0',9,21),(22,'v-0',10,10),(23,'w-0',15,77),(24,'x-0',1,87),(25,'y-0',10,90),(26,'z-0',NULL,100),(27,'a-1',13,79),(28,'b-1',NULL,70),(29,'c-1',6,4),(30,'d-1',4,32),(31,'e-1',16,30),(32,'f-1',NULL,58),(33,'g-1',27,75),(34,'h-1',19,94),(35,'i-1',NULL,94),(36,'j-1',NULL,1),(37,'k-1',NULL,96),(38,'l-1',NULL,8),(39,'m-1',2,56),(40,'n-1',34,4),(41,'o-1',32,25),(42,'p-1',21,94),(43,'q-1',NULL,94),(44,'r-1',NULL,69),(45,'s-1',NULL,30),(46,'t-1',16,47),(47,'u-1',1,72),(48,'v-1',NULL,79),(49,'w-1',NULL,84),(50,'x-1',NULL,30),(51,'y-1',NULL,37),(52,'z-1',7,69),(53,'a-2',50,9),(54,'b-2',NULL,44),(55,'c-2',NULL,71),(56,'d-2',NULL,6),(57,'e-2',NULL,50),(58,'f-2',55,97),(59,'g-2',NULL,66),(60,'h-2',5,2),(61,'i-2',35,2),(62,'j-2',18,4),(63,'k-2',8,13),(64,'l-2',36,65),(65,'m-2',NULL,10),(66,'n-2',58,99),(67,'o-2',NULL,23),(68,'p-2',5,94),(69,'q-2',NULL,68),(70,'r-2',16,54),(71,'s-2',15,71),(72,'t-2',16,5),(73,'u-2',NULL,14),(74,'v-2',NULL,29),(75,'w-2',53,69),(76,'x-2',36,84),(77,'y-2',NULL,13),(78,'z-2',36,33),(79,'a-3',9,91),(80,'b-3',42,62),(81,'c-3',NULL,68),(82,'d-3',NULL,47),(83,'e-3',27,68),(84,'f-3',27,22),(85,'g-3',68,51),(86,'h-3',NULL,64),(87,'i-3',3,23),(88,'j-3',71,28),(89,'k-3',74,2),(90,'l-3',NULL,17),(91,'m-3',63,5),(92,'n-3',NULL,48),(93,'o-3',2,84),(94,'p-3',92,24),(95,'q-3',88,5),(96,'r-3',NULL,98),(97,'s-3',NULL,44),(98,'t-3',8,71),(99,'u-3',NULL,25),(100,'v-3',66,90),(101,'w-3',NULL,2),(102,'x-3',67,57),(103,'y-3',71,7),(104,'z-3',NULL,98),(105,'a-4',NULL,60),(106,'b-4',74,82),(107,'c-4',86,33),(108,'d-4',65,31),(109,'e-4',NULL,15),(110,'f-4',36,81),(111,'g-4',NULL,90),(112,'h-4',NULL,3),(113,'i-4',29,2),(114,'j-4',71,62),(115,'k-4',97,41),(116,'l-4',97,20),(117,'m-4',114,89),(118,'n-4',95,57),(119,'o-4',NULL,29),(120,'p-4',NULL,70),(121,'q-4',63,46),(122,'r-4',48,48),(123,'s-4',NULL,1),(124,'t-4',26,57),(125,'u-4',NULL,65),(126,'v-4',NULL,64),(127,'w-4',11,48),(128,'x-4',31,26),(129,'y-4',NULL,26),(130,'z-4',NULL,21),(131,'a-5',NULL,41),(132,'b-5',82,40),(133,'c-5',NULL,77),(134,'d-5',NULL,87),(135,'e-5',55,58),(136,'f-5',NULL,3),(137,'g-5',NULL,73),(138,'h-5',123,91),(139,'i-5',136,18),(140,'j-5',47,86),(141,'k-5',50,25),(142,'l-5',113,11),(143,'m-5',NULL,39),(144,'n-5',102,31),(145,'o-5',73,82),(146,'p-5',NULL,47),(147,'q-5',97,12),(148,'r-5',25,20),(149,'s-5',103,23),(150,'t-5',NULL,99),(151,'u-5',32,9),(152,'v-5',NULL,94),(153,'w-5',124,78),(154,'x-5',96,37),(155,'y-5',NULL,57),(156,'z-5',64,2),(157,'a-6',NULL,89),(158,'b-6',NULL,56),(159,'c-6',NULL,38),(160,'d-6',48,80),(161,'e-6',13,31),(162,'f-6',46,81),(163,'g-6',NULL,9),(164,'h-6',40,91),(165,'i-6',124,57),(166,'j-6',NULL,94),(167,'k-6',NULL,38),(168,'l-6',57,74),(169,'m-6',112,98),(170,'n-6',88,1),(171,'o-6',NULL,62),(172,'p-6',NULL,80),(173,'q-6',50,25),(174,'r-6',NULL,29),(175,'s-6',146,37),(176,'t-6',NULL,8),(177,'u-6',65,33),(178,'v-6',NULL,56),(179,'w-6',44,56),(180,'x-6',130,100),(181,'y-6',NULL,13),(182,'z-6',NULL,30),(183,'a-7',NULL,9),(184,'b-7',82,64),(185,'c-7',NULL,93),(186,'d-7',NULL,25),(187,'e-7',103,90),(188,'f-7',147,70),(189,'g-7',182,6),(190,'h-7',88,61),(191,'i-7',NULL,87),(192,'j-7',NULL,21),(193,'k-7',23,28),(194,'l-7',NULL,6),(195,'m-7',NULL,59),(196,'n-7',97,84),(197,'o-7',NULL,31),(198,'p-7',61,21),(199,'q-7',35,87),(200,'r-7',NULL,39);

INSERT INTO `robot_part` (`robot_id`,`part_id`) VALUES (1,14),(1,38),(1,83),(2,57),(2,73),(2,76),(3,41),(3,52),(4,54),(4,55),(4,73),(5,98),(6,47),(7,54),(7,66),(8,34),(8,62),(8,72),(9,18),(9,86),(9,89),(10,66),(10,82),(10,86),(11,31),(11,74),(12,3),(12,86),(12,95),(13,58),(14,16),(14,31),(14,64),(15,76),(16,1),(16,59),(16,73),(17,13),(17,87),(18,28),(19,47),(19,61),(20,16),(20,69),(21,26),(21,74),(21,90),(22,20),(22,27),(23,27),(23,85),(24,50),(25,15),(25,49),(25,77),(26,38),(26,52),(26,75),(27,10),(27,100),(28,64),(28,93),(29,7),(29,53),(30,76),(31,49),(32,15),(33,83),(34,77),(35,30),(35,99),(36,93),(37,68),(37,94),(38,29),(39,72),(39,85),(40,14),(40,54),(40,93),(41,79),(42,91),(42,95),(42,98),(43,57),(43,73),(43,93),(44,33),(45,48),(46,52),(46,58),(47,21),(47,38),(48,16),(48,60),(49,79),(49,95),(50,25),(50,47),(50,54),(51,3),(52,37),(52,87),(53,37),(53,69),(54,28),(54,44),(54,82),(55,25),(55,61),(56,78),(57,63),(58,8),(58,96),(58,100),(59,46),(59,52),(60,25),(61,34),(61,53),(61,82),(62,88),(63,6),(63,83),(63,92),(64,32),(64,54),(65,43),(65,91),(66,16),(66,29),(66,90),(67,36),(67,78),(67,97),(68,22),(69,78),(70,24),(71,26),(72,75),(73,25),(73,61),(74,67),(75,31),(75,49),(75,66),(76,22),(76,24),(76,43),(77,22),(77,69),(77,94),(78,50),(79,45),(80,73),(80,76),(81,4),(82,79),(83,65),(83,69),(83,80),(84,6),(84,69),(85,4),(85,64),(85,96),(86,3),(87,15),(87,53),(88,33),(88,60),(89,37),(89,40),(89,54),(90,19),(90,62),(91,64),(91,88),(92,28),(92,52),(92,93),(93,43),(93,80),(94,74),(95,38),(95,61),(95,70),(96,41),(96,69),(97,4),(97,100),(98,29),(98,39),(99,5),(99,28),(99,93),(100,66),(101,45),(101,91),(102,2),(102,61),(102,95),(103,53),(104,64),(105,8),(105,43),(105,99),(106,18),(106,87),(106,90),(107,49),(107,55),(107,75),(108,8),(108,48),(108,73),(109,13),(109,89),(109,91),(110,16),(110,78),(111,63),(111,89),(112,75),(112,83),(113,60),(113,95),(114,11),(115,15),(115,36),(115,70),(116,6),(116,89),(117,17),(117,46),(118,15),(118,28),(119,17),(119,92),(120,67),(121,11),(121,90),(122,7),(122,94),(122,100),(123,79),(124,6),(124,26),(124,65),(125,91),(126,59),(127,83),(127,96),(127,97),(128,2),(129,69),(129,84),(130,7),(130,52),(131,12),(131,16),(132,1),(132,14),(133,1),(133,44),(133,75),(134,14),(134,17),(134,42),(135,9),(135,11),(135,16),(136,25),(136,40),(137,22),(137,86),(138,32),(139,35),(140,14),(140,50),(141,67),(141,78),(141,86),(142,49),(143,35),(143,44),(143,91),(144,13),(144,50),(145,25),(145,56),(145,64),(146,21),(146,46),(146,77),(147,14),(147,50),(148,46),(148,87),(149,90),(150,85),(151,8),(151,54),(152,69),(153,54),(153,56),(153,99),(154,38),(154,84),(155,44),(155,85),(156,18),(157,84),(158,22),(159,45),(160,33),(160,48),(161,36),(161,41),(161,80),(162,41),(162,85),(163,4),(163,32),(164,10),(164,39),(164,92),(165,55),(165,67),(166,58),(167,14),(167,24),(167,53),(168,10),(168,58),(168,71),(169,53),(169,68),(170,93),(171,18),(171,23),(171,74),(172,14),(172,32),(173,16),(174,28),(174,55),(175,61),(176,50),(177,19),(178,23),(178,56),(178,92),(179,21),(179,65),(180,42),(180,63),(181,93),(182,38),(182,69),(183,7),(184,1),(184,44),(184,89),(185,31),(185,100),(186,51),(187,32),(187,48),(187,70),(188,50),(188,57),(189,46),(190,80),(190,81),(191,45),(192,25),(193,26),(193,32),(194,33),(195,12),(195,84),(196,60),(197,73),(198,53),(199,14),(199,78),(200,18),(200,20),(200,83);
