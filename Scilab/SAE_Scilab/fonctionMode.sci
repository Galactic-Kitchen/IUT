function m = trouverMode(valeurs)

    sortie = tabul(valeurs); //compter les occurences
    //la colonne 1 contient les valeurs, la colonne 2 les occurences
    // Trouver la valeur la plus souvent présente
    [occurence, index] = max(sortie(:,2));

    m = sortie(:,1)(index);
endfunction
