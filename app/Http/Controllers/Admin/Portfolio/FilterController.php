<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Filter;
use App\Model\Site\Portfolio;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::get();

        if(view()->exists('admin.portfolio.filter.index')) {
            return view('admin.portfolio.filter.index', ['filters' => $filters]);
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
        $elements = Portfolio::pluck('name', 'id');

        if(view()->exists('admin.portfolio.filter.create')) {
            return view('admin.portfolio.filter.create', compact('elements'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Filter $filter)
    {
        $request->validate([
            'name' => 'required|unique:filters,name',
            'alias' => 'required|regex:/^([a-zA-Z]+-?)+$/|unique:filters,alias',
        ]);

        if($request->has(['name', 'alias'])) {
            $filter->name = $request->name;
            $filter->alias = $request->alias;

            if($request->has('status')) {
                $filter->status = 1;
            }
            $filter->setDate($request->date);
            $filter->save();

            if($request->has('elements')) {
                foreach ($request->elements as $element) {
                    $portfolio = Portfolio::find((int)$element);
                    $filter->portfolioAll()->attach($portfolio);
                }
            }

            return redirect()->route('admin.filter_portfolio');
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
        $filter = Filter::find($id);
        $portfolio = $filter->portfolioAll;
        if(view()->exists('admin.portfolio.portfolio.index')) {
            return view('admin.portfolio.portfolio.index', ['filter' => $filter, 'portfolio' => $portfolio]);
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
        $filter = Filter::find($id);
        $portfolioId = $filter->portfolioAll->pluck('id')->all();
        $elements = Portfolio::pluck('name', 'id');
        if(view()->exists('admin.portfolio.filter.update')) {
            return view('admin.portfolio.filter.update', compact('filter', 'elements', 'portfolioId'));
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
        $filter = Filter::find($id);
        $rules = [
            'alias' => 'regex:/^([a-zA-Z]+-?)+$/',
        ];
        if(isset($filter->name) && $request->exists('name') && $request->name !== $filter->name) {
            $rules['name'] = 'unique:filters,name';
        }
        if(isset($filter->alias) && $request->exists('alias') && $request->alias !== $filter->alias) {
            $rules['alias'] = 'regex:/^([a-zA-Z]+-?)+$/|unique:filters,alias';
        }
        $request->validate($rules);

        $filter->updateField($request, 'name');
        $filter->updateField($request, 'alias');
        $filter->updateFieldStatus($request);
        $filter->setDate($request->date, 'updated_at');
        $filter->save();
        $portfolioId = [];
        if(isset($request->elements) && is_array($request->elements)) {
            foreach ($request->elements as $element) {
                $portfolioId[] = (int)$element;
            }
        }
        $portfolioDiff = array_diff($filter->portfolioAll->pluck('id')->all(), $portfolioId);
        if(isset($portfolioDiff)) {
            $portfolio = $filter->portfolioAll;
            foreach($portfolio as $item) {
                if(count($item->filtersAll) === 1) {
                    $item->filtersAll()->detach($filter);
                    $item->delete();
                    $item->removeImage('img/portfolio', 'image');
                }
            }
            $filter->portfolioAll()->detach();
            if(isset($portfolioId)) {
                $filter->portfolioAll()->attach($portfolioId);
            }
        }
        return redirect()->route('admin.filter_portfolio');
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

            $filter = Filter::find($id);
            $portfolio = $filter->portfolioAll;
            foreach ($portfolio as $item) {
                if(count($item->filtersAll) >= 2) {
                    $item->filtersAll()->detach($filter);
                };
                if(count($item->filtersAll) === 1) {
                    $item->filtersAll()->detach($filter);
                    $item->delete();
                    $item->removeImage('img/portfolio', 'image');
                };
            }
            $filter->delete();
            if (isset($request->redirect)) {
                return response(route('admin.filter_portfolio'));
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
