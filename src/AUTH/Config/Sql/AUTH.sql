
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
    `NAME` TINYINT NOT NULL COMMENT 'Different kind of oauth social network',
    `DEV` TINYINT(1) DEFAULT 1 COMMENT 'Flag to define if the provider is for dev purposes',
    `CLIENT` VARCHAR(100) NOT NULL COMMENT 'Client id for the provider',
    `SECRET` VARBINARY(100) NOT NULL COMMENT 'Secret for the client id',
    `PARENT_REF` VARCHAR(50),
    `SCOPES` VARCHAR(1000),
    `ACTIVE` TINYINT(1) DEFAULT 1,
    `CUSTOMER_CODE` VARCHAR(50),
    `EXPIRATION` TINYINT DEFAULT 0 NOT NULL COMMENT 'Expiration mode for passwords',
    `EXPIRATION_PERIOD` INTEGER(3),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `ACCOUNTS` INTEGER,
    PRIMARY KEY (`ID_PROVIDER`),
    UNIQUE INDEX `unq_psfs_auth_provider` (`NAME`, `CLIENT`, `CUSTOMER_CODE`),
    INDEX `idx_providers` (`NAME`, `ACTIVE`, `DEV`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with the login providers';

-- ---------------------------------------------------------------------
-- AUTH_PATHS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `AUTH_PATHS`;

CREATE TABLE `AUTH_PATHS`
(
    `ID_PATH` INTEGER NOT NULL AUTO_INCREMENT,
    `ID_PROVIDER` INTEGER NOT NULL,
    `TYPE` TINYINT DEFAULT 0 NOT NULL COMMENT 'Type of path',
    `PATH` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`ID_PATH`),
    INDEX `fi_path_provider` (`ID_PROVIDER`),
    CONSTRAINT `fk_path_provider`
        FOREIGN KEY (`ID_PROVIDER`)
        REFERENCES `AUTH_PROVIDERS` (`ID_PROVIDER`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Customer provider paths to redirect';

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
-- AUTH_ACCOUNT_PASSWORDS
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `AUTH_ACCOUNT_PASSWORDS`;

CREATE TABLE `AUTH_ACCOUNT_PASSWORDS`
(
    `ID_PASSWORD` INTEGER NOT NULL AUTO_INCREMENT,
    `ID_ACCOUNT` INTEGER NOT NULL,
    `VALUE` VARBINARY(100) NOT NULL,
    `EXPIRATION_DATE` DATETIME NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`ID_PASSWORD`),
    INDEX `fi_account_passwords` (`ID_ACCOUNT`),
    CONSTRAINT `fk_account_passwords`
        FOREIGN KEY (`ID_ACCOUNT`)
        REFERENCES `AUTH_ACCOUNTS` (`ID_ACCOUNT`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with an history for account passwords';

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
