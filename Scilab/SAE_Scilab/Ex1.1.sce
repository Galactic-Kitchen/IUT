// Extraction de la colonne correspondant au genre
genre_column = M(:, 3);

// Comptage du nombre d'hommes et de femmes
nb_hommes = sum(genre_column == "Male");
nb_femmes = sum(genre_column == "Female");

// Calcul de la proportion d'hommes et de femmes
total_personnes = size(genre_column, "r");
proportion_hommes = nb_hommes / total_personnes;
proportion_femmes = nb_femmes / total_personnes;

// Affichage des résultats
disp("Proportion d hommes : " + string(proportion_hommes));
disp("Proportion de femmes : " + string(proportion_femmes));

// Création du diagramme camembert
labels = ["Hommes", "Femmes"];
sizes = [proportion_hommes, proportion_femmes];
pie(sizes, labels);
title('Proportion d hommes et de femmes');
