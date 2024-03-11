<form method="GET" enctype="multipart/form-data" id="placeSearchForm" action="{{ $urllocaliser->route('filter') }}">
    @csrf

    <label for="place">{{ __('Place name') }}</label>
    <input type="text" name="place" id="place" placeholder="{{ __('Search for a place name') }}"></input>
    <input type="submit" value="{{ __('Search') }}">
</form>