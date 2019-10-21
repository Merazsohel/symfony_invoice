<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021074845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(254) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C2502824F85E0677 (username), UNIQUE INDEX UNIQ_C2502824E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT NULL, CHANGE vat vat DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice_detail CHANGE product_id product_id INT DEFAULT NULL, CHANGE invoice_id invoice_id INT DEFAULT NULL, CHANGE unitprice unitprice DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE vat vat DOUBLE PRECISION DEFAULT \'NULL\', CHANGE discount discount DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE invoice_detail CHANGE product_id product_id INT DEFAULT NULL, CHANGE invoice_id invoice_id INT DEFAULT NULL, CHANGE unitprice unitprice DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
