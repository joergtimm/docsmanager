<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115111739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_setting (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, client_in_use_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_C779A692A76ED395 (user_id), INDEX IDX_C779A6929D70C5F7 (client_in_use_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_setting ADD CONSTRAINT FK_C779A692A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_setting ADD CONSTRAINT FK_C779A6929D70C5F7 FOREIGN KEY (client_in_use_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_setting DROP FOREIGN KEY FK_C779A692A76ED395');
        $this->addSql('ALTER TABLE user_setting DROP FOREIGN KEY FK_C779A6929D70C5F7');
        $this->addSql('DROP TABLE user_setting');
    }
}
