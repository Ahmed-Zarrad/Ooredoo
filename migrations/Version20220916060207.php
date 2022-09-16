<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916060207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todolist (change_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, owner VARCHAR(255) NOT NULL, nok TINYINT(1) NOT NULL, ok TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(change_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, lastname VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, phone_number INT NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496B01BC5B (phone_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD PRIMARY KEY (change_id)');
        $this->addSql('ALTER TABLE bestpractice ADD PRIMARY KEY (node)');
        $this->addSql('ALTER TABLE cases ADD PRIMARY KEY (case_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE todolist');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE activity DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE bestpractice DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE cases DROP PRIMARY KEY');
    }
}
