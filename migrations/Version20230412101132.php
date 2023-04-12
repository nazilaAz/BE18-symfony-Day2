<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412101132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destinations ADD fk_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3AAED72D FOREIGN KEY (fk_status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_2D3343C3AAED72D ON destinations (fk_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3AAED72D');
        $this->addSql('DROP INDEX IDX_2D3343C3AAED72D ON destinations');
        $this->addSql('ALTER TABLE destinations DROP fk_status_id');
    }
}
