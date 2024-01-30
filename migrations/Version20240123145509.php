<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123145509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, etat VARCHAR(20) NOT NULL, adresse_liv VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville_liv VARCHAR(100) NOT NULL, INDEX IDX_6EEAA67D5741EEB9 (fk_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenir (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_commande_id INT NOT NULL, fk_entrepot_id INT NOT NULL, quantite INT NOT NULL, tva DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_3C914DFDFF5AB468 (fk_produit_id), INDEX IDX_3C914DFDEB1C8260 (fk_commande_id), INDEX IDX_3C914DFD1B75B2A3 (fk_entrepot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrepot (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE existe (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_entrepot_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_464BD3E1FF5AB468 (fk_produit_id), INDEX IDX_464BD3E11B75B2A3 (fk_entrepot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, rayon_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8CD3202E52 (rayon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayon (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocker (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_magasin_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_AD495DFF5AB468 (fk_produit_id), INDEX IDX_AD495DD067A070 (fk_magasin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, pays VARCHAR(100) DEFAULT NULL, code_postal INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDFF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDEB1C8260 FOREIGN KEY (fk_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD1B75B2A3 FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E1FF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E11B75B2A3 FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CD3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495DFF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495DD067A070 FOREIGN KEY (fk_magasin_id) REFERENCES magasin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5741EEB9');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDFF5AB468');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDEB1C8260');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD1B75B2A3');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E1FF5AB468');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E11B75B2A3');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CD3202E52');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495DFF5AB468');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495DD067A070');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contenir');
        $this->addSql('DROP TABLE entrepot');
        $this->addSql('DROP TABLE existe');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE rayon');
        $this->addSql('DROP TABLE stocker');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
