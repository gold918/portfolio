<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::get();

        if(view()->exists('admin.about.index')) {
            return view('admin.about.index', ['about' => $about]);
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
        if(view()->exists('admin.about.create')) {
            return view('admin.about.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, About $about)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required|image',
            'text' => 'required'
        ]);

        if($request->has(['title', 'subtitle', 'image', 'text'])) {
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->text = $request->text;
            $about->uploadImage($request->file('image'), 'img', 'image');
            if($request->has('status')) {
                $about->status = 1;
            }
            $about->setDate($request->date);
            $about->save();
            return redirect()->route('admin.about');
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
        $about = About::find($id);
        $aboutItems = $about->aboutItemsAll;
        if(view()->exists('admin.about.item.index')) {
            return view('admin.about.item.index', ['about' => $about, 'aboutItems' => $aboutItems]);
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
        $about = About::find($id);
        if(view()->exists('admin.hero.update')) {
            return view('admin.about.update', ['about' => $about]);
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
        $about = About::find($id);
        $rules = [
            'image' => 'image',
        ];
        $request->validate($rules);

        $about->updateField($request, 'title');
        $about->updateField($request, 'subtitle');
        $about->updateField($request, 'text');
        $about->uploadImage($request->file('image'), 'img', 'image');
        $about->updateFieldStatus($request);
        $about->setDate($request->date, 'updated_at');
        $about->save();
        return redirect()->route('admin.about');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $about = About::find($id);
            if(isset($about->aboutItemsAll) && is_object($about->aboutItemsAll)) {
                $about->aboutItemsAll()->delete();
            }
            $about->delete();
            $about->removeImage('img', 'image');
            if (isset($request->redirect)) {
                return response(route('admin.about'));
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
