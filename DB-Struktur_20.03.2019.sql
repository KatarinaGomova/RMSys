drop database rmsys;
CREATE DATABASE `rmsys`;
USE `rmsys`;


CREATE TABLE `project` (
  `projectId` int(11) NOT NULL AUTO_INCREMENT,
  `projectName` varchar(50) NOT NULL,
  `prefix` char(3) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectId`),
  UNIQUE KEY `prefix` (`prefix`)
);


INSERT INTO `project` VALUES (1,'Test','TE','2019-02-13 07:30:36'),
								(2,'Test2','TE2','2019-02-18 08:41:21'),
                                (3,'Noch ein Test','NT','2019-03-04 10:51:09'),
                                (6,'Project','PRE','2019-03-04 11:07:10'),
                                (7,'Project + Tests','FRE','2019-03-04 11:07:59'),
                                (8,'G-PRo','G','2019-03-19 13:42:06');


CREATE TABLE `requirementsstatus` (
  `requirementsStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `requirementsStatusName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`requirementsStatusId`)
);


INSERT INTO `requirementsstatus` VALUES (1,'unklar'),(2,'abgelehnt'),(3,'OK'),(4,'TBD'),(5,'verschoben');


CREATE TABLE `requirementstyp` (
  `requirementsTypId` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`requirementsTypId`)
);


INSERT INTO `requirementstyp` VALUES (1,'headline'),(2,'requirement');


CREATE TABLE `userstatus` (
  `userStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `userStatusName` varchar(20) NOT NULL,
  PRIMARY KEY (`userStatusId`)
);


INSERT INTO `userstatus` VALUES (1,'admin'),(2,'user');


CREATE TABLE `usermanagement` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text NOT NULL,
  `userStatusId` int(11) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `userStatusId` (`userStatusId`),
  CONSTRAINT `usermanagement_ibfk_1` FOREIGN KEY (`userStatusId`) REFERENCES `userstatus` (`userstatusid`) ON DELETE SET NULL
);


INSERT INTO `usermanagement` VALUES (1,'admin','admin','admin','827ccb0eea8a706c4c34a16891f84e7b',1),
									(2,'Katarina','Gomova','kgomova','827ccb0eea8a706c4c34a16891f84e7b',2),
                                    (3,'Niklas','Albrecht','nalbrecht','202cb962ac59075b964b07152d234b70',2);


CREATE TABLE `requirements` (
  `requirementsId` int(11) NOT NULL AUTO_INCREMENT,
  `numericalOrder` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `description` text NOT NULL,
  `comments` text,
  `creationDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requirementsStatusId` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `projectId` int(11) DEFAULT NULL,
  `requirementsTypId` int(11) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`requirementsId`),
  KEY `requirementsStatusId` (`requirementsStatusId`),
  KEY `userId` (`userId`),
  KEY `projectId` (`projectId`),
  KEY `requirementsTypId` (`requirementsTypId`),
  CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`requirementsStatusId`) REFERENCES `requirementsstatus` (`requirementsstatusid`),
  CONSTRAINT `requirements_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `usermanagement` (`userid`),
  CONSTRAINT `requirements_ibfk_4` FOREIGN KEY (`projectId`) REFERENCES `project` (`projectid`),
  CONSTRAINT `requirements_ibfk_5` FOREIGN KEY (`requirementsTypId`) REFERENCES `requirementstyp` (`requirementstypid`)
);


INSERT INTO `requirements` VALUES (1,1,0,'GUI',NULL,'2019-02-18 08:42:04',1,25,2,1,1,0),
									(2,2,1,'allgemein',NULL,'2019-02-18 08:42:04',4,50,2,1,1,0),
                                    (3,1,1,'Länderspezifika',NULL,'2019-02-18 08:42:04',3,50,2,1,1,0),
                                    (4,2,0,'Benutzerverwaltung',NULL,'2019-02-18 08:42:04',3,75,2,1,1,0),
                                    (5,2,2,'Anzeige Werte',NULL,'2019-02-18 08:42:04',4,0,3,1,1,0),
                                    (6,3,0,'Farben',NULL,'2019-02-18 08:42:04',1,0,2,1,1,0),
                                    (7,1,2,'hier',NULL,'2019-02-18 10:31:31',1,50,2,1,1,0),
                                    (8,1,2,'Hier ist eine Anforderung die genau richtig angezeigt werden muss.',NULL,'2019-02-25 07:13:16',4,25,3,1,2,0),
                                    (9,2,2,'Noch eine Anforderung, diese muss auch richtig angezeigt werden. Dies ist ganz ganz ganz ganz ganz ganz ganz ganz ganz ganz ganz ganz ganz wichtig!!!',NULL,'2019-02-25 07:42:31',1,25,3,1,2,0),
                                    (10,1,1,'Eine zweite Anforderung.',NULL,'2019-03-05 08:20:52',1,50,2,1,2,0),
                                    (11,3,1,'Hier ist die Dritte.',NULL,'2019-03-05 08:20:52',4,75,2,1,2,0),
                                    (12,2,1,'Eine tolle Anforderung',NULL,'2019-03-05 12:15:36',3,100,2,1,2,0),
                                    (13,1,4,'Für Benutzerverwaltung gibt es auch eine Anforderung.',NULL,'2019-03-11 07:29:26',4,100,3,1,2,0),
                                    (14,1,4,'Unterteilung',NULL,'2019-03-11 11:05:04',1,50,3,1,1,0),
                                    (15,4,1,'Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung Anforderung.',NULL,'2019-03-11 11:08:06',3,25,2,1,2,0),
                                    (16,1,6,'Komponenten',NULL,'2019-03-12 09:01:06',1,0,2,1,1,0),
                                    (17,4,0,'Namen',NULL,'2019-03-12 09:05:47',4,75,3,1,1,0),
                                    (18,1,0,'Test für Headline',NULL,'2019-03-14 07:52:48',3,0,2,6,1,0);
 
CREATE TABLE `history` (
  `historyId` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `requirementsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `operation` enum('update', 'insert', 'deleted', 'restored'),
  `table` varchar(30) NOT NULL,
  `column` varchar(30) NOT NULL,
  `newValue` text,
  `oldValue` int(11),
  `operationDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  
  PRIMARY KEY (`historyId`),
  CONSTRAINT `history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `usermanagement` (`userId`),
  CONSTRAINT history_ibfk_2 FOREIGN KEY (`requirementsId`) REFERENCES `requirements` (`requirementsId`),
  CONSTRAINT `history_ibfk_3` FOREIGN KEY (`projectId`) REFERENCES `project` (`projectId`)
);









