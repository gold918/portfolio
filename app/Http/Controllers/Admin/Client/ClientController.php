<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();

        if(view()->exists('admin.client.index')) {
            return view('admin.client.index', ['clients' => $clients]);
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
        if(view()->exists('admin.client.create')) {
            return view('admin.client.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image',
        ]);

        if($request->has(['name', 'logo'])) {
            $client->name = $request->name;
            $client->uploadImage($request->file('logo'), 'img/clients', 'logo');
            if($request->has('status')) {
                $client->status = 1;
            }
            $client->setDate($request->date);
            $client->save();
            return redirect()->route('admin.client');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if(view()->exists('admin.client.update')) {
            return view('admin.client.update', ['client' => $client]);
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
        $client = Client::find($id);
        $rules = [
            'logo' => 'image',
        ];
        $request->validate($rules);

        $client->updateField($request, 'name');
        $client->uploadImage($request->file('logo'), 'img/clients', 'logo');
        $client->updateFieldStatus($request);
        $client->setDate($request->date, 'updated_at');
        $client->save();
        return redirect()->route('admin.client');
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
            $client = Client::find($id);
            $client->delete();
            $client->removeImage('img/clients', 'logo');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
