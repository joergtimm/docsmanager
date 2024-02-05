<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202180341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_participiant (id INT AUTO_INCREMENT NOT NULL, video_id INT NOT NULL, actor_id INT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_303B61F729C1004E (video_id), INDEX IDX_303B61F710DAF24A (actor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_participiant ADD CONSTRAINT FK_303B61F729C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_participiant ADD CONSTRAINT FK_303B61F710DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_participiant DROP FOREIGN KEY FK_303B61F729C1004E');
        $this->addSql('ALTER TABLE video_participiant DROP FOREIGN KEY FK_303B61F710DAF24A');
        $this->addSql('DROP TABLE video_participiant');
    }
}
