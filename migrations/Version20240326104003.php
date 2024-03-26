<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326104003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD adresse LONGTEXT DEFAULT NULL, ADD commune LONGTEXT NOT NULL, ADD text VARCHAR(255) NOT NULL, DROP rue, DROP code_postal, DROP ville, DROP pays, CHANGE employe_id employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD poste VARCHAR(150) DEFAULT NULL, CHANGE nom nom VARCHAR(200) DEFAULT NULL, CHANGE prenom prenom VARCHAR(200) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD rue VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD pays VARCHAR(255) DEFAULT NULL, DROP adresse, DROP commune, DROP text, CHANGE employe_id employe_id INT NOT NULL');
        $this->addSql('ALTER TABLE employe DROP poste, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL');
    }
}
