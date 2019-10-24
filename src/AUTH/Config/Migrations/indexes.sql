ALTER TABLE `auth_sessions`
ADD INDEX `idx_token_check`(`TOKEN`, `ACTIVE`);