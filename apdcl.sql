/*
Navicat MySQL Data Transfer

Source Server         : con
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : apdcl

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-06-28 10:03:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `department`
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cdivision` varchar(200) NOT NULL,
  `lcode` int(11) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', 'Circle', 'Jorhat Electrical Circle', '', '1', '4123567809');
INSERT INTO `department` VALUES ('2', 'Division', 'Jorhat Electrical Division I', 'Jorhat Electrical Circle', '2', '1234567890');
INSERT INTO `department` VALUES ('3', 'Sub-Division', 'Jorhat Electrical Sub-Division I', 'Jorhat Electrical Division I', '5', '987654321');
INSERT INTO `department` VALUES ('4', 'Sub-Division', 'Jorhat Electrical Sub-Division II', 'Jorhat Electrical Division I', '6', '1234567809');
INSERT INTO `department` VALUES ('5', 'Division', 'Jorhat Electrical Division II', 'Jorhat Electrical Circle', '3', '234567891');
INSERT INTO `department` VALUES ('6', 'Division', 'Teok', 'Jorhat Electrical Circle', '4', '1235647890');
INSERT INTO `department` VALUES ('8', 'Sub-Division', 'Mariani', 'Jorhat Electrical Division II', '9', '1235467809');
INSERT INTO `department` VALUES ('9', 'Sub-Division', 'Titabor', 'Jorhat Electrical Division II', '10', '1236547809');
INSERT INTO `department` VALUES ('10', 'Sub-Division', 'Kakojan', 'Teok', '13', '1234598760');
INSERT INTO `department` VALUES ('11', 'Central Store', 'Central Store(Upper Assam)', 'Jorhat Electrical Circle', '14', '1234567098');
INSERT INTO `department` VALUES ('12', 'Sub-Division', 'Majuli', 'Jorhat Electrical Division II', '11', '1230987654');
INSERT INTO `department` VALUES ('13', 'Sub-Division', 'Dergaon', 'Jorhat Electrical Division I', '8', '3214567890');
INSERT INTO `department` VALUES ('14', 'Sub-Division', 'Teok1', 'Teok', '12', '9207128831');
INSERT INTO `department` VALUES ('15', 'Sub-Division', 'Baligaon', 'Teok', '14', '1236547890');

-- ----------------------------
-- Table structure for `issue`
-- ----------------------------
DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
  `issueno` int(11) NOT NULL AUTO_INCREMENT,
  `idate` date NOT NULL,
  `rno` int(11) NOT NULL,
  `idivision` varchar(50) NOT NULL,
  `rdivision` varchar(50) NOT NULL,
  `rdate` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`issueno`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of issue
-- ----------------------------
INSERT INTO `issue` VALUES ('5', '2019-05-03', '3', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division II', null, 'Issued');
INSERT INTO `issue` VALUES ('6', '2019-05-03', '3', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division II', null, 'New');

-- ----------------------------
-- Table structure for `issuedetails`
-- ----------------------------
DROP TABLE IF EXISTS `issuedetails`;
CREATE TABLE `issuedetails` (
  `issueid` int(11) NOT NULL AUTO_INCREMENT,
  `idate` varchar(20) NOT NULL,
  `rno` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`issueid`),
  KEY `mid` (`mid`),
  KEY `rno` (`rno`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of issuedetails
-- ----------------------------
INSERT INTO `issuedetails` VALUES ('37', '2019-06-26', '22', '1', '6', 'Issued', 'Jorhat Electrical Division II', 'Titabor');
INSERT INTO `issuedetails` VALUES ('38', '2019-06-26', '24', '1', '4', 'Issued', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division I');
INSERT INTO `issuedetails` VALUES ('39', '2019-06-26', '27', '7', '2', 'Issued', 'Jorhat Electrical Circle', 'Jorhat Electrical Division I');

-- ----------------------------
-- Table structure for `materials`
-- ----------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(200) NOT NULL,
  `details` varchar(200) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES ('1', '11 KV Pin Insulator', '11 KV');
INSERT INTO `materials` VALUES ('2', '11 KV Tcross Arm', '11KV');
INSERT INTO `materials` VALUES ('3', '33 KV Station Type', '33 KV');
INSERT INTO `materials` VALUES ('4', 'XLPE Cable 150 Sq mm', '150 Sq mm');
INSERT INTO `materials` VALUES ('5', '15 KV Pin Insulator', '15KV');
INSERT INTO `materials` VALUES ('6', 'Single Phase Cable', 'abc');
INSERT INTO `materials` VALUES ('7', 'Transformer 25KV', '25KV');
INSERT INTO `materials` VALUES ('8', 'Transformer 63KV', '63KV');

-- ----------------------------
-- Table structure for `msupply`
-- ----------------------------
DROP TABLE IF EXISTS `msupply`;
CREATE TABLE `msupply` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sdate` varchar(100) NOT NULL,
  `scheme` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` varchar(300) NOT NULL,
  `vendor` varchar(200) NOT NULL,
  `warranty` varchar(100) NOT NULL,
  `dept` varchar(200) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of msupply
-- ----------------------------
INSERT INTO `msupply` VALUES ('8', '2019-05-22', '2', '7', '4', '25KV', '3', '5 Years', 'CGM');
INSERT INTO `msupply` VALUES ('9', '2019-05-24', '2', '7', '2', '25KV', '3', '5 Years', 'CGM');
INSERT INTO `msupply` VALUES ('10', '2019-05-24', '2', '7', '4', '25KV', '3', '5 Years', 'Central Store');
INSERT INTO `msupply` VALUES ('11', '2019-06-05', '2', '7', '4', '25KV', '3', '5 Years', 'Central Store');
INSERT INTO `msupply` VALUES ('12', '2019-06-05', '1', '6', '10', 'Single Phase', '2', '', 'CGM');
INSERT INTO `msupply` VALUES ('13', '2019-06-05', '1', '8', '12', '', '1', '', 'Central Store');
INSERT INTO `msupply` VALUES ('14', '2019-06-12', '2', '7', '6', '25KV', '3', '5 Years', 'Central Store');
INSERT INTO `msupply` VALUES ('15', '2019-06-21', '2', '7', '2', '25KV', '2', '5 Years', 'Central Store');
INSERT INTO `msupply` VALUES ('16', '2019-06-22', '1', '7', '10', '25KV', '3', '5 Years', 'CGM');

-- ----------------------------
-- Table structure for `notice`
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ndate` date NOT NULL,
  `header` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('1', '2019-06-19', 'Revenue Collection', 'Please Send pending revenue collection report.');
INSERT INTO `notice` VALUES ('2', '2019-06-19', 'Material Stock', 'New Stock is available in two days');
INSERT INTO `notice` VALUES ('3', '2019-06-19', 'Transformer 25KV', 'Stock of Transformer 25KV is not available in Central Storage');
INSERT INTO `notice` VALUES ('4', '2019-06-21', 'Transformer 25KV', 'Stock of Transformer 25KV is not available in Central Storage');
INSERT INTO `notice` VALUES ('5', '2019-06-24', 'Revenue Collection', 'Please Send pending revenue collection report.');
INSERT INTO `notice` VALUES ('6', '2019-06-23', 'Material Stock', 'New Stock is available in two days');
INSERT INTO `notice` VALUES ('7', '2019-06-26', 'JESDI', 'Requested material is issued.');
INSERT INTO `notice` VALUES ('9', '2019-06-26', 'Material Stock', 'New Stock is available in two days');

-- ----------------------------
-- Table structure for `powercut`
-- ----------------------------
DROP TABLE IF EXISTS `powercut`;
CREATE TABLE `powercut` (
  `pcutid` int(11) NOT NULL AUTO_INCREMENT,
  `panelno` varchar(20) NOT NULL,
  `pctime` varchar(200) NOT NULL,
  `pontime` varchar(200) NOT NULL,
  `cause` varchar(200) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `deptid` int(11) NOT NULL,
  `pcdate` varchar(30) NOT NULL,
  PRIMARY KEY (`pcutid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of powercut
-- ----------------------------
INSERT INTO `powercut` VALUES ('1', '6 No.', '6:30pm', '7:30pm', 'C/Off', 'xyzzz', '2', '2019-06-18');
INSERT INTO `powercut` VALUES ('2', '9 No.', '5:30pm', '5:45pm', 'S/d', 'abc', '8', '2019-06-19');

-- ----------------------------
-- Table structure for `purchase`
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `invoiceno` int(11) NOT NULL,
  `idate` varchar(100) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  PRIMARY KEY (`invoiceno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase
-- ----------------------------
INSERT INTO `purchase` VALUES ('1207', '2019-06-26', 'ABC');
INSERT INTO `purchase` VALUES ('1208', '2019-06-29', 'Trishual Trading');
INSERT INTO `purchase` VALUES ('1209', '2019-06-30', 'ABC');

-- ----------------------------
-- Table structure for `purchasedetails`
-- ----------------------------
DROP TABLE IF EXISTS `purchasedetails`;
CREATE TABLE `purchasedetails` (
  `invoiceno` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `gst` float NOT NULL,
  `gstamount` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`invoiceno`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchasedetails
-- ----------------------------
INSERT INTO `purchasedetails` VALUES ('1207', '1', '5', '500', '2500', '18', '450', '2950');
INSERT INTO `purchasedetails` VALUES ('1208', '2', '3', '400', '1200', '18', '216', '1416');
INSERT INTO `purchasedetails` VALUES ('1208', '4', '3', '600', '1800', '18', '324', '2124');
INSERT INTO `purchasedetails` VALUES ('1209', '4', '6', '350', '2100', '18', '378', '2478');

-- ----------------------------
-- Table structure for `repaired`
-- ----------------------------
DROP TABLE IF EXISTS `repaired`;
CREATE TABLE `repaired` (
  `repid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `vendor` int(11) NOT NULL,
  `repdate` varchar(100) NOT NULL,
  `qua` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`repid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of repaired
-- ----------------------------
INSERT INTO `repaired` VALUES ('3', '4', '3', '2019-06-29', '3', '6000', '18000');
INSERT INTO `repaired` VALUES ('4', '5', '1', '2019-07-10', '2', '8000', '16000');

-- ----------------------------
-- Table structure for `repairing`
-- ----------------------------
DROP TABLE IF EXISTS `repairing`;
CREATE TABLE `repairing` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` varchar(100) NOT NULL,
  `dept` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `quan` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of repairing
-- ----------------------------
INSERT INTO `repairing` VALUES ('4', '2019-06-26', '3', '7', '3', 'Repaired');
INSERT INTO `repairing` VALUES ('5', '2019-06-28', '3', '7', '2', 'Repaired');
INSERT INTO `repairing` VALUES ('6', '2019-06-29', '3', '8', '4', 'New');

-- ----------------------------
-- Table structure for `reqdetails`
-- ----------------------------
DROP TABLE IF EXISTS `reqdetails`;
CREATE TABLE `reqdetails` (
  `rno` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`rno`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reqdetails
-- ----------------------------
INSERT INTO `reqdetails` VALUES ('22', '1', '6', 'Issued');
INSERT INTO `reqdetails` VALUES ('22', '7', '3', 'Division');
INSERT INTO `reqdetails` VALUES ('23', '3', '8', 'Division');
INSERT INTO `reqdetails` VALUES ('23', '4', '5', 'Division');
INSERT INTO `reqdetails` VALUES ('24', '1', '4', 'Issued');
INSERT INTO `reqdetails` VALUES ('24', '8', '3', 'C Store');
INSERT INTO `reqdetails` VALUES ('25', '4', '6', 'Division');
INSERT INTO `reqdetails` VALUES ('25', '5', '7', 'Division');
INSERT INTO `reqdetails` VALUES ('25', '6', '3', 'Division');
INSERT INTO `reqdetails` VALUES ('26', '4', '4', 'Circle');
INSERT INTO `reqdetails` VALUES ('26', '7', '4', 'C Store');
INSERT INTO `reqdetails` VALUES ('27', '7', '2', 'Issued');
INSERT INTO `reqdetails` VALUES ('27', '8', '3', 'C Store');
INSERT INTO `reqdetails` VALUES ('28', '4', '5', 'Circle');
INSERT INTO `reqdetails` VALUES ('28', '5', '4', 'Circle');
INSERT INTO `reqdetails` VALUES ('29', '2', '6', 'Division');
INSERT INTO `reqdetails` VALUES ('29', '7', '7', 'Division');
INSERT INTO `reqdetails` VALUES ('30', '3', '4', 'Division');
INSERT INTO `reqdetails` VALUES ('30', '4', '5', 'Division');
INSERT INTO `reqdetails` VALUES ('31', '2', '2', 'Division');
INSERT INTO `reqdetails` VALUES ('31', '5', '5', 'Division');
INSERT INTO `reqdetails` VALUES ('32', '2', '6', 'Circle');
INSERT INTO `reqdetails` VALUES ('32', '8', '3', 'Circle');

-- ----------------------------
-- Table structure for `requisition`
-- ----------------------------
DROP TABLE IF EXISTS `requisition`;
CREATE TABLE `requisition` (
  `rno` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cdivision` varchar(40) NOT NULL,
  `sdiv` varchar(40) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`rno`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of requisition
-- ----------------------------
INSERT INTO `requisition` VALUES ('22', '2019-06-26', 'Jorhat Electrical Division II', 'Titabor', 'Pending');
INSERT INTO `requisition` VALUES ('23', '2019-06-26', 'Jorhat Electrical Division II', 'Mariani', 'Pending');
INSERT INTO `requisition` VALUES ('24', '2019-06-26', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division I', 'Pending');
INSERT INTO `requisition` VALUES ('25', '2019-06-26', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division II', 'Pending');
INSERT INTO `requisition` VALUES ('26', '2019-06-26', 'Jorhat Electrical Circle', 'Jorhat Electrical Division II', 'Pending');
INSERT INTO `requisition` VALUES ('27', '2019-06-26', 'Jorhat Electrical Circle', 'Jorhat Electrical Division I', 'Pending');
INSERT INTO `requisition` VALUES ('28', '2019-06-26', 'Teok', 'Kakojan', 'Pending');
INSERT INTO `requisition` VALUES ('29', '2019-06-27', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division I', 'Pending');
INSERT INTO `requisition` VALUES ('30', '2019-06-27', 'Jorhat Electrical Division I', 'Jorhat Electrical Sub-Division I', 'Pending');
INSERT INTO `requisition` VALUES ('31', '2019-06-27', 'Teok', 'Kakojan', 'Pending');
INSERT INTO `requisition` VALUES ('32', '2019-06-28', 'Jorhat Electrical Circle', 'Teok', 'Pending');

-- ----------------------------
-- Table structure for `scheme`
-- ----------------------------
DROP TABLE IF EXISTS `scheme`;
CREATE TABLE `scheme` (
  `scid` int(11) NOT NULL AUTO_INCREMENT,
  `scname` varchar(200) NOT NULL,
  PRIMARY KEY (`scid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of scheme
-- ----------------------------
INSERT INTO `scheme` VALUES ('1', 'RAPDRP');
INSERT INTO `scheme` VALUES ('2', 'ADB');

-- ----------------------------
-- Table structure for `storage`
-- ----------------------------
DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage` (
  `mid` int(11) NOT NULL,
  `dept` varchar(40) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`mid`,`dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of storage
-- ----------------------------
INSERT INTO `storage` VALUES ('1', 'Circle', '7');
INSERT INTO `storage` VALUES ('1', 'Dergaon', '4');
INSERT INTO `storage` VALUES ('1', 'Jorhat Electrical Division I', '5');
INSERT INTO `storage` VALUES ('1', 'Jorhat Electrical Division II', '2');
INSERT INTO `storage` VALUES ('1', 'Jorhat Electrical Sub-Division I', '6');
INSERT INTO `storage` VALUES ('1', 'Jorhat Electrical Sub-Division II', '6');
INSERT INTO `storage` VALUES ('2', 'Circle', '18');
INSERT INTO `storage` VALUES ('2', 'Jorhat Electrical Division I', '10');
INSERT INTO `storage` VALUES ('2', 'Jorhat Electrical Sub-Division II', '10');
INSERT INTO `storage` VALUES ('2', 'Kakojan', '5');
INSERT INTO `storage` VALUES ('2', 'Titabor', '3');
INSERT INTO `storage` VALUES ('3', 'Dergaon', '2');
INSERT INTO `storage` VALUES ('3', 'Jorhat Electrical Division I', '8');
INSERT INTO `storage` VALUES ('3', 'Jorhat Electrical Division II', '3');
INSERT INTO `storage` VALUES ('3', 'Jorhat Electrical Sub-Division I', '11');
INSERT INTO `storage` VALUES ('3', 'Jorhat Electrical Sub-Division II', '5');
INSERT INTO `storage` VALUES ('3', 'Mariani', '6');
INSERT INTO `storage` VALUES ('3', 'Teok', '3');
INSERT INTO `storage` VALUES ('4', 'Circle', '8');
INSERT INTO `storage` VALUES ('4', 'Jorhat Electrical Division II', '10');
INSERT INTO `storage` VALUES ('4', 'Jorhat Electrical Sub-Division I', '3');
INSERT INTO `storage` VALUES ('4', 'Jorhat Electrical Sub-Division II', '15');
INSERT INTO `storage` VALUES ('4', 'Teok', '5');
INSERT INTO `storage` VALUES ('4', 'Titabor', '9');
INSERT INTO `storage` VALUES ('5', 'Circle', '15');
INSERT INTO `storage` VALUES ('5', 'Jorhat Electrical Division II', '1');
INSERT INTO `storage` VALUES ('5', 'Kakojan', '6');
INSERT INTO `storage` VALUES ('6', 'CGM', '10');
INSERT INTO `storage` VALUES ('7', 'Central Store', '7');
INSERT INTO `storage` VALUES ('7', 'CGM', '2');
INSERT INTO `storage` VALUES ('7', 'Circle', '2');
INSERT INTO `storage` VALUES ('8', 'Central Store', '12');
INSERT INTO `storage` VALUES ('8', 'Circle', '2');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usertype` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('Sub-Division', 'Baligaon', 'Baligaon', '12345');
INSERT INTO `users` VALUES ('Central Store', 'Central Store(Upper Assam)', 'C Store', '12345');
INSERT INTO `users` VALUES ('CGM', 'CGM(Ghy)', 'CGM', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Dergaon', 'Dergaon', '12345');
INSERT INTO `users` VALUES ('Division', 'Jorhat Electrical Division II', 'JEDII', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Jorhat Electrical Sub-Division II', 'JESDII', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Kakojan', 'Kakojan', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Mariani', 'Mariani', '12345');
INSERT INTO `users` VALUES ('Division', 'Teok', 'Teok', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Titabor', 'titabor', '12345');
INSERT INTO `users` VALUES ('Circle', 'Jorhat Electrical Circle', 'tsdas', '12345');
INSERT INTO `users` VALUES ('Division', 'Jorhat Electrical Division I', 'tsdas29', '12345');
INSERT INTO `users` VALUES ('Sub-Division', 'Jorhat Electrical Sub-Division I', 'tsdas30', '12345');

-- ----------------------------
-- Table structure for `vendors`
-- ----------------------------
DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` bigint(20) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vendors
-- ----------------------------
INSERT INTO `vendors` VALUES ('1', 'ABC', 'Jorhat', '9577509923');
INSERT INTO `vendors` VALUES ('2', 'XYZ', 'Sivsagar', '1234567890');
INSERT INTO `vendors` VALUES ('3', 'Trishual Trading', 'Sivsagar', '9207128831');
