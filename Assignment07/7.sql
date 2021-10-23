select title,release_date ,ratings.rating,genres.genre,sounds.sound,labels.label
from dvd_titles
join genres
on dvd_titles.genre_id = genres.genre_id
join ratings
on dvd_titles.rating_id = ratings.rating_id
join labels
on dvd_titles.label_id = labels.label_id
join sounds
on dvd_titles.sound_id = sounds.sound_id
where dvd_titles.rating_id = 7
order by release_date desc;