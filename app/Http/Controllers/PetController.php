<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\PetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    protected PetRepository $apiPet;
    public function __construct(PetRepository $apiPet)
    {
        $this->apiPet = $apiPet;
    }

    public function index(){
        $data = $this->apiPet->getAll();
        return view('pets.index', ['pets' => $data]);
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }
    public function destroy($id){

    }


}
