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
    public function index(Request $request, OfferService $offerService)
    {

        $this->authorize('viewAny', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        $offers= $offerService->get($request->query());
        return view('offers.index', compact('offers', 'categories', 'locations'));
    }


    /**
     * Display a listing of the resource.
     */
    public function myOffers(Request $request, OfferService $offerService)
    {

        $this->authorize('viewMy', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        $offers= $offerService->get($request->query());
        return view('offers.index', compact('offers', 'categories', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Offer::class);
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
        $offerService->store(
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );
        
        return redirect()->back()->with(['success' => 'Offer Created Successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        // $offer->getMedia();

        // return $offer;
        // $offer->load(['author', 'categories', 'locations']);
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $this->authorize('update', $offer);

        $locations = Location::orderBY('title')->get();
        $categories = Category::orderBY('title')->get();

        return view('offers.edit', compact('offer','locations', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOfferRequest $request, Offer $offer, OfferService $offerService)
    {
        // return $request;
        $this->authorize('update', $offer);
        $offerService->update(
            $offer,
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );
        
        return redirect()->back()->with(['success' => 'Offer Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer, OfferService $offerService)
    {
        $offerService->destroy($offer);

        return response('Offer Deleted');
    }
}
