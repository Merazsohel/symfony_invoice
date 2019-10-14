<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191014065731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEECD3DA1');
        $this->addSql('DROP INDEX IDX_D34A04ADEECD3DA1 ON product');
        $this->addSql('ALTER TABLE product DROP sale_detail_id');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT NULL, CHANGE vat vat DOUBLE PRECISION DEFAULT NULL, CHANGE discount discount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE sale_detail ADD product_id INT DEFAULT NULL, ADD invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sale_detail ADD CONSTRAINT FK_5A6771514584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE sale_detail ADD CONSTRAINT FK_5A6771512989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_5A6771514584665A ON sale_detail (product_id)');
        $this->addSql('CREATE INDEX IDX_5A6771512989F1FD ON sale_detail (invoice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE remarks remarks VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE vat vat DOUBLE PRECISION DEFAULT \'NULL\', CHANGE discount discount DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product ADD sale_detail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEECD3DA1 FOREIGN KEY (sale_detail_id) REFERENCES sale_detail (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEECD3DA1 ON product (sale_detail_id)');
        $this->addSql('ALTER TABLE sale_detail DROP FOREIGN KEY FK_5A6771514584665A');
        $this->addSql('ALTER TABLE sale_detail DROP FOREIGN KEY FK_5A6771512989F1FD');
        $this->addSql('DROP INDEX IDX_5A6771514584665A ON sale_detail');
        $this->addSql('DROP INDEX IDX_5A6771512989F1FD ON sale_detail');
        $this->addSql('ALTER TABLE sale_detail DROP product_id, DROP invoice_id');
    }
}
