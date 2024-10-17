clf();
column_xp=data(:,6);
histplot(10, column_xp);
xlabel('Expérience');
ylabel('Nombre de personnes');
title('Distribution de l''expérience');
xs2png(gcf(), "Ex2.2.png");
