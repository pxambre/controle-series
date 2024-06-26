<x-layout title="New Series">

    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">Title:</label>

                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    autofocus>
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Seasons:</label>

                <input type="text" name="seasonsQty" id="seasonsQty" class="form-control"
                    value="{{ old('seasonsQty') }}">
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episodes:</label>

                <input type="text" name="episodesPerSeason" id="episodesPerSeason" class="form-control"
                    value="{{ old('episodesPerSeason') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Cover</label>
                <input type="file"
                    id="cover"
                    name="cover"
                    accept="image/gif, image/jpeg, image/png"
                    class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Submit</button>
    </form>
</x-layout>
