<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111193922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_actors (id INT AUTO_INCREMENT NOT NULL, video_id INT DEFAULT NULL, actor_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E77C502829C1004E (video_id), INDEX IDX_E77C502810DAF24A (actor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_actors ADD CONSTRAINT FK_E77C502829C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_actors ADD CONSTRAINT FK_E77C502810DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_actors DROP FOREIGN KEY FK_E77C502829C1004E');
        $this->addSql('ALTER TABLE video_actors DROP FOREIGN KEY FK_E77C502810DAF24A');
        $this->addSql('DROP TABLE video_actors');
    }
}
