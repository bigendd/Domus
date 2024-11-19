<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119174307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_realisation DROP FOREIGN KEY FK_81DF4BF1B685E551');
        $this->addSql('ALTER TABLE details_realisation ADD CONSTRAINT FK_81DF4BF1B685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_realisation DROP FOREIGN KEY FK_81DF4BF1B685E551');
        $this->addSql('ALTER TABLE details_realisation ADD CONSTRAINT FK_81DF4BF1B685E551 FOREIGN KEY (realisation_id) REFERENCES details_realisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
