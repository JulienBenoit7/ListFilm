<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240719154532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_films DROP FOREIGN KEY FK_EA6821C510DAF24A');
        $this->addSql('ALTER TABLE actor_films DROP FOREIGN KEY FK_EA6821C5939610EE');
        $this->addSql('ALTER TABLE actor_series DROP FOREIGN KEY FK_CD56D29B10DAF24A');
        $this->addSql('ALTER TABLE actor_series DROP FOREIGN KEY FK_CD56D29B5278319C');
        $this->addSql('DROP TABLE actor_films');
        $this->addSql('DROP TABLE actor_series');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_films (actor_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_EA6821C510DAF24A (actor_id), INDEX IDX_EA6821C5939610EE (films_id), PRIMARY KEY(actor_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE actor_series (actor_id INT NOT NULL, series_id INT NOT NULL, INDEX IDX_CD56D29B5278319C (series_id), INDEX IDX_CD56D29B10DAF24A (actor_id), PRIMARY KEY(actor_id, series_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actor_films ADD CONSTRAINT FK_EA6821C510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_films ADD CONSTRAINT FK_EA6821C5939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_series ADD CONSTRAINT FK_CD56D29B10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_series ADD CONSTRAINT FK_CD56D29B5278319C FOREIGN KEY (series_id) REFERENCES series (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
