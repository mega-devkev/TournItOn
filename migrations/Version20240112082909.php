<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240112082909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player ADD team_id_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD playernumber INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_98197A65B842D717 ON player (team_id_id)');
        $this->addSql('ALTER TABLE statistic ADD tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_649B469C33D1A3E7 ON statistic (tournament_id)');
        $this->addSql('ALTER TABLE tournament ADD main_sponsor_id INT DEFAULT NULL, ADD seetings_id_id INT DEFAULT NULL, ADD start_time DATETIME DEFAULT NULL, ADD end_time DATETIME DEFAULT NULL, ADD location VARCHAR(255) DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD logo_url VARCHAR(255) DEFAULT NULL, ADD secondary_sponsor LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D92A0F8F32 FOREIGN KEY (main_sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D95020798D FOREIGN KEY (seetings_id_id) REFERENCES setting (id)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D92A0F8F32 ON tournament (main_sponsor_id)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D95020798D ON tournament (seetings_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C33D1A3E7');
        $this->addSql('DROP INDEX IDX_649B469C33D1A3E7 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP tournament_id');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65B842D717');
        $this->addSql('DROP INDEX IDX_98197A65B842D717 ON player');
        $this->addSql('ALTER TABLE player DROP team_id_id, DROP name, DROP playernumber');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D92A0F8F32');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D95020798D');
        $this->addSql('DROP INDEX IDX_BD5FB8D92A0F8F32 ON tournament');
        $this->addSql('DROP INDEX IDX_BD5FB8D95020798D ON tournament');
        $this->addSql('ALTER TABLE tournament DROP main_sponsor_id, DROP seetings_id_id, DROP start_time, DROP end_time, DROP location, DROP name, DROP logo_url, DROP secondary_sponsor');
    }
}
