<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Service;

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

}
