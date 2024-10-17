// Extraction des colonnes pertinentes
experiences = M(2:$, 6);
salaires = M(2:$, 7);
genres = M(2:$, 3);

// Conversion des données en numérique pour les expériences et les salaires
experiences = evstr(experiences);
salaires = evstr(salaires);

// Séparation des données en fonction du genre
hommes_exp = experiences(genres == "Male");
hommes_sal = salaires(genres == "Male");
femmes_exp = experiences(genres == "Female");
femmes_sal = salaires(genres == "Female");

// Traçage du nuage de points pour les hommes
clf();
plot2d(hommes_exp, hommes_sal, style=-1, frameflag=6, axesflag=5);
xlabel("Expérience");
ylabel("Salaire");
title("Nuage de points: Expérience vs Salaire (Hommes et Femmes)");

// Traçage du nuage de points pour les femmes
plot2d(femmes_exp, femmes_sal, style=-2, frameflag=6, axesflag=5);

// Calcul de la droite de régression pour les hommes
n_hommes = length(hommes_exp);
X_hommes = [ones(n_hommes, 1) hommes_exp];
b_hommes = X_hommes \ hommes_sal;
intercept_hommes = b_hommes(1);
slope_hommes = b_hommes(2);
regression_line_hommes = intercept_hommes + slope_hommes * hommes_exp;

// Calcul de la droite de régression pour les femmes
n_femmes = length(femmes_exp);
X_femmes = [ones(n_femmes, 1) femmes_exp];
b_femmes = X_femmes \ femmes_sal;
intercept_femmes = b_femmes(1);
slope_femmes = b_femmes(2);
regression_line_femmes = intercept_femmes + slope_femmes * femmes_exp;

// Traçage des droites de régression
plot2d(hommes_exp, regression_line_hommes, style=5);
plot2d(femmes_exp, regression_line_femmes, style=6);

// Calcul du coefficient de corrélation de Pearson pour les hommes
mean_hommes_exp = mean(hommes_exp);
mean_hommes_sal = mean(hommes_sal);
numerateur_hommes = sum((hommes_exp - mean_hommes_exp) .* (hommes_sal - mean_hommes_sal));
denominateur_hommes = sqrt(sum((hommes_exp - mean_hommes_exp).^2) * sum((hommes_sal - mean_hommes_sal).^2));
correlation_coeff_hommes = numerateur_hommes / denominateur_hommes;

// Calcul du coefficient de corrélation de Pearson pour les femmes
mean_femmes_exp = mean(femmes_exp);
mean_femmes_sal = mean(femmes_sal);
numerateur_femmes = sum((femmes_exp - mean_femmes_exp) .* (femmes_sal - mean_femmes_sal));
denominateur_femmes = sqrt(sum((femmes_exp - mean_femmes_exp).^2) * sum((femmes_sal - mean_femmes_sal).^2));
correlation_coeff_femmes = numerateur_femmes / denominateur_femmes;

// Affichage des coefficients de corrélation
disp("Coefficient de corrélation pour les hommes: " + string(correlation_coeff_hommes));
disp("Coefficient de corrélation pour les femmes: " + string(correlation_coeff_femmes));
