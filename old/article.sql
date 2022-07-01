SELECT title, year, description, edition, author
FROM books
INNER JOIN authors ON books.id_author = authors.id
ORDER BY title