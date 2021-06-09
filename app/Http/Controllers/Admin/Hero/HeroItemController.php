<?php

namespace App\Http\Controllers\Admin\Hero;

use App\Http\Controllers\Controller;
use App\Model\Site\HeroMain;
use App\Model\Site\HeroIconBox;
use Illuminate\Http\Request;

class HeroItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.hero.item.create')) {
            return view('admin.hero.item.create', ['singleId' => $singleId]);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $singleId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $singleId)
    {
        $request->validate([
            'title' => 'required',
            'alias' => 'required|regex:/^([a-zA-Z]+-?)+$/|unique:hero_icon_boxes,alias',
            'icon' => 'required',
        ]);

        $hero = HeroMain::find($singleId);

        if($request->has(['title', 'alias', 'icon'])) {
            $heroItem = new HeroIconBox();
            $heroItem->title = $request->title;
            $heroItem->alias = $request->alias;
            $heroItem->icon = $request->icon;
            if($request->has('status')) {
                $heroItem->status = 1;
            }
            $heroItem->setDate($request->date);
            $hero->heroIconBoxesAll()->save($heroItem);
            return redirect()->route('hero.single', ['id' => $hero->id]);
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($singleId, $id)
    {
        $hero = HeroMain::find($singleId);
        $heroItem = HeroIconBox::find($id);
        $aliases = HeroMain::pluck('alias', 'id');
        $data = compact('hero', 'heroItem', 'aliases');
        if(view()->exists('admin.hero.item.update')) {
            return view('admin.hero.item.update', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $singleId, $id)
    {

        $heroItem = HeroIconBox::find($id);
        $rules = [
            'alias' => 'regex:/^([a-zA-Z]+-?)+$/',
        ];
        if(isset($heroItem->alias) && $request->exists('alias') && $request->alias !== $heroItem->alias) {
            $rules['alias'] = 'regex:/^([a-zA-Z]+-?)+$/|unique:hero_icon_boxes,alias';
        }
        $request->validate($rules);

        $heroItem->updateField($request, 'title');
        $heroItem->updateField($request, 'alias');
        $heroItem->updateField($request, 'icon');
        $heroItem->updateFieldStatus($request);
        $heroItem->setDate($request->date, 'updated_at');


        if($request->exists('mainElement') && strpos($request->mainElement, $heroItem->heroMain->alias) === false ) {
            $idKey = explode(' - ', $request->mainElement);
            $hero = HeroMain::find($idKey[0]);
            $heroItem->heroMain()->associate($hero);
        }
        $heroItem->save();
        return redirect()->route('hero.single', ['id' => $singleId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($singleId, $id)
    {
        try{
            $heroItem = HeroIconBox::find($id);
            $heroItem->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
