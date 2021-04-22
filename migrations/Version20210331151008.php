<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331151008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ent (id INT AUTO_INCREMENT NOT NULL, nom_ent VARCHAR(255) NOT NULL, mail_ent VARCHAR(255) NOT NULL, site_ent VARCHAR(255) NOT NULL, adresse_ent VARCHAR(255) NOT NULL, num_ent VARCHAR(255) NOT NULL, ville_ent VARCHAR(255) NOT NULL, img_logo_ent VARCHAR(255) NOT NULL, description_ent LONGTEXT NOT NULL, date_creation_ent DATE NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ent');
    }
}
