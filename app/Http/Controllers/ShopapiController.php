<?php

namespace App\Http\Controllers;

use App\Models\Shopapi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopapiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('shopapis.index');
        return view('shopapis.index', [
            /* 'shopapis' => Shopapi::all() */
            'shopapis' => Shopapi::orderBy('title')->paginate(20)
            /* 'shopapis' => DB::table('shopapis')->orderBy('title')->paginate(20) */
        ]);
        // return Shopapi::all(); // kuvab kõik
        // return Shopapi::paginate(10); // anna lehest 10 tk
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shopapis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->shopapiize('update', $shopapi);
        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'image' => 'required|string|max:255'
            ],
            [
                'title.required' => 'The first name filed is required.',
                'description.required' => 'The last name filed is required.',
                'price.required' => 'The last name filed is required.',
                'quantity.required' => 'The last name filed is required.',
                'image.required' => 'The last name filed is required.'
            ]
        );

        Shopapi::create($validated);

        return view('shopapis.index', [
            'shopapis' => Shopapi::orderBy('title')->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shopapi $shopapi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shopapi $shopapi): View
    {

        return view('shopapis.edit', [
            'shopapi' => $shopapi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shopapi $shopapi): RedirectResponse

    {
        // $this->shopapiize('update', $shopapi);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $shopapi->update($validated);

        return redirect(route('shopapis.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shopapi $shopapi)
    {
        $shopapi->delete();
        return redirect('/shopapis');
    }
}
