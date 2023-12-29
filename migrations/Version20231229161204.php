<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231229161204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recurrence ADD liste_attente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recurrence ADD CONSTRAINT FK_1FB7F22138CAC769 FOREIGN KEY (liste_attente_id) REFERENCES liste_dattente (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1FB7F22138CAC769 ON recurrence (liste_attente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recurrence DROP FOREIGN KEY FK_1FB7F22138CAC769');
        $this->addSql('DROP INDEX IDX_1FB7F22138CAC769 ON recurrence');
        $this->addSql('ALTER TABLE recurrence DROP liste_attente_id');
    }
}
