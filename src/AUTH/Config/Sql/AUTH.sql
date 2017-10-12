
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- AUTH_PROVIDERS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `AUTH_PROVIDERS`;

CREATE TABLE `AUTH_PROVIDERS`
(
    `ID_PROVIDER` INTEGER NOT NULL AUTO_INCREMENT,
    `NAME` TINYINT NOT NULL,
    `DEV` TINYINT(1) DEFAULT 1,
    `CLIENT` VARCHAR(100) NOT NULL,
    `SECRET` VARBINARY(100) NOT NULL,
    `PARENT_REF` VARCHAR(50),
    `ACTIVE` TINYINT(1) DEFAULT 1,
    `CUSTOMER_CODE` VARCHAR(50),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `ACCOUNTS` INTEGER,
    PRIMARY KEY (`ID_PROVIDER`),
    UNIQUE INDEX `inq_psfs_auth_provider` (`NAME`, `CLIENT`, `CUSTOMER_CODE`),
    INDEX `idx_providers` (`NAME`, `ACTIVE`, `DEV`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with the login providers';

-- ---------------------------------------------------------------------
-- AUTH_ACCOUNTS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `AUTH_ACCOUNTS`;

CREATE TABLE `AUTH_ACCOUNTS`
(
    `ID_ACCOUNT` INTEGER NOT NULL AUTO_INCREMENT,
    `ID_PROVIDER` INTEGER NOT NULL,
    `IDENTIFIER` VARCHAR(100) NOT NULL,
    `EMAIL` VARCHAR(100),
    `ACCESS_TOKEN` VARCHAR(255) NOT NULL,
    `REFRESH_TOKEN` VARBINARY(255),
    `EXPIRES` DATETIME,
    `ROLE` TINYINT DEFAULT 0,
    `ACTIVE` TINYINT(1) DEFAULT 1,
    `VERIFIED` TINYINT(1) DEFAULT 0,
    `REFRESH_REQUESTED` DATETIME,
    `RESET_TOKEN` VARCHAR(100),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`ID_ACCOUNT`),
    UNIQUE INDEX `unq_accounts_idx` (`ID_PROVIDER`, `IDENTIFIER`),
    INDEX `idx_accounts` (`IDENTIFIER`, `EXPIRES`, `ROLE`, `ACTIVE`),
    CONSTRAINT `fk_account_provider`
        FOREIGN KEY (`ID_PROVIDER`)
        REFERENCES `AUTH_PROVIDERS` (`ID_PROVIDER`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with the login accounts';

-- ---------------------------------------------------------------------
-- AUTH_SESSIONS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `AUTH_SESSIONS`;

CREATE TABLE `AUTH_SESSIONS`
(
    `ID_ACCOUNT` INTEGER NOT NULL,
    `DEVICE` VARCHAR(500) NOT NULL,
    `IP` VARCHAR(50) NOT NULL,
    `TOKEN` VARBINARY(100) NOT NULL,
    `ACTIVE` TINYINT(1) DEFAULT 1,
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `idx_sessions_account` (`IP`, `TOKEN`, `ACTIVE`),
    INDEX `fi_account_session` (`ID_ACCOUNT`),
    CONSTRAINT `fl_account_session`
        FOREIGN KEY (`ID_ACCOUNT`)
        REFERENCES `AUTH_ACCOUNTS` (`ID_ACCOUNT`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with the login session token';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
