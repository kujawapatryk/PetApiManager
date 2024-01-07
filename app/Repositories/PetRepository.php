<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetRepository{

    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('PETSTORE_API_URL', 'https://petstore.swagger.io/v2/pet/');
    }
    public function getAll(string $data): array{
        try {
            if ($data === 'all') {
                $status = 'available,pending,sold';
            }else {
                $status = $data;
            }
            $response = Http::get($this->apiUrl.'findByStatus?status='.$status);
            return $response->json();
        }catch (\Exception $e){
            Log::error("Error during getAll request: " . $e->getMessage());
            throw new \RuntimeException('Wystąpił błąd podczas pobierania danych.');
        }
    }

    public function getOne($id): array {
        try {
            $response = Http::get($this->apiUrl . $id);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw match ($response->status()) {
                    400 => new \RuntimeException('Podano nieprawidłowe ID.'),
                    404 => new \RuntimeException('Nie znaleziono zwierzęcia.'),
                    default => new \RuntimeException('Nieoczekiwany błąd, spróbuj później.'),
                };
            }
        } catch (\Exception $e) {
            Log::error("Error during getOne request: " . $e->getMessage());
            throw new \RuntimeException('Błąd podczas pobierania danych.');
        }
    }

    public function create(array $data): void{
        try {
            $response = Http::post($this->apiUrl,$data);
            if ($response->successful()) {
                return;
            }else {
                throw match ($response->status()) {
                    405 => new \RuntimeException('Nieprawidłowe dane wejściowe'),
                };
            }

        } catch (\Exception $e) {
            Log::error("Error during create request: " . $e->getMessage());
            throw new \RuntimeException('Błąd podczas tworzenia.');
        }

    }

    public function delete($id):void{
        try {
            $response = Http::delete($this->apiUrl.$id);
            if ($response->successful()) {
                return;
            } else {
                throw match ($response->status()) {
                    400 => new \RuntimeException('Podano nieprawidłowe ID.'),
                    404 => new \RuntimeException('Nie znaleziono zwierzęcia.'),
                };
            }

        } catch (\Exception $e) {
            Log::error("Error during delete request: " . $e->getMessage());
            throw new \RuntimeException('Błąd podczas usuwania danych.');
        }

    }

    public function update(array $data):void{
        try {
            $response = Http::put($this->apiUrl, $data);

            if ($response->successful()) {
                return;
            } else {
                throw match ($response->status()) {
                    400 => new \RuntimeException('Podano nieprawidłowe ID.'),
                    404 => new \RuntimeException('Nie znaleziono zwierzęcia.'),
                    405 => new \RuntimeException('Błąd walidacji.'),
                    default => new \RuntimeException('Nieoczekiwany błąd, spróbuj później.'),
                };
            }
        } catch (\Exception $e) {
            Log::error("Error during PUT request: " . $e->getMessage());
            throw new \RuntimeException('Błąd podczas aktualizacji danych.');
        }
    }

}
