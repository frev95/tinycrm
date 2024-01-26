<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126144633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, contenu CLOB NOT NULL, publie BOOLEAN NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(80) NOT NULL, telephone VARCHAR(20) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(50) NOT NULL, cp VARCHAR(10) NOT NULL, pays VARCHAR(50) NOT NULL, statut BOOLEAN NOT NULL, created DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE interaction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prospect_id_id INTEGER DEFAULT NULL, type VARCHAR(50) NOT NULL, date DATETIME NOT NULL, commentaires CLOB DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, CONSTRAINT FK_378DFDA73E3A05BD FOREIGN KEY (prospect_id_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_378DFDA73E3A05BD ON interaction (prospect_id_id)');
        $this->addSql('CREATE TABLE offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, description CLOB NOT NULL, montant NUMERIC(10, 2) NOT NULL, fichier VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE offre_client (offre_id INTEGER NOT NULL, client_id INTEGER NOT NULL, PRIMARY KEY(offre_id, client_id), CONSTRAINT FK_A0CE647E4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A0CE647E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A0CE647E4CC8505A ON offre_client (offre_id)');
        $this->addSql('CREATE INDEX IDX_A0CE647E19EB6921 ON offre_client (client_id)');
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id_id INTEGER DEFAULT NULL, montant NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL, statut VARCHAR(50) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, CONSTRAINT FK_723705D1DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_723705D1DC2902E0 ON "transaction" (client_id_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE interaction');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_client');
        $this->addSql('DROP TABLE "transaction"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
