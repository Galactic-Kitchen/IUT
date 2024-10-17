// Extraction colonne des professions
professions_column = M(:, 5);
gender_column = M(:, 3);

unique_professions = unique(professions_column);

nb_per_male = zeros(size(unique_professions));
nb_per_female = zeros(size(unique_professions));

for i= 1:size(unique_professions)(1)
    nb_per_male(i) = sum((gender_column == "Male") & (professions_column == unique_professions(i)));
    nb_per_female(i) = sum((gender_column == "Female") & (professions_column == unique_professions(i)));
end

[max_male, indice_male] = max(nb_per_male);
most_common_profession_male = unique_professions(indice_male);

[max_female, indice_female] = max(nb_per_female);
most_common_profession_female = unique_professions(indice_female);

mprintf('La profession la plus fréquente des hommes est : %s\n', most_common_profession_male);
mprintf('La profession la plus fréquente des femmes est : %s\n', most_common_profession_female);
