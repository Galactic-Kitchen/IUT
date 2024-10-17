exec("fonctionMode.sci");
close(); //tentative de nettoyer les figures

salaires_column = data(:,7);
genres_column = M(:,3);
genres = unique(genres_column);
genres_size = size(genres, 1);

quartiles_salaire = zeros(genres_size, 3);
interquartiles_salaire = zeros(genres_size, 1);
min_salaires = zeros(genres_size, 1);
max_salaires = zeros(genres_size, 1);
moyennes_salaires = zeros(genres_size, 1);
medianes_salaires = zeros(genres_size, 1);
modes_salaires = zeros(genres_size, 1);
ecart_types_salaires = zeros(genres_size, 1);

//Partie 1 :
for i =1:size(genres, 1)
    indices_genre = find(genres_column == genres(i));
    salaire_current = salaires_column(indices_genre);
    
    quartiles_salaire(i,:) = quart(salaire_current);
    interquartiles_salaire(i) = iqr(salaire_current);
    min_salaires(i) = min(salaire_current);
    max_salaires(i) = max(salaire_current);
    moyennes_salaires(i) = mean(salaire_current);
    medianes_salaires(i) = median(salaire_current);
    modes_salaires(i) = trouverMode(salaire_current);
    ecart_types_salaires(i) = stdev(salaire_current);
    
    mprintf("Statistique du genre %s :\n", genres(i));
    mprintf("Premier quartile : %d, Troisième quartile : %d\n", quartiles_salaire(i,1), quartiles_salaire(i,3) );
    mprintf("L''écart interquartile est de %d\n", interquartiles_salaire(i));
    mprintf("Le salaire minimum est de %d\n", min_salaires(i));
    mprintf("Le salaire maximum est de %d\n", max_salaires(i));
    mprintf("La moyenne du salaire est de %d\n", moyennes_salaires(i));
    mprintf("La médiane du salaire est de %d\n", medianes_salaires(i));
    mprintf("Le mode du salaire est de %d\n", modes_salaires(i));
    mprintf("L''écart-type du salaire est de %d\n", ecart_types_salaires(i));
    
    //Partie 2 :
    figure();
    boxplot(salaire_current, "whisker", 0.7);  //donnée empirique
    title(msprintf('Répartition des salaires du genre %s', genres(i)));
    xs2png(gcf(), msprintf("Ex3.4.%s.png", genres(i)));
end

/* Commentaire a transferer dans le readme :
On remarque que la boite à moustache des femmes est déplacée d'environ 25000 en moyenne par rapport à celle des hommes excepté pour la moustache du bas où les 2 se rapprochent de 0. L'échantillon Other est semblable aux autres mais la population de l'échantillon pose problème pour avoir une représentativité correcte.
*/
