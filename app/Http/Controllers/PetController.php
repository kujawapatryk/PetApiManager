<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Repositories\PetRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController extends Controller
{
    protected PetRepository $apiPet;
    public function __construct(PetRepository $apiPet)
    {
        $this->apiPet = $apiPet;
    }

    public function index(): View{
        $data = $this->apiPet->getAll();


        return view('pets.index', ['pets' => $data]);
    }

    public function create(){
        return view('pets.create');
    }

    public function store(StorePetRequest $request){
        $data = $request->validated();
        $response = $this->apiPet->create($data);
//        dd($response);
        return redirect()->route('pets.index');
    }

    public function show($id){

    }

    public function edit($id): View{

    }

    public function update(StorePetRequest $request, $id){

    }
    public function destroy(int $id){

        $response = $this->apiPet->delete($id);
    }


}
