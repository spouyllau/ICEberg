# phpMyAdmin SQL Dump
# version 2.5.6
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Jeudi 27 Mai 2004 à 10:12
# Version du serveur: 3.23.49
# Version de PHP: 4.2.1
# 
# Base de données: `ice`
# 

# --------------------------------------------------------

#
# Structure de la table `ice_book`
#

CREATE TABLE `ice_book` (
  `bookId` int(11) NOT NULL auto_increment,
  `bookShortTitle` varchar(255) NOT NULL default '',
  `typeofbookId` varchar(15) default NULL,
  `bookTitle` longtext,
  `bookTitleCollection` longtext,
  `bookDate` varchar(255) NOT NULL default '',
  `bookAuthorName` varchar(255) default NULL,
  `bookAuthorSurname` varchar(255) default NULL,
  `bookAuthorQualification` longtext,
  `bookEditor` longtext,
  `bookPlaceEditor` longtext,
  `bookPagesNumber` longtext,
  `bookCoverImage` longtext,
  `bookVolNumber` longtext,
  `bookObservations` longtext,
  `bookNumerisationPerson1` varchar(255) NOT NULL default '',
  `bookNumerisationPerson2` longtext,
  `bookNumerisationPerson3` longtext,
  `bookNumerisationPerson4` longtext,
  `bookUrl` longtext,
  `bookDoc` longtext,
  `bookPdf` longtext,
  `bookOrder` longtext,
  PRIMARY KEY  (`bookId`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `corpus_lamarck_book_collection`
#

CREATE TABLE `ice_book_collection` (
  `ID` int(11) NOT NULL auto_increment,
  `bookTitleCollection` varchar(255) NOT NULL default '',
  `parent_CollectionName` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `notes` longtext NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `keywords` (`keywords`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `corpus_lamarck_page`
#

CREATE TABLE `ice_page` (
  `pageId` varchar(123) NOT NULL default '',
  `bookId` longtext NOT NULL,
  `pageVolNumber` longtext NOT NULL,
  `pageOrder` decimal(11,0) NOT NULL default '0',
  `pageChapter` longtext NOT NULL,
  `pageTitle` longtext NOT NULL,
  `pageText` longtext NOT NULL,
  `pageNumber` int(12) NOT NULL default '0',
  `pageNote` longtext NOT NULL,
  `pageUrl` varchar(255) NOT NULL default '',
  `pageImage` longtext NOT NULL,
  `pagefigure1` longtext NOT NULL,
  `pagefigure2` longtext NOT NULL,
  `pagefigure3` longtext NOT NULL
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `corpus_lamarck_session`
#

CREATE TABLE `ice_session` (
  `IDsession` int(11) NOT NULL auto_increment,
  `login` varchar(150) NOT NULL default '',
  `pass` varchar(150) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `Nom` longtext NOT NULL,
  `Grade` longtext NOT NULL,
  UNIQUE KEY `IDsession` (`IDsession`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `corpus_lamarck_typebook`
#

CREATE TABLE `ice_typebook` (
  `typeofbookId` int(20) NOT NULL auto_increment,
  `typeofbookDes` longtext NOT NULL,
  `typeofbookDesGb` longtext NOT NULL,
  `typeofbookIcon` longtext NOT NULL,
  UNIQUE KEY `typeofbookId` (`typeofbookId`)
) TYPE=MyISAM;
