<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171111144037 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sub_family (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genus ADD subfamily_id INT DEFAULT NULL, DROP subfamily');
        $this->addSql('ALTER TABLE genus ADD CONSTRAINT FK_38C5106E5731FD53 FOREIGN KEY (subfamily_id) REFERENCES sub_family (id)');
        $this->addSql('CREATE INDEX IDX_38C5106E5731FD53 ON genus (subfamily_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus DROP FOREIGN KEY FK_38C5106E5731FD53');
        $this->addSql('DROP TABLE sub_family');
        $this->addSql('DROP INDEX IDX_38C5106E5731FD53 ON genus');
        $this->addSql('ALTER TABLE genus ADD subfamily VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP subfamily_id');
    }
}
