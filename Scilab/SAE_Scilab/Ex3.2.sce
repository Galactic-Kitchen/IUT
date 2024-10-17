// Extraction de la colonne correspondant au niveau d'études et aux salaires
nv_etude_column = M(:, 4);
salaires_column = data(:, 7);

// Identification des niveaux d'études uniques
nv_etude_column = nv_etude_column(find(nv_etude_column <> ""));
etudes = unique(nv_etude_column);

// Initialisation d'un vecteur pour les moyennes des salaires
moyennes_salaires = zeros(size(etudes, 1));

// Calcul des moyennes des salaires pour chaque niveau d'études
for i = 1:size(etudes, 1)
    indices = find(nv_etude_column == etudes(i));
    moyennes_salaires(i) = mean(salaires_column(indices));
end

// Tracé de l'histogramme des moyennes des salaires
figure();
bar(moyennes_salaires);
xlabel('Niveau d''études');
ylabel('Moyenne des salaires');
title('Moyenne des salaires par niveau d''études');

// Enregistrement de l'image
xs2png(gcf(), 'Ex3.2.salaires.png');
