<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130184524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, born_at DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, profilepic VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, client_key BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_blocks (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_view (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, gridlist VARCHAR(20) NOT NULL, search_probs JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_45B2606CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, video_docs_id INT NOT NULL, type VARCHAR(50) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_valid TINYINT(1) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', pdf_name VARCHAR(255) DEFAULT NULL, pdf_size INT DEFAULT NULL, gen_file_name VARCHAR(255) DEFAULT NULL, mime_type VARCHAR(255) DEFAULT NULL, INDEX IDX_A2B07288C0C2FD67 (video_docs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(191) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(191) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(191) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), INDEX general_translations_lookup_idx (object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE mandnat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, con_id INT NOT NULL, custom_nr VARCHAR(255) DEFAULT NULL, status VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, video_id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, born_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', birth_name VARCHAR(255) DEFAULT NULL, id_type VARCHAR(30) NOT NULL, id_number VARCHAR(100) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D79F6B1129C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, participant VARCHAR(255) DEFAULT NULL, con_id INT DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, producer_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, begin_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_D3EDB1E089B658FE (producer_id), INDEX IDX_D3EDB1E07E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_setting (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, client_in_use_id INT DEFAULT NULL, is_client_filter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C779A692A76ED395 (user_id), INDEX IDX_C779A6929D70C5F7 (client_in_use_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, production_id INT DEFAULT NULL, owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', isverrifyted TINYINT(1) NOT NULL, update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', metadata JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', mime_type VARCHAR(255) DEFAULT NULL, is_h264 TINYINT(1) DEFAULT NULL, is_h265 TINYINT(1) DEFAULT NULL, video_key BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', thumb VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7CC7DA2C70096EAD (video_key), INDEX IDX_7CC7DA2CECC6147F (production_id), INDEX IDX_7CC7DA2C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_actors (id INT AUTO_INCREMENT NOT NULL, video_id INT DEFAULT NULL, actor_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E77C502829C1004E (video_id), INDEX IDX_E77C502810DAF24A (actor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_docs (id INT AUTO_INCREMENT NOT NULL, video_id INT NOT NULL, document_id INT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_56C0766B29C1004E (video_id), UNIQUE INDEX UNIQ_56C0766BC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE data_view ADD CONSTRAINT FK_45B2606CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288C0C2FD67 FOREIGN KEY (video_docs_id) REFERENCES video_docs (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1129C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E089B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E07E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user_setting ADD CONSTRAINT FK_C779A692A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_setting ADD CONSTRAINT FK_C779A6929D70C5F7 FOREIGN KEY (client_in_use_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE video_actors ADD CONSTRAINT FK_E77C502829C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_actors ADD CONSTRAINT FK_E77C502810DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE video_docs ADD CONSTRAINT FK_56C0766B29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_docs ADD CONSTRAINT FK_56C0766BC33F7837 FOREIGN KEY (document_id) REFERENCES documents (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data_view DROP FOREIGN KEY FK_45B2606CA76ED395');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288C0C2FD67');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1129C1004E');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E089B658FE');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E07E3C61F9');
        $this->addSql('ALTER TABLE user_setting DROP FOREIGN KEY FK_C779A692A76ED395');
        $this->addSql('ALTER TABLE user_setting DROP FOREIGN KEY FK_C779A6929D70C5F7');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CECC6147F');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C7E3C61F9');
        $this->addSql('ALTER TABLE video_actors DROP FOREIGN KEY FK_E77C502829C1004E');
        $this->addSql('ALTER TABLE video_actors DROP FOREIGN KEY FK_E77C502810DAF24A');
        $this->addSql('ALTER TABLE video_docs DROP FOREIGN KEY FK_56C0766B29C1004E');
        $this->addSql('ALTER TABLE video_docs DROP FOREIGN KEY FK_56C0766BC33F7837');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contract_blocks');
        $this->addSql('DROP TABLE data_view');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE mandnat');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE producer');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_setting');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE video_actors');
        $this->addSql('DROP TABLE video_docs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
