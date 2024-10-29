<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029005029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, correct_answer_id, categorie_id, content FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, correct_answer_id INTEGER DEFAULT NULL, category_id INTEGER DEFAULT NULL, content VARCHAR(255) NOT NULL, CONSTRAINT FK_B6F7494EFD2E7CF7 FOREIGN KEY (correct_answer_id) REFERENCES answer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question (id, correct_answer_id, category_id, content) SELECT id, correct_answer_id, categorie_id, content FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494EFD2E7CF7 ON question (correct_answer_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E12469DE2 ON question (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, correct_answer_id, category_id, content FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, correct_answer_id INTEGER DEFAULT NULL, categorie_id INTEGER DEFAULT NULL, content VARCHAR(255) NOT NULL, CONSTRAINT FK_B6F7494EFD2E7CF7 FOREIGN KEY (correct_answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6F7494EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question (id, correct_answer_id, categorie_id, content) SELECT id, correct_answer_id, category_id, content FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494EFD2E7CF7 ON question (correct_answer_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBCF5E72D ON question (categorie_id)');
    }
}
