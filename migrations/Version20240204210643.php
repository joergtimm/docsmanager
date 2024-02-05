<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204210643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_447556F9775DB146 ON actor (actor_key)');
        $this->addSql('ALTER TABLE documents ADD video_actor_id INT NOT NULL');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288B858C0F6 FOREIGN KEY (video_actor_id) REFERENCES video_actors (id)');
        $this->addSql('CREATE INDEX IDX_A2B07288B858C0F6 ON documents (video_actor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_447556F9775DB146 ON actor');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288B858C0F6');
        $this->addSql('DROP INDEX IDX_A2B07288B858C0F6 ON documents');
        $this->addSql('ALTER TABLE documents DROP video_actor_id');
    }
}
