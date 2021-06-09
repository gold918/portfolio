<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Model\Site\TestimonialItem;
use App\Model\Site\Testimonial;
use Illuminate\Http\Request;

class TestimonialItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.testimonial.item.create')) {
            return view('admin.testimonial.item.create', ['singleId' => $singleId]);
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
            'name' => 'required',
            'position' => 'required',
            'review' => 'required',
            'photo' => 'required|image',
        ]);

        $testimonial = Testimonial::find($singleId);

        if($request->has(['name', 'position', 'photo', 'review'])) {
            $testimonialItem = new TestimonialItem;
            $testimonialItem->name = $request->name;
            $testimonialItem->uploadImage($request->file('photo'), 'img/testimonials', 'photo');
            $testimonialItem->position = $request->position;
            $testimonialItem->review = $request->review;
            if($request->has('status')) {
                $testimonialItem->status = 1;
            }
            $testimonialItem->setDate($request->date);
            $testimonial->testimonialItemsAll()->save($testimonialItem);
            return redirect()->route('admin.testimonial.single', ['id' => $testimonial->id]);
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
        $testimonial = Testimonial::find($singleId);
        $testimonialItem = TestimonialItem::find($id);
        $elements = Testimonial::pluck('id');
        $data = compact('testimonial', 'testimonialItem', 'elements');
        if(view()->exists('admin.testimonial.item.update')) {
            return view('admin.testimonial.item.update', $data);
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

        $testimonialItem = TestimonialItem::find($id);
        $rules = [
            'photo' => 'image',
        ];
        $request->validate($rules);

        $testimonialItem->updateField($request, 'name');
        $testimonialItem->updateField($request, 'position');
        $testimonialItem->updateField($request, 'review');
        $testimonialItem->uploadImage($request->file('photo'), 'img/testimonials', 'photo');
        $testimonialItem->updateFieldStatus($request);
        $testimonialItem->setDate($request->date, 'updated_at');


        if($request->exists('mainElement') && strpos($request->mainElement, (string)$testimonialItem->testimonial->id) === false ) {
            $idKey = explode(': ', $request->mainElement);
            $testimonial = Testimonial::find($idKey[1]);
            $testimonialItem->testimonial()->associate($testimonial);
        }
        $testimonialItem->save();
        return redirect()->route('admin.testimonial.single', ['id' => $singleId]);
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
            $testimonialItem = TestimonialItem::find($id);
            $testimonialItem->delete();
            $testimonialItem->removeImage('img/testimonials', 'photo');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
