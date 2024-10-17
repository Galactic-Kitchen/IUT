exec("fonctionMode.sci");
close(); //tentative de nettoyer les figures

column_xp=data(:,6);

//Partie 1 :

quartiles_xp = quart(column_xp);
interquartiles_xp = iqr(column_xp);
mprintf("L''écart interquartile est de %d\n", interquartiles_xp)
min_xp = min(column_xp);
mprintf("L''expérience minimum est de %d\n", min_xp)
max_xp = max(column_xp);
mprintf("L''expérience maximum est de %d\n", max_xp)
moyenne_xp = mean(column_xp);
mprintf("La moyenne d''expérience est de %d\n", moyenne_xp)
mediane_xp = median(column_xp);
mprintf("La médiane d''expérience est de %d\n", mediane_xp)
mode_xp = trouverMode(column_xp);
mprintf("Le mode de l''expérience est de %d\n", mode_xp)
ecart_type_xp = stdev(column_xp);
mprintf("L''écart-type de l''expérience est de %d\n", ecart_type_xp)


//Partie 2 :
clf();
boxplot(column_xp, "whisker",0.4); //donnée empirique
title('Réparttion de l''expérience');
xs2png(gcf(), 'Ex2.5.png');
