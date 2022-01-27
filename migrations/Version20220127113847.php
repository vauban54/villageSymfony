<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220127113847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE civilite_contact');
        $this->addSql('ALTER TABLE contact ADD civilite_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63839194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63839194ABF ON contact (civilite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE civilite_contact (civilite_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_E12AB8F839194ABF (civilite_id), INDEX IDX_E12AB8F8E7A1254A (contact_id), PRIMARY KEY(civilite_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE civilite_contact ADD CONSTRAINT FK_E12AB8F839194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE civilite_contact ADD CONSTRAINT FK_E12AB8F8E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63839194ABF');
        $this->addSql('DROP INDEX IDX_4C62E63839194ABF ON contact');
        $this->addSql('ALTER TABLE contact DROP civilite_id');
    }
}
