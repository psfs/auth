ALTER TABLE `auth_providers`
ADD COLUMN `SCOPES` varchar(1000) NULL AFTER `ACCOUNTS`;