<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430102301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_grupo_evento (id INT AUTO_INCREMENT NOT NULL, usuario_id_id INT NOT NULL, grupo_id_id INT NOT NULL, evento_id_id INT NOT NULL, INDEX IDX_41B821E9629AF449 (usuario_id_id), INDEX IDX_41B821E9CFF09F9C (grupo_id_id), INDEX IDX_41B821E96F86A0CB (evento_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario_grupo_evento ADD CONSTRAINT FK_41B821E9629AF449 FOREIGN KEY (usuario_id_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_grupo_evento ADD CONSTRAINT FK_41B821E9CFF09F9C FOREIGN KEY (grupo_id_id) REFERENCES grupo (id)');
        $this->addSql('ALTER TABLE usuario_grupo_evento ADD CONSTRAINT FK_41B821E96F86A0CB FOREIGN KEY (evento_id_id) REFERENCES evento (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_grupo_evento DROP FOREIGN KEY FK_41B821E96F86A0CB');
        $this->addSql('ALTER TABLE usuario_grupo_evento DROP FOREIGN KEY FK_41B821E9CFF09F9C');
        $this->addSql('ALTER TABLE usuario_grupo_evento DROP FOREIGN KEY FK_41B821E9629AF449');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_grupo_evento');
    }
}
