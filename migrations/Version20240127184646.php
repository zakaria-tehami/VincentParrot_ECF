<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127184646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_testimonial (user_id INT NOT NULL, testimonial_id INT NOT NULL, INDEX IDX_4FA60462A76ED395 (user_id), INDEX IDX_4FA604621D4EC6B1 (testimonial_id), PRIMARY KEY(user_id, testimonial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_testimonial ADD CONSTRAINT FK_4FA60462A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_testimonial ADD CONSTRAINT FK_4FA604621D4EC6B1 FOREIGN KEY (testimonial_id) REFERENCES testimonial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car ADD user_id INT NOT NULL, ADD contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69DE7A1254A ON car (contact_id)');
        $this->addSql('ALTER TABLE car_image ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car_image ADD CONSTRAINT FK_1A968188C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_1A968188C3C6F69F ON car_image (car_id)');
        $this->addSql('ALTER TABLE contact ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638A76ED395 ON contact (user_id)');
        $this->addSql('ALTER TABLE garage ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610B4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F26610B4DE7DC5C ON garage (adresse_id)');
        $this->addSql('ALTER TABLE opening_day ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opening_day ADD CONSTRAINT FK_33A03DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_33A03DFA76ED395 ON opening_day (user_id)');
        $this->addSql('ALTER TABLE service ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2A76ED395 ON service (user_id)');
        $this->addSql('ALTER TABLE user ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494DE7DC5C ON user (adresse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_testimonial DROP FOREIGN KEY FK_4FA60462A76ED395');
        $this->addSql('ALTER TABLE user_testimonial DROP FOREIGN KEY FK_4FA604621D4EC6B1');
        $this->addSql('DROP TABLE user_testimonial');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DE7A1254A');
        $this->addSql('DROP INDEX IDX_773DE69DA76ED395 ON car');
        $this->addSql('DROP INDEX UNIQ_773DE69DE7A1254A ON car');
        $this->addSql('ALTER TABLE car DROP user_id, DROP contact_id');
        $this->addSql('ALTER TABLE car_image DROP FOREIGN KEY FK_1A968188C3C6F69F');
        $this->addSql('DROP INDEX IDX_1A968188C3C6F69F ON car_image');
        $this->addSql('ALTER TABLE car_image DROP car_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('DROP INDEX IDX_4C62E638A76ED395 ON contact');
        $this->addSql('ALTER TABLE contact DROP user_id');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610B4DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_9F26610B4DE7DC5C ON garage');
        $this->addSql('ALTER TABLE garage DROP adresse_id');
        $this->addSql('ALTER TABLE opening_day DROP FOREIGN KEY FK_33A03DFA76ED395');
        $this->addSql('DROP INDEX IDX_33A03DFA76ED395 ON opening_day');
        $this->addSql('ALTER TABLE opening_day DROP user_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2A76ED395');
        $this->addSql('DROP INDEX IDX_E19D9AD2A76ED395 ON service');
        $this->addSql('ALTER TABLE service DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_8D93D6494DE7DC5C ON user');
        $this->addSql('ALTER TABLE user DROP adresse_id');
    }
}
