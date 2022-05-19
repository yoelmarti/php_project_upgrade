<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517004329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrada_cine (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, num_entradas INT NOT NULL, bolsa_palomitas INT DEFAULT NULL, INDEX IDX_5A119972DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peliculas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, fecha_estreno DATE NOT NULL, duracion SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrada_cine ADD CONSTRAINT FK_5A119972DB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada_cine DROP FOREIGN KEY FK_5A119972DB38439E');
        $this->addSql('DROP TABLE entrada_cine');
        $this->addSql('DROP TABLE peliculas');
        $this->addSql('DROP TABLE `user`');
    }
}
