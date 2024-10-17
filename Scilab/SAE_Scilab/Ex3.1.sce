// Extraction de la colonne correspondant au genre
genre_column = M(:, 3);
salaires_column = data(:,7)

genres = unique(genre_column)
indices = cell(size(genres));

for i = 1:size(genres, 1)
    indices{i} = find(genre_column == genres(i));
    figure()
    histplot(10, salaires_column(indices{i}));
    xs2png(gcf(), msprintf("Ex3.1.%s.png", genres(i)));
end
