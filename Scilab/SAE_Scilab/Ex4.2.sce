experience = M(:, 6);  // colonne expérience
salaire = M(:, 7);  // colonne salaire

// Conversion en vecteurs de type double
experience = evstr(experience);
salaire = evstr(salaire);

// Tracer le nuage de points
scf();  // créer une nouvelle figure
plot2d(experience,salaire,style=-1,..
  frameflag=6,axesflag=5);

// Calculer les coefficients de la droite de régression
n = length(experience);
mean_experience = sum(experience) / n;
mean_salaire = sum(salaire) / n;

SS_xy = sum(salaire .* experience) - n * mean_salaire * mean_experience;
SS_xx = sum(experience .* experience) - n * mean_experience * mean_experience;

m = SS_xy / SS_xx;
b = mean_salaire - m * mean_experience;

// Tracer la droite de régression
xp = linspace(min(experience), max(experience), 100)';
yp = m * xp + b;
plot(xp, yp, '-');  // tracer la droite

// Afficher le graphique
xlabel("Expérience");
ylabel("Salaire");
title("Nuage de points et droite de régression");

// Calculer le coefficient de corrélation
mean_exp_sal = mean(experience .* salaire);
correlation = (mean_exp_sal - mean_experience * mean_salaire) / (stdev(experience) * stdev(salaire));
disp("Le coefficient de corrélation est de " + string(correlation));
