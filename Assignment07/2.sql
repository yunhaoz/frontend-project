select albums.title, artists.name
from albums
join artists
on albums.artist_id=artists.artist_id
where title like '%on%'
order by title;