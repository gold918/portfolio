<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::get();

        if(view()->exists('admin.contact.map.index')) {
            return view('admin.contact.map.index', ['maps' => $maps]);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(view()->exists('admin.contact.map.create')) {
            return view('admin.contact.map.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Map $map)
    {
        $request->validate([
            'link' => 'required|active_url',
        ]);

        if($request->has(['link'])) {
            $map->link = $request->link;
            if($request->has('status')) {
                $map->status = 1;
            }
            $map->setDate($request->date);
            $map->save();
            return redirect()->route('admin.map');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    public function edit($id)
    {
        $map = Map::find($id);
        if(view()->exists('admin.contact.map.update')) {
            return view('admin.contact.map.update', ['map' => $map]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $map = Map::find($id);
        $rules = [
            'link' => 'active_url',
        ];
        $request->validate($rules);

        $map->updateField($request, 'link');
        $map->updateFieldStatus($request);
        $map->setDate($request->date, 'updated_at');
        $map->save();
        return redirect()->route('admin.map');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $map = Map::find($id);
            $map->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
