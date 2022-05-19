<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518081024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peliculas ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE peliculas ADD CONSTRAINT FK_9B1814B0DB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9B1814B0DB38439E ON peliculas (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peliculas DROP FOREIGN KEY FK_9B1814B0DB38439E');
        $this->addSql('DROP INDEX IDX_9B1814B0DB38439E ON peliculas');
        $this->addSql('ALTER TABLE peliculas DROP usuario_id');
    }
}
