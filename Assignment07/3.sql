select tracks.name as track_name,tracks.composer,media_types.name as media_type
from tracks
join media_types
on tracks.media_type_id = media_types.media_type_id
where tracks.media_type_id = '5';