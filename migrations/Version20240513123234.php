<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513123234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chevre_groupe_traitement DROP CONSTRAINT FK_9A8717EA92F637E3');
        $this->addSql('ALTER TABLE chevre_groupe_traitement ADD CONSTRAINT FK_9A8717EA92F637E3 FOREIGN KEY (chevre_id) REFERENCES chevre (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE chevre_groupe_traitement DROP CONSTRAINT fk_9a8717ea92f637e3');
        $this->addSql('ALTER TABLE chevre_groupe_traitement ADD CONSTRAINT fk_9a8717ea92f637e3 FOREIGN KEY (chevre_id) REFERENCES chevre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
