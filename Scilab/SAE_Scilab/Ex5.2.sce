// Extraction des colonnes pertinentes
experiences = M(2:$, 6);
salaires = M(2:$, 7);
niveaux_education = M(2:$, 4);

niveaux_education = niveaux_education(find(niveaux_education <> ""));

// Conversion des données en numérique pour les expériences et les salaires
experiences = evstr(experiences);
salaires = evstr(salaires);

// Définir les noms des niveaux d'éducation
education_names = ["High School", "Bachelor", "Master", "PhD"];

// Séparation des données en fonction du niveau d'études
niveaux = unique(niveaux_education);

// Traçage des nuages de points et des droites de régression pour chaque niveau d'études
clf();
for i = 1:size(niveaux, 1)
    niveau = niveaux(i);
    indices = find(niveaux_education == niveau);
    
    exp_niveau = experiences(indices);
    sal_niveau = salaires(indices);
    
    plot2d(exp_niveau, sal_niveau, style=i-7, frameflag=6, axesflag=5);
    xlabel("Expérience");
    ylabel("Salaire");
    title("Nuage de points: Expérience vs Salaire par Niveau d Études");
    
    // Calcul de la droite de régression
    n = length(exp_niveau);
    X = [ones(n, 1) exp_niveau];
    b = X \ sal_niveau;
    intercept = b(1);
    slope = b(2);
    regression_line = intercept + slope * exp_niveau;
    
    // Traçage de la droite de régression
    plot2d(exp_niveau, regression_line, style=i);
    
    // Calcul du coefficient de corrélation de Pearson
    mean_exp = mean(exp_niveau);
    mean_sal = mean(sal_niveau);
    numerateur = sum((exp_niveau - mean_exp) .* (sal_niveau - mean_sal));
    denominateur = sqrt(sum((exp_niveau - mean_exp).^2) * sum((sal_niveau - mean_sal).^2));
    correlation_coeff = numerateur / denominateur;
    
    // Conversion du niveau d'éducation en index
    niveau_index = find(niveaux == niveau);

    // Affichage des coefficients de corrélation avec le nom du niveau d'éducation
    disp("Coefficient de corrélation pour le niveau d études " + education_names(niveau_index) + ": " + string(correlation_coeff));
end
