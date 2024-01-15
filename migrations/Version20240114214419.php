<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240114214419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production ADD owner_id INT DEFAULT NULL, ADD title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E07E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E07E3C61F9 ON production (owner_id)');
        $this->addSql('ALTER TABLE video ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C7E3C61F9 ON video (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E07E3C61F9');
        $this->addSql('DROP INDEX IDX_D3EDB1E07E3C61F9 ON production');
        $this->addSql('ALTER TABLE production DROP owner_id, DROP title');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C7E3C61F9');
        $this->addSql('DROP INDEX IDX_7CC7DA2C7E3C61F9 ON video');
        $this->addSql('ALTER TABLE video DROP owner_id');
    }
}
