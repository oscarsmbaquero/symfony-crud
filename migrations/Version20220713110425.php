<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713110425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE songs (id INT AUTO_INCREMENT NOT NULL, extremoduro_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_BAECB19B7658C15F (extremoduro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19B7658C15F FOREIGN KEY (extremoduro_id) REFERENCES extremoduro (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE songs');
    }
}
