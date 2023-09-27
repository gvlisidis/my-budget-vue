<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKeywordRequest;
use App\Http\Requests\UpdateKeywordRequest;
use App\Http\Resources\KeywordResource;
use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Category $category)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:40',
        ]);

        $keywordModel = $category->keyword;
        $keywords = $keywordModel->keywords ?? [];

        if(!in_array(Str::lower($validated['keyword']), $keywords)) {
            $keywords[] = Str::lower($validated['keyword']);
        }

        Keyword::updateOrCreate(
            ['category_id' => $category->id],
            ['keywords' => $keywords,]
        );

        return new KeywordResource($category->keyword);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeywordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keyword $keyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeywordRequest $request, Keyword $keyword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        $keywordModel = $category->keyword;
        $keywords = $keywordModel->keywords;

        if(($key = array_search($request->keyword, $keywords)) !== false) {
            unset($keywords[$key]);
        }
        $keywordModel->update([
            'keywords' => $keywords,
        ]);
    }
}
