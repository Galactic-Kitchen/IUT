column_ages=data(:,2);
close(); //tentative de nettoyer les figures

clf();
boxplot(column_ages, "whisker", 1); //donnée empirique afin de rendre la boite à moustache plus proche de la réalité
title('Réparttion des âges');
xs2png(gcf(), 'Ex2.4.png');
