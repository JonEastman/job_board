<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318024848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F838B53C32 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBD8E0F838B53C32 ON job (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE job DROP CONSTRAINT FK_FBD8E0F838B53C32');
        $this->addSql('DROP INDEX IDX_FBD8E0F838B53C32');
        $this->addSql('ALTER TABLE job DROP company_id');
    }
}
