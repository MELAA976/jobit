<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024122945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publica_offre ADD type_contrat_id INT NOT NULL');
        $this->addSql('ALTER TABLE publica_offre ADD CONSTRAINT FK_DD131B43520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('CREATE INDEX IDX_DD131B43520D03A ON publica_offre (type_contrat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publica_offre DROP FOREIGN KEY FK_DD131B43520D03A');
        $this->addSql('DROP INDEX IDX_DD131B43520D03A ON publica_offre');
        $this->addSql('ALTER TABLE publica_offre DROP type_contrat_id');
    }
}
