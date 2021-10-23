select title, award,genres.genre,labels.label,ratings.rating
from dvd_titles
join genres
on dvd_titles.genre_id = genres.genre_id
join ratings
on dvd_titles.rating_id = ratings.rating_id
join labels
on dvd_titles.label_id = labels.label_id
where dvd_titles.genre_id = 9
order by award desc;