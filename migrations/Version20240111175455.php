<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111175455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_actor DROP FOREIGN KEY FK_CB175F5B29C1004E');
        $this->addSql('ALTER TABLE video_actor DROP FOREIGN KEY FK_CB175F5B10DAF24A');
        $this->addSql('DROP TABLE video_actor');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_actor (video_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_CB175F5B29C1004E (video_id), INDEX IDX_CB175F5B10DAF24A (actor_id), PRIMARY KEY(video_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE video_actor ADD CONSTRAINT FK_CB175F5B29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_actor ADD CONSTRAINT FK_CB175F5B10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
    }
}
