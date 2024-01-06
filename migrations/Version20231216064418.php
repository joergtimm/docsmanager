<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216064418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, token_id INT NOT NULL, type VARCHAR(50) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', file VARCHAR(255) DEFAULT NULL, is_valid TINYINT(1) DEFAULT NULL, description LONGTEXT DEFAULT NULL, myme VARCHAR(255) DEFAULT NULL, originalname VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, participant VARCHAR(255) DEFAULT NULL, con_id INT DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE production ADD producer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E089B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E089B658FE ON production (producer_id)');
        $this->addSql('ALTER TABLE video ADD production_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CECC6147F ON video (production_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E089B658FE');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE producer');
        $this->addSql('DROP INDEX IDX_D3EDB1E089B658FE ON production');
        $this->addSql('ALTER TABLE production DROP producer_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CECC6147F');
        $this->addSql('DROP INDEX IDX_7CC7DA2CECC6147F ON video');
        $this->addSql('ALTER TABLE video DROP production_id');
    }
}
