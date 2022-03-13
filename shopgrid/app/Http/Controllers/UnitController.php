<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unit;
    public $units;

    public function index()
    {
        return view('admin.unit.add');
    }

    public function create(Request $request)
    {
        $this->unit = new Unit();
        $this->unit->name           = $request->name;
        $this->unit->description    = $request->description;
        $this->unit->save();
        return redirect('/add-unit')->with('message', 'Unit info create successfully');
    }

    public function manage()
    {
        $this->units = Unit::orderBy('id', 'desc')->get();
        return view('admin.unit.manage', ['units' => $this->units]);
    }

    public function edit($id)
    {
        $this->unit = Unit::find($id);
        return view('admin.unit.edit', ['unit' => $this->unit]);
    }

    public function update(Request $request, $id)
    {
        $this->unit = Unit::find($id);
        $this->unit->name           = $request->name;
        $this->unit->description    = $request->description;
        $this->unit->save();
        return redirect('/manage-unit')->with('message','Unit info update successfully');
    }

    public function delete($id)
    {
        $this->unit = Unit::find($id);
        $this->unit->delete();
        return redirect('/manage-unit')->with('message','Unit info delete successfully');
    }
}
