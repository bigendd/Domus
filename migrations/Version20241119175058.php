<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119175058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_realisation DROP FOREIGN KEY FK_81DF4BF1B685E551');
        $this->addSql('DROP TABLE details_realisation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE details_realisation (id INT AUTO_INCREMENT NOT NULL, realisation_id INT NOT NULL, chemin_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_81DF4BF1B685E551 (realisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE details_realisation ADD CONSTRAINT FK_81DF4BF1B685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
