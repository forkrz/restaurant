<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205113108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admindata (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals (id INT AUTO_INCREMENT NOT NULL, meal_name VARCHAR(255) NOT NULL, small_price NUMERIC(5, 2) NOT NULL, medium_price NUMERIC(5, 2) NOT NULL, large_price NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderdetails (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, meal_id_id INT NOT NULL, INDEX IDX_489AFCDCFCDAEAAA (order_id_id), INDEX IDX_489AFCDCC58E7681 (meal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, date_of_order DATE NOT NULL, total_cost NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderdetails ADD CONSTRAINT FK_489AFCDCFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orderdetails ADD CONSTRAINT FK_489AFCDCC58E7681 FOREIGN KEY (meal_id_id) REFERENCES meals (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orderdetails DROP FOREIGN KEY FK_489AFCDCC58E7681');
        $this->addSql('ALTER TABLE orderdetails DROP FOREIGN KEY FK_489AFCDCFCDAEAAA');
        $this->addSql('DROP TABLE admindata');
        $this->addSql('DROP TABLE meals');
        $this->addSql('DROP TABLE orderdetails');
        $this->addSql('DROP TABLE orders');
    }
}
