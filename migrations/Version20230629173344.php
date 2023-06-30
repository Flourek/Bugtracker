<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629173344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bug_user (bug_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4AD9E98EFA3DB3D5 (bug_id), INDEX IDX_4AD9E98EA76ED395 (user_id), PRIMARY KEY(bug_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bug_user ADD CONSTRAINT FK_4AD9E98EFA3DB3D5 FOREIGN KEY (bug_id) REFERENCES bug (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bug_user ADD CONSTRAINT FK_4AD9E98EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bug ADD CONSTRAINT FK_358CBF14F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_358CBF14F675F31B ON bug (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bug_user DROP FOREIGN KEY FK_4AD9E98EFA3DB3D5');
        $this->addSql('ALTER TABLE bug_user DROP FOREIGN KEY FK_4AD9E98EA76ED395');
        $this->addSql('DROP TABLE bug_user');
        $this->addSql('ALTER TABLE bug DROP FOREIGN KEY FK_358CBF14F675F31B');
        $this->addSql('DROP INDEX IDX_358CBF14F675F31B ON bug');
    }
}
