<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetStatusRequest;
use App\Http\Requests\StorePetRequest;
use App\Repositories\PetRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PetController extends Controller
{
    protected PetRepository $apiPet;
    public function __construct(PetRepository $apiPet)
    {
        $this->apiPet = $apiPet;
    }

    public function index(PetStatusRequest $request): View|RedirectResponse{
        try {
            $status = $request->input('status', 'all');
            $data = $this->apiPet->getAll($status);
            return view('pets.index', ['pets' => $data]);
        }catch (\RuntimeException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }catch (\Exception $e){
            Log::error("Error petController, index: " . $e->getMessage());
            return redirect()->back()->withErrors('Wystąpił błąd, spróbuj później.');
        }
    }

    public function create(): View{
        return view('pets.create');
    }

    public function store(StorePetRequest $request): RedirectResponse{
        try {
            $data = $request->validated();
            $this->apiPet->create($data);
            return redirect()->route('pets.index');
        }catch (\RuntimeException $e){
            return redirect()->route('pets.index')->withErrors($e->getMessage());
        }catch (\Exception $e){
            Log::error("Error petController, store: " . $e->getMessage());
            return redirect()->back()->withErrors('Wystąpił błąd, spróbuj później.');
        }

    }
    public function edit($id): View|RedirectResponse{
        try {
            $pet = $this->apiPet->getOne($id);
            return view('pets.edit', ['pet' => $pet]);
        }catch (\RuntimeException $e){
            return redirect()->route('pets.index')->withErrors($e->getMessage());
        }catch (\Exception $e){
            Log::error("Error petController, edit: " . $e->getMessage());
            return redirect()->back()->withErrors('Wystąpił błąd, spróbuj później.');
        }
    }

    public function update(StorePetRequest $request): RedirectResponse{
        try {
            $data = $request->validated();
            $this->apiPet->update($data);
            return redirect()->route('pets.index')->with('success', 'Zmiany zostały zapisane.');
        }catch (\RuntimeException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }catch (\Exception $e){
            Log::error("Error petController, update: " . $e->getMessage());
            return redirect()->back()->withErrors('Wystąpił błąd, spróbuj później.');
        }
    }
    public function destroy(int $id): RedirectResponse{
        try {
            $this->apiPet->delete($id);
            return redirect()->route('pets.index')->with('success', 'Rekord zostały usunięte.');
        }catch (\RuntimeException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }catch (\Exception $e){
            Log::error("Error petController, edit: " . $e->getMessage());
            return redirect()->back()->withErrors('Wystąpił błąd, spróbuj później.');
        }

    }


}
