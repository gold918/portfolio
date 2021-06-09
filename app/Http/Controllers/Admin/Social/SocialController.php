<?php

namespace App\Http\Controllers\Admin\Social;

use App\Http\Controllers\Controller;
use App\Model\Site\SiteSocial;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = SiteSocial::get();

        if(view()->exists('admin.social.index')) {
            return view('admin.social.index', ['socials' => $socials]);
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
        if(view()->exists('admin.social.create')) {
            return view('admin.social.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SiteSocial $social)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'link' => 'required|active_url',
        ]);

        if($request->has(['name', 'icon', 'link'])) {
            $social->name = $request->name;
            $social->icon = $request->icon;
            $social->link = $request->link;
            if($request->has('status')) {
                $social->status = 1;
            }
            $social->setDate($request->date);
            $social->save();
            return redirect()->route('admin.social');
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

    public function edit($id)
    {
        $social = SiteSocial::find($id);
        if(view()->exists('admin.social.update')) {
            return view('admin.social.update', ['social' => $social]);
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
        $social = SiteSocial::find($id);
        $rules = [
            'link' => 'active_url',
        ];
        $request->validate($rules);

        $social->updateField($request, 'name');
        $social->updateField($request, 'icon');
        $social->updateField($request, 'link');
        $social->updateFieldStatus($request);
        $social->setDate($request->date, 'updated_at');
        $social->save();
        return redirect()->route('admin.social');
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
            $social = SiteSocial::find($id);
            $social->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
