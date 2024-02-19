<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218224718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE motcles (id INT AUTO_INCREMENT NOT NULL, mc LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motcles_marquepages (motcles_id INT NOT NULL, marquepages_id INT NOT NULL, INDEX IDX_CDBF1AC81863449D (motcles_id), INDEX IDX_CDBF1AC8ED889F4F (marquepages_id), PRIMARY KEY(motcles_id, marquepages_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motcles_marquepages ADD CONSTRAINT FK_CDBF1AC81863449D FOREIGN KEY (motcles_id) REFERENCES motcles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motcles_marquepages ADD CONSTRAINT FK_CDBF1AC8ED889F4F FOREIGN KEY (marquepages_id) REFERENCES marquepages (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motcles_marquepages DROP FOREIGN KEY FK_CDBF1AC81863449D');
        $this->addSql('ALTER TABLE motcles_marquepages DROP FOREIGN KEY FK_CDBF1AC8ED889F4F');
        $this->addSql('DROP TABLE motcles');
        $this->addSql('DROP TABLE motcles_marquepages');
    }
}
