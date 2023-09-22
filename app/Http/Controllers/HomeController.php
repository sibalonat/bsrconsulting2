<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use Inertia\Inertia;
use PHPHtmlParser\Dom;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
    * basic check if you can visi the page.
    */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://ambtirana.esteri.it/ambasciata_tirana/sq/ambasciata/news/dall_ambasciata');

        $dom = new Dom;

        $dom->loadStr($response->body());

        $titlelinkcollection = $dom->find('.desc_lista');

        $titleandlink = collect($titlelinkcollection);

        $extracted = $titleandlink->map(function ($item) {
            $title = $item->firstChild()->getTag()->getAttribute('title')->getValue();
            $href = $item->firstChild()->getTag()->getAttribute('href')->getValue();
            $data = $item->getParent()->firstChild()->firstChild()->text;
            return [
                'title' => $title,
                'href' => 'https://ambtirana.esteri.it'.$href,
                'data' => $data
            ];
        });

        $titles = $extracted->map(function ($item) {
            return $item['title'];
        });

        $articles = Article::whereIn('title', $titles)->get();

        foreach ($titles as $key => $title) {
            if (!in_array($title, $articles->pluck('title')->toArray())) {
                Article::create([
                    'title' => $extracted[$key]['title'],
                    'url' => $extracted[$key]['href'],
                    'data' => $extracted[$key]['data'],
                ]);
            }
        }

        return Inertia::render('Dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function services()
    {
        $services = collect(Service::with('media')->get());
        $mapped = $services->map(function($item) {
            $url = $item->getFirstMediaUrl('servicePic', 'thumbimg');
            return [
                'title' => $item->title,
                'short_description' => $item->short_description,
                'description' => $item->description,
                'media' => $url,
            ];
        });

        // dd($mapped);

        return inertia('Services/ServiceIndex', [
            // 'services' => Service::all()
            'services' => $mapped
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $service = Service::create([
            'title' => $request->title,
            'area' => $request->area,
            'description' => $request->description,
            'short_description' => $request->short_description,
        ]);

        $file = $request->fileUpload[0]['file'];

        $service->addMedia($file)->toMediaCollection('servicePic');
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
    public function home()
    {
        $services = collect(Service::with('media')->get());
        $mapped = $services->map(function($item) {
            $url = $item->getFirstMediaUrl('servicePic', 'thumbimg');
            return [
                'title' => $item->title,
                'short_description' => $item->short_description,
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
