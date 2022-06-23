<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623110502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE toy (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, use_restriction_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_6705A76E12469DE2 (category_id), INDEX IDX_6705A76ED303A7DD (use_restriction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE toy_child (toy_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_2234B88EB524FDDC (toy_id), INDEX IDX_2234B88EDD62C21B (child_id), PRIMARY KEY(toy_id, child_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE toy_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE use_restriction (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE toy ADD CONSTRAINT FK_6705A76E12469DE2 FOREIGN KEY (category_id) REFERENCES toy_category (id)');
        $this->addSql('ALTER TABLE toy ADD CONSTRAINT FK_6705A76ED303A7DD FOREIGN KEY (use_restriction_id) REFERENCES use_restriction (id)');
        $this->addSql('ALTER TABLE toy_child ADD CONSTRAINT FK_2234B88EB524FDDC FOREIGN KEY (toy_id) REFERENCES toy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE toy_child ADD CONSTRAINT FK_2234B88EDD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE toy_child DROP FOREIGN KEY FK_2234B88EDD62C21B');
        $this->addSql('ALTER TABLE toy_child DROP FOREIGN KEY FK_2234B88EB524FDDC');
        $this->addSql('ALTER TABLE toy DROP FOREIGN KEY FK_6705A76E12469DE2');
        $this->addSql('ALTER TABLE toy DROP FOREIGN KEY FK_6705A76ED303A7DD');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE toy');
        $this->addSql('DROP TABLE toy_child');
        $this->addSql('DROP TABLE toy_category');
        $this->addSql('DROP TABLE use_restriction');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
