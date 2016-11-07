
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Auth_ACCOUNTS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Auth_ACCOUNTS`;

CREATE TABLE `Auth_ACCOUNTS`
(
    `ID_ACCOUNT` INTEGER NOT NULL AUTO_INCREMENT,
    `ID_USER` INTEGER(11) NOT NULL,
    `ID_EXTERNAL` VARCHAR(255) NOT NULL,
    `TYPE` INTEGER(1) DEFAULT 0,
    `ACCESS_TOKEN` VARCHAR(255) NOT NULL,
    `REFRESH_TOKEN` VARCHAR(255),
    `EXPIRES` VARCHAR(10) DEFAULT '0',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`ID_ACCOUNT`),
    UNIQUE INDEX `auth_accounts_unique_idx` (`TYPE`, `ID_EXTERNAL`),
    INDEX `auth_accounts_idx` (`ID_EXTERNAL`, `ID_USER`, `TYPE`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table that stores the accounts associated to the social network';

-- ---------------------------------------------------------------------
-- Auth_SESSIONS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Auth_SESSIONS`;

CREATE TABLE `Auth_SESSIONS`
(
    `ID_SESSION` INTEGER NOT NULL AUTO_INCREMENT,
    `ID_USER` INTEGER(11) NOT NULL,
    `IP` VARCHAR(15) NOT NULL,
    `TOKEN` VARCHAR(100) NOT NULL,
    `REFRESH_TOKEN` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`ID_SESSION`),
    UNIQUE INDEX `auth_sessions_unique_idx` (`TOKEN`),
    INDEX `auth_sessions_idx` (`TOKEN`, `REFRESH_TOKEN`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table that stores the active sessions for users';

-- ---------------------------------------------------------------------
-- Auth_ACCOUNTS_archive
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Auth_ACCOUNTS_archive`;

CREATE TABLE `Auth_ACCOUNTS_archive`
(
    `ID_ACCOUNT` INTEGER NOT NULL,
    `ID_USER` INTEGER(11) NOT NULL,
    `ID_EXTERNAL` VARCHAR(255) NOT NULL,
    `TYPE` INTEGER(1) DEFAULT 0,
    `ACCESS_TOKEN` VARCHAR(255) NOT NULL,
    `REFRESH_TOKEN` VARCHAR(255),
    `EXPIRES` VARCHAR(10) DEFAULT '0',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `archived_at` DATETIME,
    PRIMARY KEY (`ID_ACCOUNT`),
    INDEX `auth_accounts_idx` (`ID_EXTERNAL`, `ID_USER`, `TYPE`),
    INDEX `Auth_ACCOUNTS_archive_i_c0cddb` (`TYPE`, `ID_EXTERNAL`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- Auth_SESSIONS_archive
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Auth_SESSIONS_archive`;

CREATE TABLE `Auth_SESSIONS_archive`
(
    `ID_SESSION` INTEGER NOT NULL,
    `ID_USER` INTEGER(11) NOT NULL,
    `IP` VARCHAR(15) NOT NULL,
    `TOKEN` VARCHAR(100) NOT NULL,
    `REFRESH_TOKEN` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `archived_at` DATETIME,
    PRIMARY KEY (`ID_SESSION`),
    INDEX `auth_sessions_idx` (`TOKEN`, `REFRESH_TOKEN`),
    INDEX `Auth_SESSIONS_archive_i_5541c6` (`TOKEN`)
) ENGINE=InnoDB CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
