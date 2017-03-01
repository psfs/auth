
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
    `ACTIVE` TINYINT(1) DEFAULT 1,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `ACCOUNTS` INTEGER,
    PRIMARY KEY (`ID_PROVIDER`),
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
    `ACCESS_TOKEN` VARCHAR(255) NOT NULL,
    `REFRESH_TOKEN` VARBINARY(255),
    `EXPIRES` DATETIME,
    `ROLE` TINYINT DEFAULT 0,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`ID_ACCOUNT`),
    UNIQUE INDEX `unq_accounts_idx` (`ID_PROVIDER`, `IDENTIFIER`),
    INDEX `idx_accounts` (`IDENTIFIER`, `EXPIRES`, `ROLE`),
    CONSTRAINT `fk_account_provider`
        FOREIGN KEY (`ID_PROVIDER`)
        REFERENCES `AUTH_PROVIDERS` (`ID_PROVIDER`)
) ENGINE=InnoDB CHARACTER SET='utf8' COMMENT='Table with the login accounts';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
