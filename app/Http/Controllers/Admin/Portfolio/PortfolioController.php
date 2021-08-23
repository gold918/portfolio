<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Filter;
use App\Model\Site\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        $elements = Filter::pluck('name');
        $currentFilter = Filter::find($singleId)->name;
        if(view()->exists('admin.portfolio.portfolio.create')) {
            return view('admin.portfolio.portfolio.create', [
                                                                    'singleId' => $singleId,
                                                                    'elements' => $elements,
                                                                    'currentFilter' => $currentFilter,
                                                                                                        ]);
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
    public function store(Request $request, Portfolio $portfolio, $singleId)
    {
        $request->validate([
            'name' => 'required',
            'alias' => 'required|regex:/^([a-zA-Z]+-?\d*-?)+$/|unique:portfolio,alias',
            'image' => 'required|image',
            'text' => 'required',
            'elements' => 'required',
        ]);

        if($request->has(['name', 'alias', 'image', 'text'])) {
            $portfolio->name = $request->name;
            $portfolio->alias = $request->alias;
            $portfolio->uploadImage($request->file('image'), 'img/portfolio', 'image');
            $portfolio->text = $request->text;

            if($request->has('status')) {
                $portfolio->status = 1;
            }
            $portfolio->setDate($request->date);
            $portfolio->save();

            if($request->has('elements')) {
                foreach ($request->elements as $element) {
                    $filter = Filter::where('name', $element)->get();
                    $portfolio->filtersAll()->attach($filter);
                }
            }

            return redirect()->route('admin.filter_portfolio.single', ['id' => $singleId]);
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($singleId, $id)
    {
        $portfolio = Portfolio::find($id);
        $filters = $portfolio->filtersAll;
        if(view()->exists('admin.portfolio.portfolio.single')) {
            return view('admin.portfolio.portfolio.single', ['filters' => $filters, 'portfolio' => $portfolio, 'singleId' => $singleId]);
        }
        abort(404);
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
        $filter = Filter::find($singleId);
        $portfolio = Portfolio::find($id);
        $elements = Filter::pluck('name');
        $filterId = $portfolio->filtersAll->pluck('name')->all();
        $data = compact('filter', 'portfolio', 'elements', 'filterId');
        if(view()->exists('admin.portfolio.portfolio.update')) {
            return view('admin.portfolio.portfolio.update', $data);
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
        $portfolio = Portfolio::find($id);
        $rules = [
            'alias' => 'regex:/^([a-zA-Z]+-?\d*-?)+$/',
            'image' => 'image',
            'elements' => 'required',
        ];
        if(isset($portfolio->alias) && $request->exists('alias') && $request->alias !== $portfolio->alias) {
            $rules['alias'] = 'regex:/^([a-zA-Z]+-?\d*-?)+$/|unique:portfolio,alias';
        }
        $request->validate($rules);

        $portfolio->updateField($request, 'name');
        $portfolio->updateField($request, 'alias');
        $portfolio->updateField($request, 'text');
        $portfolio->uploadImage($request->file('image'), 'img/portfolio', 'image');
        $portfolio->updateFieldStatus($request);
        $portfolio->setDate($request->date, 'updated_at');
        $portfolio->save();
        if(isset($request->elements) && is_array($request->elements)) {
            $filterId = [];
            foreach ($request->elements as $element) {
                $filterId[] = Filter::where('name', $element)->first()->id;
            }

            $filterDiff = array_diff($portfolio->filtersAll->pluck('id')->all(), $filterId);
            if(isset($filterDiff)) {
                $portfolio->filtersAll()->detach();
                $portfolio->filtersAll()->attach($filterId);
            }
        }
        return redirect()->route('admin.filter_portfolio.single', ['id' => $singleId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $singleId, $id)
    {
        try{

            $portfolio = Portfolio::find($id);
            $portfolio->filtersAll()->detach();
            $portfolio->delete();
            $portfolio->removeImage('img/portfolio', 'image');
            if (isset($request->redirect)) {
                return response($request->redirect);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
