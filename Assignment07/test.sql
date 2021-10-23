select title,release_date,genres.genre,ratings.rating
from dvd_titles
join genres
on genres.genre_id = dvd_titles.genre_id
join ratings
on ratings.rating_id = dvd_titles.rating_id
where 1=1;