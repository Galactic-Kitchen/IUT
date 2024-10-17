etudes_column = data(:,4)
salaires_column = data(:,7)
ages_column = data(:,2)
exp_column=data(:,6)

indices_hs = find(etudes_column == 0)
moyenne_salaire_hs = mean(salaires_column(indices_hs, 1))
moyenne_age_hs = mean(ages_column(indices_hs, 1))
moyenne_xp_hs = mean(exp_column(indices_hs, 1))

indices_bachelor = find(etudes_column == 1)
moyenne_salaire_bachelor = mean(salaires_column(indices_bachelor, 1))
moyenne_age_bachelor = mean(ages_column(indices_bachelor, 1))
moyenne_xp_bachelor = mean(exp_column(indices_bachelor, 1))

indices_master = find(etudes_column == 2)
moyenne_salaire_master = mean(salaires_column(indices_master, 1))
moyenne_age_master = mean(ages_column(indices_master, 1))
moyenne_xp_master = mean(exp_column(indices_master, 1))

indices_phd = find(etudes_column == 3)
moyenne_salaire_phd = mean(salaires_column(indices_phd, 1))
moyenne_age_phd = mean(ages_column(indices_phd, 1))
moyenne_xp_phd = mean(exp_column(indices_phd, 1))
