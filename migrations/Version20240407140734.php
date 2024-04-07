<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407140734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, discount INT NOT NULL, type TINYINT(1) NOT NULL, valid_from DATETIME NOT NULL, valid_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coupon');
    }
}
