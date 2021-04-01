#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Roles
#------------------------------------------------------------

CREATE TABLE Roles(
        id   Int  Auto_increment  NOT NULL ,
        Type Varchar (50) NOT NULL
	,CONSTRAINT Roles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateurs
#------------------------------------------------------------

CREATE TABLE Utilisateurs(
        id          Int  Auto_increment  NOT NULL ,
        Nom         Varchar (50) NOT NULL ,
        Prenom      Varchar (50) NOT NULL ,
        Centre      Varchar (50) NOT NULL ,
        Promotion   Varchar (50) NOT NULL ,
        Identifiant Varchar (100) NOT NULL ,
        id_Roles    Int NOT NULL
	,CONSTRAINT Utilisateurs_AK UNIQUE (Identifiant)
	,CONSTRAINT Utilisateurs_PK PRIMARY KEY (id)

	,CONSTRAINT Utilisateurs_Roles_FK FOREIGN KEY (id_Roles) REFERENCES Roles(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprises
#------------------------------------------------------------

CREATE TABLE Entreprises(
        id               Int  Auto_increment  NOT NULL ,
        Nom              Varchar (50) NOT NULL ,
        Secteur_activite Varchar (50) NOT NULL ,
        Localite         Varchar (50) NOT NULL ,
        Nombre_etudiants Int NOT NULL ,
        Email            Varchar (50) NOT NULL
	,CONSTRAINT Entreprises_AK UNIQUE (Email)
	,CONSTRAINT Entreprises_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: wish-list
#------------------------------------------------------------

CREATE TABLE wish_list(
        id              Int  Auto_increment  NOT NULL ,
        id_Utilisateurs Int NOT NULL
	,CONSTRAINT wish_list_PK PRIMARY KEY (id)

	,CONSTRAINT wish_list_Utilisateurs_FK FOREIGN KEY (id_Utilisateurs) REFERENCES Utilisateurs(id)
	,CONSTRAINT wish_list_Utilisateurs_AK UNIQUE (id_Utilisateurs)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Offres
#------------------------------------------------------------

CREATE TABLE Offres(
        id             Int  Auto_increment  NOT NULL ,
        Titre          Varchar (50) NOT NULL ,
        Competence     Varchar (50) NOT NULL ,
        Type_promo     Varchar (50) NOT NULL ,
        Duree          Varchar (50) NOT NULL ,
        Remuneration   Varchar (50) NOT NULL ,
        Date_offre     Datetime NOT NULL ,
        Nombre_places  Int NOT NULL ,
        id_Entreprises Int NOT NULL
	,CONSTRAINT Offres_PK PRIMARY KEY (id)

	,CONSTRAINT Offres_Entreprises_FK FOREIGN KEY (id_Entreprises) REFERENCES Entreprises(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Evaluation
#------------------------------------------------------------

CREATE TABLE Evaluation(
        id             Int  Auto_increment  NOT NULL ,
        Communication  Int NOT NULL ,
        Competences    Int NOT NULL ,
        Organisation   Int NOT NULL ,
        Confort        Int NOT NULL ,
        Paie           Int NOT NULL ,
        id_Entreprises Int NOT NULL
	,CONSTRAINT Evaluation_PK PRIMARY KEY (id)

	,CONSTRAINT Evaluation_Entreprises_FK FOREIGN KEY (id_Entreprises) REFERENCES Entreprises(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Droits
#------------------------------------------------------------

CREATE TABLE Droits(
        id     Int  Auto_increment  NOT NULL ,
        type_d Varchar (50) NOT NULL ,
        valeur Int NOT NULL
	,CONSTRAINT Droits_AK UNIQUE (valeur)
	,CONSTRAINT Droits_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contenir
#------------------------------------------------------------

CREATE TABLE Contenir(
        id        Int NOT NULL ,
        id_Offres Int NOT NULL
	,CONSTRAINT Contenir_PK PRIMARY KEY (id,id_Offres)

	,CONSTRAINT Contenir_wish_list_FK FOREIGN KEY (id) REFERENCES wish_list(id)
	,CONSTRAINT Contenir_Offres0_FK FOREIGN KEY (id_Offres) REFERENCES Offres(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Posseder
#------------------------------------------------------------

CREATE TABLE Posseder(
        id              Int NOT NULL ,
        id_Utilisateurs Int NOT NULL
	,CONSTRAINT Posseder_PK PRIMARY KEY (id,id_Utilisateurs)

	,CONSTRAINT Posseder_Droits_FK FOREIGN KEY (id) REFERENCES Droits(id)
	,CONSTRAINT Posseder_Utilisateurs0_FK FOREIGN KEY (id_Utilisateurs) REFERENCES Utilisateurs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Postuler
#------------------------------------------------------------

CREATE TABLE Postuler(
        id        Int NOT NULL ,
        id_Offres Int NOT NULL ,
        Etat      Int NOT NULL
	,CONSTRAINT Postuler_PK PRIMARY KEY (id,id_Offres)

	,CONSTRAINT Postuler_Utilisateurs_FK FOREIGN KEY (id) REFERENCES Utilisateurs(id)
	,CONSTRAINT Postuler_Offres0_FK FOREIGN KEY (id_Offres) REFERENCES Offres(id)
)ENGINE=InnoDB;

