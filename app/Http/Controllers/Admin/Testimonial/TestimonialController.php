<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Testimonial;
use App\Model\Site\TestimonialItem;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();

        if(view()->exists('admin.testimonial.index')) {
            return view('admin.testimonial.index', ['testimonials' => $testimonials]);
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
        if(view()->exists('admin.testimonial.create')) {
            return view('admin.testimonial.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'background_image' => 'required|image',
        ]);

        if($request->has(['background_image'])) {
            $testimonial->uploadImage($request->file('background_image'), 'img', 'background_image');
            if($request->has('status')) {
                $testimonial->status = 1;
            }
            $testimonial->setDate($request->date);
            $testimonial->save();
            return redirect()->route('admin.testimonial');
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
        $testimonial = Testimonial::find($id);
        $testimonialItems = $testimonial->testimonialItemsAll;
        if(view()->exists('admin.testimonial.item.index')) {
            return view('admin.testimonial.item.index', ['testimonial' => $testimonial, 'testimonialItems' => $testimonialItems]);
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
        $testimonial = Testimonial::find($id);
        if(view()->exists('admin.testimonial.update')) {
            return view('admin.testimonial.update', ['testimonial' => $testimonial]);
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
        $testimonial = Testimonial::find($id);
        $rules = [
            'background_image' => 'image',
        ];
        $request->validate($rules);

        $testimonial->uploadImage($request->file('background_image'), 'img', 'background_image');
        $testimonial->updateFieldStatus($request);
        $testimonial->setDate($request->date, 'updated_at');
        $testimonial->save();
        return redirect()->route('admin.testimonial');
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
            $testimonial = Testimonial::find($id);
            $testimonialItems = $testimonial->testimonialItemsAll;
            if(isset($testimonialItems) && is_object($testimonialItems)) {
                $testimonial->testimonialItemsAll()->delete();
                foreach ($testimonialItems as $item) {
                    $item->removeImage('img/testimonials', 'photo');
                }
            }
            $testimonial->delete();
            $testimonial->removeImage('img', 'background_image');
            if (isset($request->redirect)) {
                return response($request->redirect);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
