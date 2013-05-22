SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `juegosnacionales` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `juegosnacionales` ;

-- -----------------------------------------------------
-- Table `juegosnacionales`.`usertype`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`usertype` (
  `iduserType` INT(11) NOT NULL AUTO_INCREMENT ,
  `userTypeName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`iduserType`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`user` (
  `username` VARCHAR(25) NOT NULL ,
  `iduserType` INT(11) NOT NULL ,
  `userPassword` VARCHAR(62) NOT NULL ,
  `userEmail` VARCHAR(250) NULL DEFAULT NULL ,
  `userPhone` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`username`, `iduserType`) ,
  INDEX `fk_user_userType1` (`iduserType` ASC) ,
  CONSTRAINT `fk_user_userType1`
    FOREIGN KEY (`iduserType` )
    REFERENCES `juegosnacionales`.`usertype` (`iduserType` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`coordinator`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`coordinator` (
  `idcoordinator` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(25) NOT NULL ,
  `coordinatorName` VARCHAR(250) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcoordinator`, `username`) ,
  INDEX `fk_coordinator_user1` (`username` ASC) ,
  CONSTRAINT `fk_coordinator_user1`
    FOREIGN KEY (`username` )
    REFERENCES `juegosnacionales`.`user` (`username` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`state`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`state` (
  `idstate` INT(11) NOT NULL AUTO_INCREMENT ,
  `stateName` VARCHAR(45) NOT NULL ,
  `idcoordinator` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idstate`) ,
  INDEX `fk_state_coordinator1` (`idcoordinator` ASC) ,
  CONSTRAINT `fk_state_coordinator1`
    FOREIGN KEY (`idcoordinator` )
    REFERENCES `juegosnacionales`.`coordinator` (`idcoordinator` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`city`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`city` (
  `idcity` INT(11) NOT NULL AUTO_INCREMENT ,
  `idstate` INT(11) NOT NULL ,
  `cityName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idcity`, `idstate`) ,
  INDEX `fk_city_state` (`idstate` ASC) ,
  CONSTRAINT `fk_city_state`
    FOREIGN KEY (`idstate` )
    REFERENCES `juegosnacionales`.`state` (`idstate` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 117
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`campus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`campus` (
  `idcampus` CHAR(9) NOT NULL ,
  `idcity` INT(11) NOT NULL ,
  `campusName` VARCHAR(45) NOT NULL ,
  `campusPhone` INT(14) NULL DEFAULT NULL ,
  `campusDirectorName` VARCHAR(200) NULL DEFAULT NULL ,
  `campusDirectorPhone` CHAR(14) NULL DEFAULT NULL ,
  `cct` CHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcampus`, `idcity`) ,
  INDEX `fk_campus_city1` (`idcity` ASC) ,
  CONSTRAINT `fk_campus_city1`
    FOREIGN KEY (`idcity` )
    REFERENCES `juegosnacionales`.`city` (`idcity` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`sport`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`sport` (
  `idsport` INT(1) NOT NULL AUTO_INCREMENT ,
  `sportName` VARCHAR(45) NOT NULL ,
  `sportParticipantsLimit` INT(2) NOT NULL ,
  `sportParticipantsMin` INT(2) NOT NULL ,
  PRIMARY KEY (`idsport`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`sportcategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`sportcategory` (
  `idsportCategory` INT(11) NOT NULL AUTO_INCREMENT ,
  `idsport` INT(1) NOT NULL ,
  `sportCategoryName` VARCHAR(7) NOT NULL ,
  PRIMARY KEY (`idsportCategory`, `idsport`) ,
  INDEX `fk_sportCategory_sport1` (`idsport` ASC) ,
  CONSTRAINT `fk_sportCategory_sport1`
    FOREIGN KEY (`idsport` )
    REFERENCES `juegosnacionales`.`sport` (`idsport` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`team`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`team` (
  `idteam` INT(11) NOT NULL AUTO_INCREMENT ,
  `idcampus` CHAR(9) NOT NULL ,
  `idsportCategory` INT(11) NOT NULL ,
  PRIMARY KEY (`idteam`, `idcampus`, `idsportCategory`) ,
  INDEX `fk_team_campus1` (`idcampus` ASC) ,
  INDEX `fk_team_sportCategory1` (`idsportCategory` ASC) ,
  CONSTRAINT `fk_team_campus1`
    FOREIGN KEY (`idcampus` )
    REFERENCES `juegosnacionales`.`campus` (`idcampus` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_team_sportCategory1`
    FOREIGN KEY (`idsportCategory` )
    REFERENCES `juegosnacionales`.`sportcategory` (`idsportCategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`participant`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`participant` (
  `idparticipant` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idteam` INT(11) NOT NULL ,
  `usernameCoach` VARCHAR(25) NULL DEFAULT NULL ,
  `lastName` VARCHAR(45) NOT NULL ,
  `sureName` VARCHAR(45) NOT NULL ,
  `firstName` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idparticipant`, `idteam`) ,
  INDEX `fk_participant_team1` (`idteam` ASC) ,
  INDEX `fk_participant_user1` (`usernameCoach` ASC) ,
  CONSTRAINT `fk_participant_team1`
    FOREIGN KEY (`idteam` )
    REFERENCES `juegosnacionales`.`team` (`idteam` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participant_user1`
    FOREIGN KEY (`usernameCoach` )
    REFERENCES `juegosnacionales`.`user` (`username` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`address`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`address` (
  `idaddress` INT(11) NOT NULL AUTO_INCREMENT ,
  `idparticipant` INT(10) UNSIGNED NOT NULL ,
  `addressStreet` VARCHAR(100) NULL DEFAULT NULL ,
  `addressNumber` VARCHAR(10) NULL DEFAULT NULL ,
  `addressInteriorNumber` VARCHAR(8) NULL DEFAULT NULL ,
  `addressColony` VARCHAR(200) NULL DEFAULT NULL ,
  `addressZip` INT(5) NULL DEFAULT NULL ,
  `addressLocality` VARCHAR(60) NULL DEFAULT NULL ,
  `addressTownship` VARCHAR(60) NULL DEFAULT NULL ,
  `addressTown` VARCHAR(60) NULL DEFAULT NULL ,
  `addressState` VARCHAR(60) NULL DEFAULT NULL ,
  PRIMARY KEY (`idaddress`, `idparticipant`) ,
  INDEX `fk_address_participant1` (`idparticipant` ASC) ,
  UNIQUE INDEX `idparticipant_UNIQUE` (`idparticipant` ASC) ,
  CONSTRAINT `fk_address_participant1`
    FOREIGN KEY (`idparticipant` )
    REFERENCES `juegosnacionales`.`participant` (`idparticipant` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`participantathlete`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`participantathlete` (
  `schoolEnrollment` VARCHAR(15) NOT NULL ,
  `idparticipant` INT(10) UNSIGNED NOT NULL ,
  `jerseyNumber` INT(3) NULL DEFAULT NULL ,
  `semester` INT(1) NULL DEFAULT NULL ,
  `group` VARCHAR(10) NULL DEFAULT NULL ,
  `schoolState` CHAR(1) NULL DEFAULT NULL ,
  `fileBirthCertificate` VARCHAR(60) NULL DEFAULT NULL ,
  `fileSchoolCertificate` VARCHAR(60) NULL DEFAULT NULL ,
  `fileAcademicHistory` VARCHAR(60) NULL DEFAULT NULL ,
  `fileStudentCardFront` VARCHAR(60) NULL DEFAULT NULL ,
  `fileStudentCardBack` VARCHAR(60) NULL DEFAULT NULL ,
  `allergies` VARCHAR(500) NULL DEFAULT NULL ,
  `chronicDiseases` VARCHAR(500) NULL DEFAULT NULL ,
  PRIMARY KEY (`schoolEnrollment`, `idparticipant`) ,
  UNIQUE INDEX `schoolEnrollment_UNIQUE` (`schoolEnrollment` ASC) ,
  INDEX `fk_athlete_participant1` (`idparticipant` ASC) ,
  UNIQUE INDEX `idparticipant_UNIQUE` (`idparticipant` ASC) ,
  CONSTRAINT `fk_athlete_participant1`
    FOREIGN KEY (`idparticipant` )
    REFERENCES `juegosnacionales`.`participant` (`idparticipant` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`participantmeta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`participantmeta` (
  `idparticipantMeta` INT(11) NOT NULL AUTO_INCREMENT ,
  `idparticipant` INT(10) UNSIGNED NOT NULL ,
  `birthdate` DATE NULL DEFAULT NULL ,
  `phone` CHAR(14) NULL DEFAULT NULL ,
  `cellphone` CHAR(14) NULL DEFAULT NULL ,
  `email` VARCHAR(250) NULL DEFAULT NULL ,
  `turn` CHAR(1) NULL DEFAULT NULL ,
  `curp` CHAR(18) NULL DEFAULT NULL ,
  `curpFile` VARCHAR(60) NULL DEFAULT NULL ,
  `bloodType` CHAR(2) NULL DEFAULT NULL ,
  `emergencyName` VARCHAR(200) NULL DEFAULT NULL ,
  `emergencyPhone` CHAR(10) NULL DEFAULT NULL ,
  `filePhoto` VARCHAR(60) NULL DEFAULT NULL ,
  `juegosnacionales` VARCHAR(60) NULL ,
  `fileIdentificationBack` VARCHAR(60) NULL ,
  PRIMARY KEY (`idparticipantMeta`, `idparticipant`) ,
  INDEX `fk_participantmeta_participant1` (`idparticipant` ASC) ,
  UNIQUE INDEX `idparticipant_UNIQUE` (`idparticipant` ASC) ,
  CONSTRAINT `fk_participantmeta_participant1`
    FOREIGN KEY (`idparticipant` )
    REFERENCES `juegosnacionales`.`participant` (`idparticipant` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`headquarters`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`headquarters` (
  `idheadquarters` INT NOT NULL AUTO_INCREMENT ,
  `nameHeadquarters` VARCHAR(60) NULL ,
  `street` VARCHAR(60) NULL ,
  `number` VARCHAR(30) NULL ,
  `colony` VARCHAR(60) NULL ,
  `zipCode` INT(5) NULL ,
  PRIMARY KEY (`idheadquarters`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`event`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`event` (
  `idevent` INT NOT NULL AUTO_INCREMENT ,
  `idsportCategory` INT(11) NOT NULL ,
  `idheadquarters` INT NOT NULL ,
  `idteamOne` INT(11) NULL ,
  `idteamTwo` INT(11) NULL ,
  `dateTimeEvent` DATETIME NULL ,
  PRIMARY KEY (`idevent`, `idsportCategory`, `idheadquarters`) ,
  INDEX `fk_events_headquarters1` (`idheadquarters` ASC) ,
  INDEX `fk_event_sportcategory1` (`idsportCategory` ASC) ,
  CONSTRAINT `fk_events_headquarters1`
    FOREIGN KEY (`idheadquarters` )
    REFERENCES `juegosnacionales`.`headquarters` (`idheadquarters` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_sportcategory1`
    FOREIGN KEY (`idsportCategory` )
    REFERENCES `juegosnacionales`.`sportcategory` (`idsportCategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`groups` (
  `idgroup` INT NOT NULL AUTO_INCREMENT ,
  `idsportCategory` INT(11) NOT NULL ,
  `groupName` VARCHAR(2) NULL ,
  PRIMARY KEY (`idgroup`, `idsportCategory`) ,
  INDEX `fk_groups_sportcategory1` (`idsportCategory` ASC) ,
  CONSTRAINT `fk_groups_sportcategory1`
    FOREIGN KEY (`idsportCategory` )
    REFERENCES `juegosnacionales`.`sportcategory` (`idsportCategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`annotator`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`annotator` (
  `idannotator` INT NOT NULL AUTO_INCREMENT ,
  `idevent` INT(11) NOT NULL ,
  `idparticipant` INT(10) UNSIGNED NOT NULL ,
  `annotations` INT NULL ,
  `minute` VARCHAR(20) NULL ,
  PRIMARY KEY (`idannotator`, `idevent`, `idparticipant`) ,
  INDEX `fk_annotator_event1` (`idevent` ASC) ,
  INDEX `fk_annotator_participant1` (`idparticipant` ASC) ,
  CONSTRAINT `fk_annotator_event1`
    FOREIGN KEY (`idevent` )
    REFERENCES `juegosnacionales`.`event` (`idevent` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_annotator_participant1`
    FOREIGN KEY (`idparticipant` )
    REFERENCES `juegosnacionales`.`participant` (`idparticipant` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`assignationvars`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`assignationvars` (
  `idassignationvars` INT NOT NULL ,
  `idgroup` INT NOT NULL ,
  `assignationvarName` CHAR(2) NULL ,
  PRIMARY KEY (`idassignationvars`, `idgroup`) ,
  INDEX `fk_assignationvars_groups1` (`idgroup` ASC) ,
  CONSTRAINT `fk_assignationvars_groups1`
    FOREIGN KEY (`idgroup` )
    REFERENCES `juegosnacionales`.`groups` (`idgroup` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `juegosnacionales`.`assignation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `juegosnacionales`.`assignation` (
  `idteam` INT(11) NOT NULL ,
  `idassignationvars` INT NOT NULL ,
  PRIMARY KEY (`idteam`, `idassignationvars`) ,
  INDEX `fk_assignation_team1` (`idteam` ASC) ,
  INDEX `fk_assignation_assignationvars1` (`idassignationvars` ASC) ,
  CONSTRAINT `fk_assignation_team1`
    FOREIGN KEY (`idteam` )
    REFERENCES `juegosnacionales`.`team` (`idteam` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignation_assignationvars1`
    FOREIGN KEY (`idassignationvars` )
    REFERENCES `juegosnacionales`.`assignationvars` (`idassignationvars` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
