<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614144437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_films (actor_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_EA6821C510DAF24A (actor_id), INDEX IDX_EA6821C5939610EE (films_id), PRIMARY KEY(actor_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_series (actor_id INT NOT NULL, series_id INT NOT NULL, INDEX IDX_CD56D29B10DAF24A (actor_id), INDEX IDX_CD56D29B5278319C (series_id), PRIMARY KEY(actor_id, series_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, INDEX IDX_CEECCA5112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_actor (films_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_ADA2D487939610EE (films_id), INDEX IDX_ADA2D48710DAF24A (actor_id), PRIMARY KEY(films_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, series_id INT NOT NULL, number INT NOT NULL, synopsis LONGTEXT DEFAULT NULL, INDEX IDX_F0E45BA95278319C (series_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, INDEX IDX_3A10012D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series_actor (series_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_31FAB2E45278319C (series_id), INDEX IDX_31FAB2E410DAF24A (actor_id), PRIMARY KEY(series_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_films ADD CONSTRAINT FK_EA6821C510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_films ADD CONSTRAINT FK_EA6821C5939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_series ADD CONSTRAINT FK_CD56D29B10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_series ADD CONSTRAINT FK_CD56D29B5278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA5112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE films_actor ADD CONSTRAINT FK_ADA2D487939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_actor ADD CONSTRAINT FK_ADA2D48710DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA95278319C FOREIGN KEY (series_id) REFERENCES series (id)');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE series_actor ADD CONSTRAINT FK_31FAB2E45278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_actor ADD CONSTRAINT FK_31FAB2E410DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_films DROP FOREIGN KEY FK_EA6821C510DAF24A');
        $this->addSql('ALTER TABLE actor_films DROP FOREIGN KEY FK_EA6821C5939610EE');
        $this->addSql('ALTER TABLE actor_series DROP FOREIGN KEY FK_CD56D29B10DAF24A');
        $this->addSql('ALTER TABLE actor_series DROP FOREIGN KEY FK_CD56D29B5278319C');
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA5112469DE2');
        $this->addSql('ALTER TABLE films_actor DROP FOREIGN KEY FK_ADA2D487939610EE');
        $this->addSql('ALTER TABLE films_actor DROP FOREIGN KEY FK_ADA2D48710DAF24A');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA95278319C');
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012D12469DE2');
        $this->addSql('ALTER TABLE series_actor DROP FOREIGN KEY FK_31FAB2E45278319C');
        $this->addSql('ALTER TABLE series_actor DROP FOREIGN KEY FK_31FAB2E410DAF24A');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE actor_films');
        $this->addSql('DROP TABLE actor_series');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_actor');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE series_actor');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
