<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126212225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE civilite (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE civilite_contact (civilite_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_E12AB8F839194ABF (civilite_id), INDEX IDX_E12AB8F8E7A1254A (contact_id), PRIMARY KEY(civilite_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, motif_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, e_mail VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_4C62E638D0EEB819 (motif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE civilite_contact ADD CONSTRAINT FK_E12AB8F839194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE civilite_contact ADD CONSTRAINT FK_E12AB8F8E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638D0EEB819 FOREIGN KEY (motif_id) REFERENCES motif (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE civilite_contact DROP FOREIGN KEY FK_E12AB8F839194ABF');
        $this->addSql('ALTER TABLE civilite_contact DROP FOREIGN KEY FK_E12AB8F8E7A1254A');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638D0EEB819');
        $this->addSql('DROP TABLE civilite');
        $this->addSql('DROP TABLE civilite_contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE motif');
    }
}
