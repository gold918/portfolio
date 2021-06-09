<?php

namespace App\Http\Controllers\Admin\Count;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Count;
use App\Model\Site\CountItem;

class CountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = Count::get();

        if(view()->exists('admin.count.index')) {
            return view('admin.count.index', ['counts' => $counts]);
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
        if(view()->exists('admin.count.create')) {
            return view('admin.count.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Count $count)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'text' => 'required'
        ]);

        if($request->has(['title', 'image', 'text'])) {
            $count->title = $request->title;
            $count->text = $request->text;
            $count->uploadImage($request->file('image'), 'img', 'image');
            if($request->has('status')) {
                $count->status = 1;
            }
            $count->setDate($request->date);
            $count->save();
            return redirect()->route('admin.count');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = count::find($id);
        $countItems = $count->countItemsAll;
        if(view()->exists('admin.count.item.index')) {
            return view('admin.count.item.index', ['count' => $count, 'countItems' => $countItems]);
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
        $count = Count::find($id);
        if(view()->exists('admin.count.update')) {
            return view('admin.count.update', ['count' => $count]);
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
        $count = Count::find($id);
        $rules = [
            'image' => 'image',
        ];
        $request->validate($rules);

        $count->updateField($request, 'title');
        $count->updateField($request, 'text');
        $count->uploadImage($request->file('image'), 'img', 'image');
        $count->updateFieldStatus($request);
        $count->setDate($request->date, 'updated_at');
        $count->save();
        return redirect()->route('admin.count');
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
            $count = Count::find($id);
            if(isset($count->countItemsAll) && is_object($count->countItemsAll)) {
                $count->countItemsAll()->delete();
            }
            $count->delete();
            $count->removeImage('img', 'image');
            if (isset($request->redirect)) {
                return response($request->redirect);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
