<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220042718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_client (id INT AUTO_INCREMENT NOT NULL, actor_id INT DEFAULT NULL, client_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3002D7E310DAF24A (actor_id), INDEX IDX_3002D7E319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_client ADD CONSTRAINT FK_3002D7E310DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE actor_client ADD CONSTRAINT FK_3002D7E319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2B07288593A594D ON documents (document_key)');
        $this->addSql('ALTER TABLE user_setting CHANGE is_client_filter is_client_filter TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2CBF396750 ON video (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_client DROP FOREIGN KEY FK_3002D7E310DAF24A');
        $this->addSql('ALTER TABLE actor_client DROP FOREIGN KEY FK_3002D7E319EB6921');
        $this->addSql('DROP TABLE actor_client');
        $this->addSql('DROP INDEX UNIQ_A2B07288593A594D ON documents');
        $this->addSql('ALTER TABLE user_setting CHANGE is_client_filter is_client_filter TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_7CC7DA2CBF396750 ON video');
    }
}
