<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318215550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, iso2 VARCHAR(10) DEFAULT NULL, iso3 VARCHAR(10) DEFAULT NULL, tldomain VARCHAR(20) DEFAULT NULL, fips VARCHAR(20) DEFAULT NULL, isonumber INT DEFAULT NULL, geo_name_id INT DEFAULT NULL, e164 INT DEFAULT NULL, phone_code VARCHAR(20) DEFAULT NULL, continent VARCHAR(100) DEFAULT NULL, capital VARCHAR(100) DEFAULT NULL, time_zone_capital VARCHAR(100) DEFAULT NULL, currency VARCHAR(100) DEFAULT NULL, language_codes JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', area INT DEFAULT NULL, mobile_phones INT DEFAULT NULL, landline_phones INT DEFAULT NULL, gdp INT DEFAULT NULL, flag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE country');
    }
}
