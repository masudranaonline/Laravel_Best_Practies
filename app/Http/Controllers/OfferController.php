<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\OfferService;
use App\Http\Requests\StoreOfferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::orderBY('title')->get();
        $categories = Category::orderBY('title')->get();
        return view('offers.create', compact('locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request, OfferService $offerService)
    {
        // return $request;
        $this->authorize('create', Offer::class);

        
        try {
            $offerService->store($request->validated());
            // throw new \Exception('Offer not Created');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
        
        return redirect()->back()->with(['success' => 'Offer Created Successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
