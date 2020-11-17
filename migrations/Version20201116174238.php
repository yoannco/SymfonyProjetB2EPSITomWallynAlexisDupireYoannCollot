<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116174238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE header_http (id INT AUTO_INCREMENT NOT NULL, idrequete_id INT NOT NULL, cle VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3AFC773FD5524975 (idrequete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE header_http ADD CONSTRAINT FK_3AFC773FD5524975 FOREIGN KEY (idrequete_id) REFERENCES requete_http (id)');
        $this->addSql('DROP TABLE param_http');
        $this->addSql('ALTER TABLE requete_http ADD iduser_id INT NOT NULL');
        $this->addSql('ALTER TABLE requete_http ADD CONSTRAINT FK_E5F2C5F8786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E5F2C5F8786A81FB ON requete_http (iduser_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requete_http DROP FOREIGN KEY FK_E5F2C5F8786A81FB');
        $this->addSql('CREATE TABLE param_http (id INT AUTO_INCREMENT NOT NULL, cle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, valeur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, idrequete VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE header_http');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_E5F2C5F8786A81FB ON requete_http');
        $this->addSql('ALTER TABLE requete_http DROP iduser_id');
    }
}
