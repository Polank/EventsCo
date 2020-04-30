<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430103440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario_grupo (usuario_id INT NOT NULL, grupo_id INT NOT NULL, INDEX IDX_91D0F1CDDB38439E (usuario_id), INDEX IDX_91D0F1CD9C833003 (grupo_id), PRIMARY KEY(usuario_id, grupo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario_grupo ADD CONSTRAINT FK_91D0F1CDDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_grupo ADD CONSTRAINT FK_91D0F1CD9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo ADD admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE grupo ADD CONSTRAINT FK_8C0E9BD3642B8210 FOREIGN KEY (admin_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_8C0E9BD3642B8210 ON grupo (admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE usuario_grupo');
        $this->addSql('ALTER TABLE grupo DROP FOREIGN KEY FK_8C0E9BD3642B8210');
        $this->addSql('DROP INDEX IDX_8C0E9BD3642B8210 ON grupo');
        $this->addSql('ALTER TABLE grupo DROP admin_id');
    }
}