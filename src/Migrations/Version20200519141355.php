<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519141355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD created_at INT NOT NULL DEFAULT 0, ADD updated_at INT NOT NULL DEFAULT 0');
        $this->addSql('ALTER TABLE company ADD owner_id INT DEFAULT NULL, ADD created_at INT NOT NULL DEFAULT 0, ADD updated_at INT NOT NULL DEFAULT 0');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_company_owner_ref_user_id FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_company_owner_id ON company (owner_id)');
        $this->addSql('ALTER TABLE company RENAME INDEX name_unique TO UNIQ_company_name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_company_owner_ref_user_id');
        $this->addSql('DROP INDEX IDX_company_owner_id ON company');
        $this->addSql('ALTER TABLE company DROP owner_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE company RENAME INDEX uniq_company_name TO name_unique');
        $this->addSql('ALTER TABLE user DROP created_at, DROP updated_at');
    }
}
