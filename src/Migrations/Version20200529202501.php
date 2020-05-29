<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529202501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE created_at created_at INT NOT NULL, CHANGE updated_at updated_at INT NOT NULL');
        $this->addSql('ALTER TABLE company RENAME INDEX uniq_company_name TO UNIQ_4FBF094F5E237E06');
        $this->addSql('ALTER TABLE company RENAME INDEX idx_company_owner_id TO IDX_4FBF094F7E3C61F9');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at INT NOT NULL, CHANGE updated_at updated_at INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE created_at created_at INT DEFAULT 0 NOT NULL, CHANGE updated_at updated_at INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE company RENAME INDEX idx_4fbf094f7e3c61f9 TO IDX_company_owner_id');
        $this->addSql('ALTER TABLE company RENAME INDEX uniq_4fbf094f5e237e06 TO UNIQ_company_name');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at INT DEFAULT 0 NOT NULL, CHANGE updated_at updated_at INT DEFAULT 0 NOT NULL');
    }
}
