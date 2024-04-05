<x-mail::message>
# New Series Added!

<br>

- **Series**: {{ $seriesName }} 
- **Seasons**: {{ $seasonsQty }}
- **Episodes**: {{ $episodesPerSeason }}
 
<x-mail::button :url="route('seasons.index', $seriesId)">
Watch Now
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>