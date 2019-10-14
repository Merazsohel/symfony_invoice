<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191014061944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD42C677BC');
        $this->addSql('CREATE TABLE sale_detail (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, unitprice DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE invoice_details');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D34A04AD42C677BC ON product');
        $this->addSql('ALTER TABLE product ADD sale_detail_id INT DEFAULT NULL, DROP invoice_details_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEECD3DA1 FOREIGN KEY (sale_detail_id) REFERENCES sale_detail (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEECD3DA1 ON product (sale_detail_id)');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT NULL, CHANGE vat vat DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEECD3DA1');
        $this->addSql('CREATE TABLE invoice_details (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, unitprice DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE sale_detail');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE vat vat DOUBLE PRECISION DEFAULT \'NULL\', CHANGE discount discount DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX IDX_D34A04ADEECD3DA1 ON product');
        $this->addSql('ALTER TABLE product ADD invoice_details_id INT DEFAULT NULL, DROP sale_detail_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD42C677BC FOREIGN KEY (invoice_details_id) REFERENCES invoice_details (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD42C677BC ON product (invoice_details_id)');
    }
}
