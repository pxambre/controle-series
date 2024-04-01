<x-layout title="Series">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Add Series</a>
    
    <ul class="list-group">
        @foreach ($series as $series)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $series->name }}
            
            <form action="{{ route('series.destroy', $series->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">X</button>
            </form>
            </form>
         </li>
        @endforeach
    </ul>
</x-layout>