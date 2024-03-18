<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318025607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_job (user_id INT NOT NULL, job_id INT NOT NULL, PRIMARY KEY(user_id, job_id))');
        $this->addSql('CREATE INDEX IDX_10CE8173A76ED395 ON user_job (user_id)');
        $this->addSql('CREATE INDEX IDX_10CE8173BE04EA9 ON user_job (job_id)');
        $this->addSql('ALTER TABLE user_job ADD CONSTRAINT FK_10CE8173A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_job ADD CONSTRAINT FK_10CE8173BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX idx_fbd8e0f838b53c32 RENAME TO IDX_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE "user" ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON "user" (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_job DROP CONSTRAINT FK_10CE8173A76ED395');
        $this->addSql('ALTER TABLE user_job DROP CONSTRAINT FK_10CE8173BE04EA9');
        $this->addSql('DROP TABLE user_job');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649979B1AD6');
        $this->addSql('DROP INDEX IDX_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE "user" DROP company_id');
        $this->addSql('ALTER INDEX idx_fbd8e0f8979b1ad6 RENAME TO idx_fbd8e0f838b53c32');
    }
}
