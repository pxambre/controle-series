<x-layout title="Series" :successMessage='$successMessage'>
    @auth <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Add Series</a> @endauth

    <ul class="list-group">
        @foreach ($series as $series)
        <li class="list-group-item d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . $series->cover_path) }}" width="50" class="img-thumbnail me-3">

                @auth <a href="{{ route('seasons.index', $series->id) }}"> @endauth
                    {{ $series->name }}
                    @auth </a> @endauth
            </div>
            @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $series->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <form action="{{ route('series.destroy', $series->id) }}" method="POST" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </span>
            @endauth
        </li>
        @endforeach
    </ul>
</x-layout>