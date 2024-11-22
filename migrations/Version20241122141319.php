<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122141319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animals (id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, species VARCHAR(255) NOT NULL, latin VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_966C69DDAFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animals_user (animals_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_812BBAEB132B9E58 (animals_id), INDEX IDX_812BBAEBA76ED395 (user_id), PRIMARY KEY(animals_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitats (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, rate SMALLINT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_6970EB0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, opening_hours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services_user (services_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9AA8EF8AEF5A6C1 (services_id), INDEX IDX_9AA8EF8A76ED395 (user_id), PRIMARY KEY(services_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vet_visit (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, date DATE NOT NULL, time TIME NOT NULL, health VARCHAR(255) NOT NULL, food VARCHAR(255) NOT NULL, quantity VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL, INDEX IDX_9D1850108E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals ADD CONSTRAINT FK_966C69DDAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitats (id)');
        $this->addSql('ALTER TABLE animals_user ADD CONSTRAINT FK_812BBAEB132B9E58 FOREIGN KEY (animals_id) REFERENCES animals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animals_user ADD CONSTRAINT FK_812BBAEBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE services_user ADD CONSTRAINT FK_9AA8EF8AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE services_user ADD CONSTRAINT FK_9AA8EF8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vet_visit ADD CONSTRAINT FK_9D1850108E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals DROP FOREIGN KEY FK_966C69DDAFFE2D26');
        $this->addSql('ALTER TABLE animals_user DROP FOREIGN KEY FK_812BBAEB132B9E58');
        $this->addSql('ALTER TABLE animals_user DROP FOREIGN KEY FK_812BBAEBA76ED395');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FA76ED395');
        $this->addSql('ALTER TABLE services_user DROP FOREIGN KEY FK_9AA8EF8AEF5A6C1');
        $this->addSql('ALTER TABLE services_user DROP FOREIGN KEY FK_9AA8EF8A76ED395');
        $this->addSql('ALTER TABLE vet_visit DROP FOREIGN KEY FK_9D1850108E962C16');
        $this->addSql('DROP TABLE animals');
        $this->addSql('DROP TABLE animals_user');
        $this->addSql('DROP TABLE habitats');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE services_user');
        $this->addSql('DROP TABLE vet_visit');
    }
}
