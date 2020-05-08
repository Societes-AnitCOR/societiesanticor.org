<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507191920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /** table content */
        $this->addSql('ALTER TABLE content CHANGE secondtext secondtext LONGTEXT DEFAULT NULL, CHANGE othertext othertext LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE content CHANGE content_type content_type VARCHAR(255) NOT NULL');

        /** table company */
        $this->addSql('ALTER TABLE company ADD public_mail VARCHAR(255) DEFAULT NULL, DROP email, DROP roles, DROP password, DROP email_contact, DROP activated, CHANGE branch_id branch_id INT DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE branch_detail branch_detail VARCHAR(255) DEFAULT NULL, CHANGE sector sector VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL');

        /** table user */
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD activated TINYINT(1) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content CHANGE secondtext secondtext LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE othertext othertext LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        // Si il y a des données en string dans content_type, cette requete ci dessous ne passera pas
        $this->addSql('ALTER TABLE content CHANGE content_type content_type TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE content DROP active');

    }
}
