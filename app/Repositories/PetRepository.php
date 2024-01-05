<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PetRepository{

    public function getAll(): JsonResponse{
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available&status=pending&status=sold');
        return $response->json();

    }

    public function getOne($id): JsonResponse{
        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
        return $response->json();
    }

}
