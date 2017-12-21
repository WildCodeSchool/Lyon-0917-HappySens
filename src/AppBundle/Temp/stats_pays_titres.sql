# phpMyAdmin SQL Dump
# version 2.5.5-pl1
# http://www.phpmyadmin.net
#
# Serveur: localhost
# G�n�r� le : Vendredi 22 Avril 2005 � 16:11
# Version du serveur: 3.23.37
# Version de PHP: 4.1.2
# 
# Base de donn�es: `netchallenge`
# 

# --------------------------------------------------------

#
# Structure de la table `language`
#

CREATE TABLE `language` (
  `code` varchar(8) NOT NULL default '',
  `titre` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`code`)
);
#TYPE=MyISAM COMMENT='Nom des codes langue-pays'

#
# Contenu de la table `language`
#


INSERT INTO `language` VALUES ('de', 'Allemand (standard)');
INSERT INTO `language` VALUES ('en-us', 'Anglais (USA)');
INSERT INTO `language` VALUES ('en-gb', 'Anglais (Grande Bretagne)');
INSERT INTO `language` VALUES ('fr-be', 'Français (Belgique)');
INSERT INTO `language` VALUES ('it', 'Italien (standard)');
INSERT INTO `language` VALUES ('es', 'Espagnol (traditionnel)');
INSERT INTO `language` VALUES ('fr-ca', 'Français (Canada)');
INSERT INTO `language` VALUES ('fr-lu', 'Français (Luxembourg)');
INSERT INTO `language` VALUES ('fr-mc', 'Français (Monaco)');
INSERT INTO `language` VALUES ('fr-ch', 'Français (Suisse)');
INSERT INTO `language` VALUES ('ja', 'Japonnais (standard)');
INSERT INTO `language` VALUES ('es-mx', 'Espagnol (Mexique)');
INSERT INTO `language` VALUES ('ru', 'Russe');
INSERT INTO `language` VALUES ('en', 'Anglais (standard)');
INSERT INTO `language` VALUES ('nl-be', 'Flamand (Belgique)');
INSERT INTO `language` VALUES ('cs', 'Tchécoslovaque (standard)');
INSERT INTO `language` VALUES ('de-ch', 'Allemand (Suisse)');
INSERT INTO `language` VALUES ('es-ar', 'Espagnol (Argentine)');
INSERT INTO `language` VALUES ('en-ca', 'Anglais (Canada)');
INSERT INTO `language` VALUES ('nl', 'Flamand (standard)');
INSERT INTO `language` VALUES ('el', 'Grecque (standard)');
INSERT INTO `language` VALUES ('no', 'Norvégien (standard)');
INSERT INTO `language` VALUES ('sv', 'Suédois (standard)');
INSERT INTO `language` VALUES ('en-ie', 'Anglais (Ireland)');
INSERT INTO `language` VALUES ('fr-fr', 'Français (France)');
INSERT INTO `language` VALUES ('pt', 'Portuguais (standard)');
INSERT INTO `language` VALUES ('pt-br', 'Portuguais (Brésil)');
INSERT INTO `language` VALUES ('ko', 'Coréen (standard)');
INSERT INTO `language` VALUES ('zh-cn', 'Chinois (Provinces)');
INSERT INTO `language` VALUES ('pl', 'Polonais (standard)');
INSERT INTO `language` VALUES ('fr', 'Français (standard)');
INSERT INTO `language` VALUES ('th', 'Thaï');
INSERT INTO `language` VALUES ('sq', 'Albanais');
INSERT INTO `language` VALUES ('uk', 'Ukrainien');
INSERT INTO `language` VALUES ('inconnu', 'Origine indéterminée');
INSERT INTO `language` VALUES ('de-lu', 'Allemand (Luxembourg)');
INSERT INTO `language` VALUES ('fr-netch', 'Français (Netchallenge)');
INSERT INTO `language` VALUES ('he', 'Hébreu');
INSERT INTO `language` VALUES ('en;q=1.0', 'Anglais (standard)');
INSERT INTO `language` VALUES ('ar-sa', 'Arabe (Arabie Saoudite)');
INSERT INTO `language` VALUES ('tr', 'Turc');
INSERT INTO `language` VALUES ('ar-dz', 'Arabe (Algérie)');
INSERT INTO `language` VALUES ('en-jm', 'Anglais (Jamaïque)');
INSERT INTO `language` VALUES ('fr;q=1.0', 'Français (standard)');
INSERT INTO `language` VALUES ('de-at', 'Allemand (Autriche)');
INSERT INTO `language` VALUES ('ar-eg', 'Arabe (Egypte)');
INSERT INTO `language` VALUES ('hu', 'Hongrois');
INSERT INTO `language` VALUES ('yi', 'Yiddish');
INSERT INTO `language` VALUES ('ro', 'Roumain');
INSERT INTO `language` VALUES ('fa', 'Farsi');
INSERT INTO `language` VALUES ('da', 'Danois');
INSERT INTO `language` VALUES ('ar-ma', 'Arabe (Maroc)');
INSERT INTO `language` VALUES ('fi', 'Finnois');
INSERT INTO `language` VALUES ('es-co', 'Espagnol (Colombie)');
INSERT INTO `language` VALUES ('en-au', 'Anglais (Australie)');
INSERT INTO `language` VALUES ('zh-tw', 'Chinois (Taïwan)');
INSERT INTO `language` VALUES ('es-ec', 'Espagnol (Equateur)');
INSERT INTO `language` VALUES ('lt', 'Italien (standard)');
INSERT INTO `language` VALUES ('da-dk', 'Danois (Danemark)');
INSERT INTO `language` VALUES ('id', 'Indonésien');
INSERT INTO `language` VALUES ('de-de', 'Allemand (Allemagne)');
INSERT INTO `language` VALUES ('et', 'Estonien');
INSERT INTO `language` VALUES ('es-cl', 'Espagnol (Chili)');
INSERT INTO `language` VALUES ('es-gt', 'Espagnol (Guatemala)');
INSERT INTO `language` VALUES ('es-ve', 'Espagnol (Venezuela)');
INSERT INTO `language` VALUES ('en-nz', 'Anglais (Nouvelle Zélande)');
INSERT INTO `language` VALUES ('nl-nl', 'Flamand (Pays-Bas)');
INSERT INTO `language` VALUES ('zu', 'Zoulou');
INSERT INTO `language` VALUES ('es-pe', 'Espagnol (Pérou)');
INSERT INTO `language` VALUES ('sl', 'Slovène');
INSERT INTO `language` VALUES ('hu-hu', 'Hongrois (Hongrie)');
INSERT INTO `language` VALUES ('it-it', 'Italien (Italie)');
INSERT INTO `language` VALUES ('es-ni', 'Espagnol (Nicaragua)');
INSERT INTO `language` VALUES ('en-ki', 'Anglais (Kiribati)');
INSERT INTO `language` VALUES ('en-tt', 'Anglais (Trinidad et Tobago)');
INSERT INTO `language` VALUES ('ja-jp', 'Japonnais (Japon)');

