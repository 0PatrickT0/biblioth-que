SELECT   COUNT(*) AS nbr_doublon, author
FROM     authors
GROUP BY author
HAVING   COUNT(*) > 1

DELETE FROM authors
LEFT OUTER JOIN (
        SELECT MIN(id) as id, author
        FROM authors
        GROUP BY author
    ) as t1 
    ON table.id = t1.id
WHERE t1.id IS NULL