<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115005040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B117E3C61F9');
        $this->addSql('DROP INDEX UNIQ_D79F6B117E3C61F9 ON participant');
        $this->addSql('ALTER TABLE participant DROP owner_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B117E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B117E3C61F9 ON participant (owner_id)');
    }
}
