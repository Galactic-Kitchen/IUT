# Bakefile

***

## Description

Bakefile est un utilitaire de compilation grandement inspiré de Makefile.

Il supporte les .PHONY, une comparaison de dates, la gestion de dépendances circulaires ainsi qu'un mode debug.

Les buts disponibles pour make sont :

* jar : Crée l'archive jar
* doc : Crée la documentation javadoc dans le répertoire du même nom
* clean : Nettoie la documentation ainsi que les fichiers de build, laisse l'archive jar si présente
* run : Lance Bake via le mode debug sur un bakefile présent dans le repértoire avec un but nommé `all`
* test : Lance une série automatisée de tests
* mrproper : Supprime l'archive jar



***

## Utilisation

Une commande bake est gracieusement fournie, il est également possible de lancer l'exécution via java -jar Bake.jar suivi des potentiels arguments.

Un mode debug est disponible. Pour l'activer, le premier argument doit être -d. Par exemple : `java ./bake -d clean`

Il est possible de fournir plusieurs cibles à effectuer. Dans ce cas, la première cible fournie sera effectuée ainsi que ses dépendances, puis la prochaine cible sera effectuée ainsi que ses dépendances et ainsi jusqu'à ce qu'il n'y ait plus de cibles non traitées.
