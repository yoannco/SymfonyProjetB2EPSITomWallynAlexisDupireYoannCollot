<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114134434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametre_http (id INT AUTO_INCREMENT NOT NULL, idrequete_id INT NOT NULL, cle VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_84DC9ED4D5524975 (idrequete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parametre_http ADD CONSTRAINT FK_84DC9ED4D5524975 FOREIGN KEY (idrequete_id) REFERENCES requete_http (id)');
        $this->addSql('DROP TABLE requete');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE requete (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE parametre_http');
    }
}
