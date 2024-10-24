<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024114834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_user ADD offre_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_user ADD CONSTRAINT FK_CFC1683D4CC8505A FOREIGN KEY (offre_id) REFERENCES publica_offre (id)');
        $this->addSql('CREATE INDEX IDX_CFC1683D4CC8505A ON offre_user (offre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_user DROP FOREIGN KEY FK_CFC1683D4CC8505A');
        $this->addSql('DROP INDEX IDX_CFC1683D4CC8505A ON offre_user');
        $this->addSql('ALTER TABLE offre_user DROP offre_id');
    }
}
