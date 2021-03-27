<?php

namespace App\Http\Controllers;

use App\Models\Poor;
use Illuminate\Http\Request;

class PoorsController extends Controller
{
    public const POOR_PAGINATION_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $offset = $page ? (($page * self::POOR_PAGINATION_LIMIT) - self::POOR_PAGINATION_LIMIT) : 0;

        $poors = Poor::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $poors = $poors
                     ->where('first_name', 'like', '%' . $request->input('search') . '%')
                     ->orWhere('last_name', 'like', '%' . $request->input('search') . '%')
                     ->orWhere('address', 'like', '%' . $request->input('search') . '%')
                     ->orWhere('marital_status', 'like', '%' . $request->input('search') . '%')
                     ->orWhere('education_status', 'like', '%' . $request->input('search') . '%');
        }

        $count = $poors->count();
        $poors = $poors->skip($offset)->take(self::POOR_PAGINATION_LIMIT)->get();

        return view('poors.index', compact('poors', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poor = Poor::create($request->all());
        if ($request->input('has_problem_solved') === null) {
            $poor->has_problem_solved = 0;
            $poor->save();
        }
        session()->flash('success', 'نیازمند با موفقیت ثبت شد.');
        return redirect()->route('poors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poor = Poor::findOrFail($id);
        return view('poors.edit', [ 'poor' => $poor ]);
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
        $poor = Poor::findOrFail($id);
        $poor->update($request->all());
        if ($request->input('has_problem_solved') === null) {
            $poor->has_problem_solved = 0;
            $poor->save();
        }
        session()->flash('success', 'اطلاعات با موفقیت ویرایش گردید.');
        return view('poors.edit', [ 'poor' => $poor ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
