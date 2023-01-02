<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(10);

        if ($news->total() === 0) {
            return view('news.nocontent');
        }

        $view_data['news'] = $news;
        return view('news.index')->with($view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);;

        $newImage = null;
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $newImage = "$profileImage";
        }

        $data = [
            'slug' => str()->slug($request->title),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $newImage,
        ];
        News::create($data);

        return redirect()->route('news.index')
            ->with('success', 'Notícia cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $newImage = null;
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $newImage = "$profileImage";
        }

        $data = [
            'slug' => str()->slug($request->title),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $newImage,
        ];

        $news->update($data);

        return redirect()->route('news.index')
            ->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->image && file_exists('images/' . $news->image)) {
            unlink('images/' . $news->image);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Notícia deletada com sucesso!');
    }
}
