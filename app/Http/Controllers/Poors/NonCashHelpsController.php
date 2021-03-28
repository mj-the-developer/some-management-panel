<?php

namespace App\Http\Controllers\Poors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NonCashHelp;
use App\Models\Poor;

class NonCashHelpsController extends Controller
{
    public const NON_CASH_HELP_PAGINATION_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $poor_id)
    {
        $page = $request->input('page');
        $offset = $page ? (($page * self::NON_CASH_HELP_PAGINATION_LIMIT) - self::NON_CASH_HELP_PAGINATION_LIMIT) : 0;

        $poor = Poor::findOrFail($poor_id);
        $noncashhelps = NonCashHelp::where('poor_id', $poor_id)->orderBy('created_at', 'desc');
        $count = $noncashhelps->count();
        $noncashhelps = $noncashhelps->skip($offset)->take(self::NON_CASH_HELP_PAGINATION_LIMIT)->get();
        return view('poors.non_cash_helps.index', compact('poor', 'noncashhelps', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($poor_id)
    {
        $poor = Poor::findOrFail($poor_id);
        return view('poors.non_cash_helps.create', compact('poor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $poor_id)
    {
        $noncashhelp = new NonCashHelp();
        $noncashhelp->details = $request->input('details');
        $noncashhelp->poor_id = $poor_id;
        $noncashhelp->save();

        session()->flash('success', 'کمک غیر نقدی با موفقیت ثبت شد.');
        return redirect()->route('nch.index', ['poor_id' => $poor_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($poor_id, $id)
    {
        $noncashhelp = NonCashHelp::findOrFail($id);
        return view('poors.non_cash_helps.edit', compact('noncashhelp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $poor_id, $id)
    {
        $noncashhelp = NonCashHelp::findOrFail($id);
        $noncashhelp->details = $request->input('details');
        $noncashhelp->save();

        session()->flash('success', 'کمک غیر نقدی با موفقیت ویرایش شد.');
        return view('poors.non_cash_helps.edit', compact('poor_id', 'noncashhelp'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($poor_id, $id)
    {
        NonCashHelp::destroy($id);
        session()->flash('success', 'کمک غیر نقدی با موفقیت حذف شد.');
        return redirect()->route('nch.index', ['poor_id' => $poor_id]);
    }
}
