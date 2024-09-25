<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {

        //per evitare che si ripetano le stesse tipologie, verificare se esiste già una tipologia

        $exists = Type::where('name', $request->name)->first();

        if(!$exists){

        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['name'], Type::class);

        $type = Type::create($data);

            return redirect()->route('admin.types.index')->with('success', 'La tipologia è stata inserita correttamente');

        }else{

            return redirect()->route('admin.types.index')->with('error', 'Attenzione! La tipologia è già presente');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Type::class);

        $type->update($data);

        return redirect()->route('admin.types.index')->with('edited', 'La tipologia è stata modificata correttamente');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('deleted', 'La tipologia è stata eliminata correttamente');
    }
}
