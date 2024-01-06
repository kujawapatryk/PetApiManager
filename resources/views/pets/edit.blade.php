@extends('layouts.guest')

@section('content')
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST" class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID:</label>
            <input type="number" id="id" name="id" value="{{ $pet['id'] }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">ID Kategorii:</label>
            <input type="number" id="category_id" name="category[id]" value="{{ $pet['category']['id'] ?? '' }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="category_name" class="block text-gray-700 text-sm font-bold mb-2">Nazwa Kategorii:</label>
            <input type="text" id="category_name" name="category[name]" value="{{ $pet['category']['name'] ?? '' }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nazwa:</label>
            <input type="text" id="name" name="name" value="{{ $pet['name'] ?? '' }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="photoUrls" class="block text-gray-700 text-sm font-bold mb-2">URL Zdjęcia:</label>
            @if(isset($pet['photoUrls']) && is_array($pet['photoUrls']))
                @foreach ($pet['photoUrls'] as $url)
                    <input type="text" name="photoUrls[]" value="{{ $url }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
                @endforeach
            @else
                <input type="text" id="photoUrls" name="photoUrls[]" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @endif
        </div>

        <div class="mb-4">
            <label for="tags_id" class="block text-gray-700 text-sm font-bold mb-2">ID Tagu:</label>
            <input type="number" id="tags_id" name="tags[0][id]" value="{{ $pet['tags'][0]['id'] ?? '' }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="tags_name" class="block text-gray-700 text-sm font-bold mb-2">Nazwa Tagu:</label>
            <input type="text" id="tags_name" name="tags[0][name]" value="{{ $pet['tags'][0]['name'] ?? '' }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select id="status" name="status" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="available" {{ ($pet['status'] == 'available') ? 'selected' : '' }}>Dostępny</option>
                <option value="pending" {{ ($pet['status'] == 'pending') ? 'selected' : '' }}>Oczekujący</option>
                <option value="sold" {{ ($pet['status'] == 'sold') ? 'selected' : '' }}>Sprzedany</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Zaktualizuj
            </button>
        </div>
    </form>
@endsection
