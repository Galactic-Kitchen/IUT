exec("fonctionMode.sci");

column_ages=data(:,2);

quartiles_age = quart(column_ages);
mprintf("Les premiers et troisième quartiles sont %d et %d\n", quartiles_age(1), quartiles_age(3))
interquartiles_age = iqr(column_ages);
mprintf("L''écart interquartile est de %d\n", interquartiles_age)
min_age = min(column_ages);
mprintf("L''âge minimum est de %d\n", min_age)
max_age = max(column_ages);
mprintf("L''âge maximum est de %d\n", max_age)
moyenne_age = mean(column_ages);
mprintf("La moyenne d''âge est de %d\n", moyenne_age)
mediane_age = median(column_ages);
mprintf("La médiane d''âge est de %d\n", mediane_age)
mode_age = trouverMode(column_ages);
mprintf("Le mode de l''âge est de %d\n", mode_age)
ecart_type_age = stdev(column_ages);
mprintf("L''écart-type de l''âge est de %d\n", ecart_type_age)
