<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107191018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video ADD update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD metadata JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', ADD mime_type VARCHAR(255) DEFAULT NULL, ADD is_h264 TINYINT(1) DEFAULT NULL, ADD is_h265 TINYINT(1) DEFAULT NULL, ADD video_key BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video DROP update_at, DROP metadata, DROP mime_type, DROP is_h264, DROP is_h265, DROP video_key');
    }
}
