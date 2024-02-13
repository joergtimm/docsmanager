<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213172136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documents ADD image_mime_type VARCHAR(255) DEFAULT NULL, ADD image_original_name VARCHAR(255) DEFAULT NULL, ADD image_dimensions VARCHAR(255) DEFAULT NULL, CHANGE type type ENUM(\'id_shot\', \'id_card_front\', \'id_card_back\', \'contract\') NOT NULL COMMENT \'(DC2Type:enumdoctype)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documents DROP image_mime_type, DROP image_original_name, DROP image_dimensions, CHANGE type type VARCHAR(50) NOT NULL');
    }
}
