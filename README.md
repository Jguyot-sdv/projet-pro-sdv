# Outil d'Analyse Réseau en Ligne de Commande

Cet outil est une interface web simple qui permet d'exécuter plusieurs outils d'analyse réseau tels que `nmap`, `nslookup`, `traceroute`, `ping`, `whois` et `gobuster` sur une adresse IP fournie.

## Pré-requis

- Serveur web Apache
- PHP 7.4 ou supérieur
- Les outils d'analyse réseau mentionnés ci-dessus doivent être installés sur le système

## Installation

1. Clonez ce dépôt ou téléchargez le code source.
2. Déplacez le code source dans le répertoire de votre serveur web (par exemple, `/var/www/html`).
3. Assurez-vous que les permissions de fichier sont correctement définies pour que le serveur web puisse lire et écrire dans le dossier des logs (`logs/`).

## Configuration Apache

1. Assurez-vous que le module `mod_rewrite` est activé dans votre configuration Apache. Vous pouvez l'activer en utilisant la commande `a2enmod rewrite` et en redémarrant Apache.
2. Créez un nouveau fichier de configuration VirtualHost pour votre site. Par exemple, `/etc/apache2/sites-available/monsite.conf`. Voici un exemple de configuration :
    ```
    <VirtualHost *:80>
        ServerName monsite.local
        DocumentRoot /var/www/html/monsite

        <Directory /var/www/html/monsite>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    ```
3. Activez le site en utilisant la commande `a2ensite monsite` et redémarrez Apache.

## Utilisation

1. Ouvrez un navigateur web et naviguez vers l'adresse de votre serveur web où vous avez installé l'outil.
2. Entrez une adresse IP dans le champ fourni.
3. Sélectionnez l'outil d'analyse réseau que vous souhaitez exécuter à partir de la liste déroulante.
4. Cliquez sur le bouton "Exécuter" pour lancer l'analyse.
5. Les résultats de l'analyse seront affichés dans la zone de texte en dessous. Une copie des résultats sera également enregistrée dans le dossier des logs.

## Notes de sécurité

Cet outil exécute des commandes système à partir de PHP, ce qui peut présenter des risques de sécurité si elles ne sont pas correctement gérées. Cet outil est destiné à être utilisé dans un environnement local et contrôlé. Assurez-vous de comprendre les implications de sécurité avant d'utiliser cet outil dans un environnement de production ou accessible au public.  
> Projet étudiant pour Sup de Vinci.
