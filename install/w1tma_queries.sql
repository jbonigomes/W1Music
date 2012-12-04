-- SONGS VIEW QUERY
SELECT a.name AS 'Name', s.title AS 'Title', s.duration AS 'Duration'
FROM song s
INNER JOIN artist a ON s.artist_id = a.id
ORDER BY a.name, s.title;

-- ARTISTS VIEW QUERY
SELECT a.name AS 'Artist', COUNT(s.id) AS 'SongsCount'
FROM song s
INNER JOIN artist a ON s.artist_id = a.id
GROUP BY a.name
ORDER BY a.name;

-- TOTAL NUMBER OF SONGS QUERY
SELECT COUNT(id) AS 'SongsTotal'
FROM song;

-- TOTAL NUMBER OF ACTIVE ARTISTS QUERY
SELECT COUNT(DISTINCT(artist_id)) AS 'ArtitsTotal'
FROM song;