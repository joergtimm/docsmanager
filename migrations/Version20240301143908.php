<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301143908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message_send_log (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', result VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE push_message (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, video_id INT DEFAULT NULL, document_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', state VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_8DF8AA6619EB6921 (client_id), INDEX IDX_8DF8AA6629C1004E (video_id), INDEX IDX_8DF8AA66C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE push_message ADD CONSTRAINT FK_8DF8AA6619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE push_message ADD CONSTRAINT FK_8DF8AA6629C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE push_message ADD CONSTRAINT FK_8DF8AA66C33F7837 FOREIGN KEY (document_id) REFERENCES documents (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE push_message DROP FOREIGN KEY FK_8DF8AA6619EB6921');
        $this->addSql('ALTER TABLE push_message DROP FOREIGN KEY FK_8DF8AA6629C1004E');
        $this->addSql('ALTER TABLE push_message DROP FOREIGN KEY FK_8DF8AA66C33F7837');
        $this->addSql('DROP TABLE message_send_log');
        $this->addSql('DROP TABLE push_message');
    }
}
