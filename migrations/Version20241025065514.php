<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025065514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, lieu VARCHAR(255) NOT NULL, site_web VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_user (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, user_id INT NOT NULL, date_candidature DATE NOT NULL, INDEX IDX_CFC1683D4CC8505A (offre_id), INDEX IDX_CFC1683DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publica_offre (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, type_contrat_id INT NOT NULL, intituler VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_publication DATE NOT NULL, date_modification DATE DEFAULT NULL, lieu VARCHAR(255) NOT NULL, duree VARCHAR(255) DEFAULT NULL, INDEX IDX_DD131B4312469DE2 (category_id), INDEX IDX_DD131B43A76ED395 (user_id), INDEX IDX_DD131B43520D03A (type_contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D649A4AEAFEA (entreprise_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_user ADD CONSTRAINT FK_CFC1683D4CC8505A FOREIGN KEY (offre_id) REFERENCES publica_offre (id)');
        $this->addSql('ALTER TABLE offre_user ADD CONSTRAINT FK_CFC1683DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publica_offre ADD CONSTRAINT FK_DD131B4312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE publica_offre ADD CONSTRAINT FK_DD131B43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publica_offre ADD CONSTRAINT FK_DD131B43520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_user DROP FOREIGN KEY FK_CFC1683D4CC8505A');
        $this->addSql('ALTER TABLE offre_user DROP FOREIGN KEY FK_CFC1683DA76ED395');
        $this->addSql('ALTER TABLE publica_offre DROP FOREIGN KEY FK_DD131B4312469DE2');
        $this->addSql('ALTER TABLE publica_offre DROP FOREIGN KEY FK_DD131B43A76ED395');
        $this->addSql('ALTER TABLE publica_offre DROP FOREIGN KEY FK_DD131B43520D03A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A4AEAFEA');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE offre_user');
        $this->addSql('DROP TABLE publica_offre');
        $this->addSql('DROP TABLE type_contrat');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
