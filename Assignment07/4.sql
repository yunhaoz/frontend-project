select tracks.track_id,tracks.name as track_name,tracks.composer,genres.name as genre_name
from tracks
join genres
on tracks.genre_id = genres.genre_id
where composer is not null and (tracks.genre_id = '2' or tracks.genre_id = '14')
order by tracks.name desc;