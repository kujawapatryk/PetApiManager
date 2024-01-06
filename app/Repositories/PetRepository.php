<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PetRepository{

    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('PETSTORE_API_URL', 'https://petstore.swagger.io/v2/pet/');
    }
    public function getAll(): array{
//        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available&status=pending&status=sold');
        $response = Http::get($this->apiUrl.'findByStatus?status=pending');
        return $response->json();

    }

    public function getOne($id): array{
        $response = Http::get($this->apiUrl.$id);
        return $response->json();
    }

    public function create(array $data): array{

        $response = Http::post($this->apiUrl,$data);
        return $response->json();
    }

    public function delete($id){
        $response = Http::delete($this->apiUrl.$id);
        return $response;
    }

    public function update(array $data){
        $response = Http::put($this->apiUrl,$data);
        return $response->json();
    }

}
