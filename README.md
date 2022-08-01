# FLIGHT-MANAGER
Application de gestion de club d'ULM

Description : L'application permet au gérant du club (désigné comme manager dans la base de données), de gérer l'entrée des nouveaux utilisateurs, de créditer leurs portefeuilles, de gérer le planning et l'entretiens des avions destinés à la locations. Lorsque le manager créer un nouvel utilisateur, il lui remet un mot de passe que l'utilisateur devra modifier pour optimiser la sécurité de son compte personnel.
Chaque utilisateur à la possibilité de supprimer son compte, modifier son mot de passe, planifier ou modifier un vol. Seul le ou les managers désignés sont en mesure de créditer le compte d'un utilisateur.

## prérequis d'utilisation
Avant toute utilisation de l'application, vous devez disposez d'un base de données MySQL et d'un serveur PHP.
* _Etape 1:_ Créer la base de données en important le fichier doc/flight_manager.sql dans votre phpMyAdmin ou saisissez le contenu dans en ligne de commande.
* _Etape 2 :_ Remplacer le contenu du fichier lib/database.php par vos informations personnels(nom d'utilisateur, mot de passe, port/hôte utilisés)
* _Etape 3 :_ Créer un manager avec la commande SQL suivante (INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `time_counter`, `credits`, `inscription_date`, `pilot`, `instructor`, `manager`) VALUES (NULL, 'votrePrénom', 'votreNom', 'votreAdresse@mail.fr', 'kkNoBEDsbInro', '0', '0.00', '2022-08-01 09:28:45.000000', '0', '0', '1');) => remplacer les champs firstname, lastname, email par vos informations personnels, le champs password ne doit pas être modifié, vous avez la possibilité de modifier le hash du mot de passe situé dans le fichier utils/variables.php, auquel cas il vous faudra bien noté le résultat du salage pour créer le mot de passe de votre manager afin qu'il soit reconnu par l'application lors de la connexion. 

Vous pouvez maintenant vous connecter en tant que manager avec le mot de pass _Azerty1_.
