// Extraction des colonnes pertinentes
ages = M(2:$, 2);  
salaires = M(2:$, 7); 

// Conversion des données en numérique
ages = evstr(ages);
salaires = evstr(salaires);

// Traçage du nuage de points (âge, salaire)
clf();
plot2d(ages,salaires,style=-1,..
  frameflag=6,axesflag=5);
xlabel("Age");
ylabel("Salaire");
title("Nuage de points: Age vs Salaire");

// Calcul de la droite de régression en utilisant les moindres carrés
n = length(ages);
X = [ones(n,1) ages];
b = X \ salaires;

// Coefficients de la droite de régression
intercept = b(1);
slope = b(2);

// Droite de régression
regression_line = intercept + slope * ages;

// Traçage de la droite de régression
plot2d(ages,regression_line,style=5);

// Calcul du coefficient de corrélation de Pearson
mean_ages = mean(ages);
mean_salaires = mean(salaires);

numerateur = sum((ages - mean_ages) .* (salaires - mean_salaires));
denominateur = sqrt(sum((ages - mean_ages).^2) * sum((salaires - mean_salaires).^2));

correlation_coeff = numerateur / denominateur;

disp("Coefficient de corrélation: " + string(correlation_coeff));
