<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Service;
use App\Models\Servize;
use Illuminate\Http\Request;

class ServiziController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $services = collect(Service::with('media')->get());
        $mapped = $services->map(function($item) {
            $url = $item->getFirstMediaUrl('servicePic', 'thumbimg');
            return [
                'title' => $item->title,
                'short_description' => $item->short_description,
                'area' => $item->area,
                'description' => $item->description,
                'media' => $url,
            ];
        });
        return Inertia::render('Welcome', [
            'articles' => Article::all(),
            'servizes' => $mapped
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Servize $servize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servize $servize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servize $servize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servize $servize)
    {
        //
    }
}
