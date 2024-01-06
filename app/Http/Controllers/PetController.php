<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetStatusRequest;
use App\Http\Requests\StorePetRequest;
use App\Repositories\PetRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PetController extends Controller
{
    protected PetRepository $apiPet;
    public function __construct(PetRepository $apiPet)
    {
        $this->apiPet = $apiPet;
    }

    public function index(PetStatusRequest $request): View{
        $status = $request->input('status', 'all');
        $data = $this->apiPet->getAll($status);
        return view('pets.index', ['pets' => $data]);
    }

    public function create(): View{
        return view('pets.create');
    }

    public function store(StorePetRequest $request): RedirectResponse{
        $data = $request->validated();
        $this->apiPet->create($data);
        return redirect()->route('pets.index');
    }

    public function show($id){

    }

    public function edit($id): View{
        $pet = $this->apiPet->getOne($id);
        return view('pets.edit', ['pet' => $pet]);
    }

    public function update(StorePetRequest $request): RedirectResponse{
        $data = $request->validated();
        $result = $this->apiPet->update($data);
        return redirect()->route('pets.index');
    }
    public function destroy(int $id): RedirectResponse{

        $response = $this->apiPet->delete($id);
        return redirect()->route('pets.index');
    }


}
