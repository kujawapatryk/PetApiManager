@extends('layouts.guest')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-center my-5">Lista Zwierząt</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($pets as $pet)
                <div class="bg-white rounded-lg shadow-md p-5 mb-4">
                    <p class="text-lg font-semibold">ID: {{ $pet['id'] }}</p>
                    <p>Kategoria: <span class="font-medium">{{ $pet['category']['name'] ?? 'Brak' }}</span></p>
                    <p>Nazwa: <span class="text-blue-600">
                    @isset($pet['name'])
                                {{ $pet['name'] }}
                            @endisset
                </span></p>
                    @if (!empty($pet['photoUrls']))
                        <p>URL zdjęcia: <a href="{{ $pet['photoUrls'][0] }}" class="text-blue-400 hover:text-blue-600" target="_blank">{{ $pet['photoUrls'][0] }}</a></p>
                    @endif
                    @if (!empty($pet['tags']))
                        <p class="flex flex-wrap gap-2">
                            Tagi:
                            @foreach ($pet['tags'] as $tag)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                @if (!empty($tag['name']))
                                        {{ $tag['name'] }}
                                    @endif
                            </span>
                            @endforeach
                        </p>
                    @endif
                    <p>Status: <span class="px-2 py-1 rounded {{ $pet['status'] == 'available' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">{{ $pet['status'] }}</span></p>

                    <!-- Przyciski edycji i usuwania -->
                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ route('pets.edit', $pet['id']) }}" class="inline-block text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded transition-colors duration-200">
                            Edytuj
                        </a>
                        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded" onclick="return confirm('Czy na pewno chcesz usunąć?');">
                                Usuń
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
