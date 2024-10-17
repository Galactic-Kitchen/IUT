// Extraction des colonnes correspondant au genre et au niveau d'étude
genre_column = M(:, 3);
education_column = M(:, 4);

// Comptage du nombre d'occurrences de chaque niveau d'étude pour les hommes et les femmes
nb_high_school_male = sum((genre_column == "Male") & (education_column == "0"));
nb_bachelor_male = sum((genre_column == "Male") & (education_column == "1"));
nb_master_male = sum((genre_column == "Male") & (education_column == "2"));
nb_phd_male = sum((genre_column == "Male") & (education_column == "3"));

nb_high_school_female = sum((genre_column == "Female") & (education_column == "0"));
nb_bachelor_female = sum((genre_column == "Female") & (education_column == "1"));
nb_master_female = sum((genre_column == "Female") & (education_column == "2"));
nb_phd_female = sum((genre_column == "Female") & (education_column == "3"));

// Création des histogrammes
bar([nb_high_school_male, nb_bachelor_male, nb_master_male, nb_phd_male], 'grouped');
legend(["High School", "Bachelor", "Master", "PhD"], 'location', 'northwest');
title('Répartition des niveaux d études chez les hommes');

figure;
bar([nb_high_school_female, nb_bachelor_female, nb_master_female, nb_phd_female], 'grouped');
legend(["High School", "Bachelor", "Master", "PhD"], 'location', 'northwest');
title('Répartition des niveaux d études chez les femmes');
