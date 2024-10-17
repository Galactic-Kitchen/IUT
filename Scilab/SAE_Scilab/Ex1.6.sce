// Extraction et conversion des colonnes pertinentes en types numériques
genres = M(:, 3);                   // Genre
ages = evstr(M(:, 2));              // Âge
experiences = evstr(M(:, 6));       // Années d'expérience
salaires = evstr(M(:, 7));          // Salaire

// Initialisation des variables pour stocker les informations par genre
genre_labels = unique(genres);      // Récupère tous les genres uniques de la colonne des genres
n = size(genre_labels, 'r');
salaires_moyens = zeros(n, 1);
ages_moyens = zeros(n, 1);
experiences_moyennes = zeros(n, 1);

// Calcul des moyennes par genre
for i = 1:n
    genre = genre_labels(i);
    // Filtrer les données pour le genre actuel
    indices = find(strcmp(genres, genre));  // Utilisation de strcmp pour comparer les chaînes de caractères
    salaries = salaires(indices);
    age_group = ages(indices);
    experience_group = experiences(indices);

    // Calcul des moyennes
    salaires_moyens(i) = mean(salaries);
    ages_moyens(i) = mean(age_group);
    experiences_moyennes(i) = mean(experience_group);
end

// Affichage des résultats
for i = 1:n
    disp("Genre: " + genre_labels(i));
    disp("Salaire moyen: " + string(salaires_moyens(i)));
    disp("Âge moyen: " + string(ages_moyens(i)));
    disp("Expérience moyenne: " + string(experiences_moyennes(i)));
    disp("---------------------------");
end
