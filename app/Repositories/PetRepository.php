<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PetRepository{

    public function getAll(): array{
//        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available&status=pending&status=sold');
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=pending');
        return $response->json();

    }

    public function getOne($id): array{
        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
        return $response->json();
    }

    public function create(array $data): array{

        $response = Http::post('https://petstore.swagger.io/v2/pet',$data);
        return $response->json();
    }

    public function delete($id){
        $response = Http::delete('https://petstore.swagger.io/v2/pet/'.$id);
        return $response;
    }

    public function update(array $data){
        $response = Http::put('https://petstore.swagger.io/v2/pet/',$data);
        return $response->json();
    }

}
