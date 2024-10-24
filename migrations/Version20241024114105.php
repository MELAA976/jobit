<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024114105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publica_offre ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE publica_offre ADD CONSTRAINT FK_DD131B4312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DD131B4312469DE2 ON publica_offre (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publica_offre DROP FOREIGN KEY FK_DD131B4312469DE2');
        $this->addSql('DROP INDEX IDX_DD131B4312469DE2 ON publica_offre');
        $this->addSql('ALTER TABLE publica_offre DROP category_id');
    }
}
