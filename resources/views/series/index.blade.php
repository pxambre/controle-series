<x-layout title="Series">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Add Series</a>

    @isset($successMessage)
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endisset

    <ul class="list-group">
        @foreach ($series as $series)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('seasons.index', $series->id) }}">
                {{ $series->name }}
            </a>

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
        </li>
        @endforeach
    </ul>
</x-layout>