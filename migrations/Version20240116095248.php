<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116095248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE tournament_player (id INT AUTO_INCREMENT NOT NULL, tournament_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament_player ADD CONSTRAINT FK_TORUNAMENTID FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE tournament_player ADD CONSTRAINT FK_PLAYERID FOREIGN KEY (player_id) REFERENCES player (id)');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('ALTER TABLE tournament_player DROP FOREIGN KEY FK_TORUNAMENTID');
        $this->addSql('ALTER TABLE tournament_player DROP FOREIGN KEY FK_PLAYERID');
        $this->addSql('DROP TABLE tournament_player');
    }
}
