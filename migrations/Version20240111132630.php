<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111132630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE setting ADD background_url VARCHAR(255) DEFAULT NULL, ADD player_card VARCHAR(255) DEFAULT NULL, ADD textcolor VARCHAR(255) DEFAULT NULL, ADD wincolor VARCHAR(255) DEFAULT NULL, ADD loosecolor VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD `current_time` DATETIME DEFAULT NULL, ADD statistics LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE team ADD name VARCHAR(255) DEFAULT NULL, ADD teamleader VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('ALTER TABLE setting DROP background_url, DROP player_card, DROP textcolor, DROP wincolor, DROP loosecolor');
        $this->addSql('ALTER TABLE statistic DROP `current_time`, DROP statistics');
        $this->addSql('ALTER TABLE team DROP name, DROP teamleader');
    }
}
