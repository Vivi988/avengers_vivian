<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325095843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, adresse LONGTEXT DEFAULT NULL, commune LONGTEXT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom LONGTEXT DEFAULT NULL, prenom LONGTEXT DEFAULT NULL, datedenaissance DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) DEFAULT NULL, prenom VARCHAR(200) DEFAULT NULL, poste VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE le_cailloux (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, categorie LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, annee DATETIME DEFAULT NULL, titre LONGTEXT DEFAULT NULL, INDEX IDX_AC634F9960BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motcles_marquepages (motcles_id INT NOT NULL, marquepages_id INT NOT NULL, INDEX IDX_CDBF1AC81863449D (motcles_id), INDEX IDX_CDBF1AC8ED889F4F (marquepages_id), PRIMARY KEY(motcles_id, marquepages_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9960BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE motcles_marquepages ADD CONSTRAINT FK_CDBF1AC81863449D FOREIGN KEY (motcles_id) REFERENCES motcles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motcles_marquepages ADD CONSTRAINT FK_CDBF1AC8ED889F4F FOREIGN KEY (marquepages_id) REFERENCES marquepages (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE url');
        $this->addSql('ALTER TABLE motcles ADD mc LONGTEXT DEFAULT NULL, DROP motcles, DROP manyto_many');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE url (id INT AUTO_INCREMENT NOT NULL, commentaire LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, datecreation DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9960BB6FE6');
        $this->addSql('ALTER TABLE motcles_marquepages DROP FOREIGN KEY FK_CDBF1AC81863449D');
        $this->addSql('ALTER TABLE motcles_marquepages DROP FOREIGN KEY FK_CDBF1AC8ED889F4F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE le_cailloux');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE motcles_marquepages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE motcles ADD motcles INT DEFAULT NULL, ADD manyto_many VARCHAR(255) NOT NULL, DROP mc');
    }
}
