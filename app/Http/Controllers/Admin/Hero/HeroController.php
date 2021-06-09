<?php

namespace App\Http\Controllers\Admin\Hero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\HeroMain;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = HeroMain::get();

        if(view()->exists('admin.hero.index')) {
            return view('admin.hero.index', ['heroes' => $heroes]);
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
        if(view()->exists('admin.hero.create')) {
            return view('admin.hero.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HeroMain $hero)
    {
        $request->validate([
            'title' => 'required',
            'alias' => 'required|regex:/^([a-zA-Z]+-?)+$/|unique:hero_main,alias',
            'image' => 'required|image',
            'text' => 'required'
        ]);

        if($request->has(['title', 'alias', 'image', 'text'])) {
            $hero->title = $request->title;
            $hero->alias = $request->alias;
            $hero->text = $request->text;
            $hero->uploadImage($request->file('image'), 'img', 'background_image');
            if($request->has('status')) {
                $hero->status = 1;
            }
            $hero->setDate($request->date);
            $hero->save();
            return redirect()->route('admin.hero');
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
        $hero = HeroMain::find($id);
        $heroItems = $hero->heroIconBoxesAll;
        if(view()->exists('admin.hero.item.index')) {
            return view('admin.hero.item.index', ['hero' => $hero, 'heroItems' => $heroItems]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hero = HeroMain::find($id);
        if(view()->exists('admin.hero.update')) {
            return view('admin.hero.update', ['hero' => $hero]);
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
        $hero = HeroMain::find($id);
        $rules = [
            'alias' => 'regex:/^([a-zA-Z]+-?)+$/',
            'image' => 'image',
        ];
        if(isset($hero->alias) && $request->exists('alias') && $request->alias !== $hero->alias) {
            $rules['alias'] = 'regex:/^([a-zA-Z]+-?)+$/|unique:hero_main,alias';
        }
        $request->validate($rules);

        $hero->updateField($request, 'title');
        $hero->updateField($request, 'alias');
        $hero->updateField($request, 'text');
        $hero->uploadImage($request->file('image'), 'img', 'background_image');
        $hero->updateFieldStatus($request);
        $hero->setDate($request->date, 'updated_at');
        $hero->save();
        return redirect()->route('admin.hero');
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
            $hero = HeroMain::find($id);
            if(isset($hero->HeroIconBoxesAll) && is_object($hero->HeroIconBoxesAll)) {
                $hero->HeroIconBoxesAll()->delete();
            }
            $hero->delete();
            $hero->removeImage('img', 'background_image');
            if (isset($request->redirect)) {
                return response(route('admin.hero'));
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
