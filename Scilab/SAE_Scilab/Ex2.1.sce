clf();
column_ages=data(:,2);
histplot(10, column_ages);
xlabel('Âge');
ylabel('Nombre de personnes');
title('Distribution des âges');
xs2png(gcf(), "Ex2.1.png");
