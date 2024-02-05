<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202170255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288C0C2FD67');
        $this->addSql('ALTER TABLE video_docs DROP FOREIGN KEY FK_56C0766B29C1004E');
        $this->addSql('ALTER TABLE video_docs DROP FOREIGN KEY FK_56C0766BC33F7837');
        $this->addSql('DROP TABLE video_docs');
        $this->addSql('DROP INDEX IDX_A2B07288C0C2FD67 ON documents');
        $this->addSql('ALTER TABLE documents DROP video_docs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_docs (id INT AUTO_INCREMENT NOT NULL, video_id INT NOT NULL, document_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_56C0766B29C1004E (video_id), UNIQUE INDEX UNIQ_56C0766BC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE video_docs ADD CONSTRAINT FK_56C0766B29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_docs ADD CONSTRAINT FK_56C0766BC33F7837 FOREIGN KEY (document_id) REFERENCES documents (id)');
        $this->addSql('ALTER TABLE documents ADD video_docs_id INT NOT NULL');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288C0C2FD67 FOREIGN KEY (video_docs_id) REFERENCES video_docs (id)');
        $this->addSql('CREATE INDEX IDX_A2B07288C0C2FD67 ON documents (video_docs_id)');
    }
}
