<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430150625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actividad_evento (actividad_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_56F6B4CC6014FACA (actividad_id), INDEX IDX_56F6B4CC87A5F842 (evento_id), PRIMARY KEY(actividad_id, evento_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_grupo (usuario_id INT NOT NULL, grupo_id INT NOT NULL, INDEX IDX_91D0F1CDDB38439E (usuario_id), INDEX IDX_91D0F1CD9C833003 (grupo_id), PRIMARY KEY(usuario_id, grupo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actividad_evento ADD CONSTRAINT FK_56F6B4CC6014FACA FOREIGN KEY (actividad_id) REFERENCES actividad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actividad_evento ADD CONSTRAINT FK_56F6B4CC87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_grupo ADD CONSTRAINT FK_91D0F1CDDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_grupo ADD CONSTRAINT FK_91D0F1CD9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actividad_evento');
        $this->addSql('DROP TABLE usuario_grupo');
    }
}
