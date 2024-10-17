// Extraction de la colonne correspondant aux professions
professions_column = M(:, 5);

// Comptage du nombre d'occurrences de chaque profession
profession_counts = histc(professions_column, unique(professions_column));

// Trier les occurrences de chaque profession dans l'ordre décroissant
[profession_counts_sorted, sorted_indices] = gsort(profession_counts, 'g', 'd');

// Affichage des 10 professions les plus représentées
mprintf("Profession\t\tEffectif\n");
for i = 1:min(10, length(profession_counts_sorted))
    mprintf("%s\t\t%d\n", unique(professions_column)(sorted_indices(i)), profession_counts_sorted(i));
end

// Création de l'histogramme
bar(profession_counts_sorted(1:min(10, length(profession_counts))));
title('Effectifs des 10 professions les plus représentées');
xlabel('Professions');
ylabel('Effectifs');

