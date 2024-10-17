exec("fonctionMode.sci");
close(); //tentative de nettoyer les figures
salaires_column = data(:,7);

//Partie 1 :

quartiles_salaire = quart(salaires_column);
interquartiles_salaire = iqr(salaires_column);
mprintf("L''écart interquartile est de %d\n", interquartiles_salaire)
min_salaire = min(salaires_column);
mprintf("Le salaire minimum est de %d\n", min_salaire)
max_salaire = max(salaires_column);
mprintf("Le salaire maximum est de %d\n", max_salaire)
moyenne_salaire = mean(salaires_column);
mprintf("La moyenne de salaire est de %d\n", moyenne_salaire)
mediane_salaire = median(salaires_column);
mprintf("La médiane de salaire est de %d\n", mediane_salaire)
mode_salaire = trouverMode(salaires_column);
mprintf("Le mode de le salaire est de %d\n", mode_salaire)
ecart_type_salaire = stdev(salaires_column);
mprintf("L''écart-type de le salaire est de %d\n", ecart_type_salaire)


//Partie 2 :
clf();
boxplot(salaires_column,"whisker", 0.8);  //donnée empirique
// affiche des valeurs cheloues
title('Répartition de le salaire');
xs2png(gcf(), 'Ex3.3.png');
