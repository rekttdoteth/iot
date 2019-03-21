<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Blog::all();
        return view("backend.blog.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $p_title = [];
        $projects = Project::all();
        foreach ($projects as $p) {
            # code...
            $p_title[] = $p->title;
        }
        return view('backend.blog.create', compact('projects','p_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tags = explode(",",$request->get('tags'));
        array_pop($tags);
        $b = Blog::create($request->all());
        $b->tag($tags);
        $b->post_date = $b->created_at;
        if($request->get('publish') == null){
            $b->publish = false;
        } else {
            $b->publish = true;
        }

        if($request->get('event') == null){
            $b->event = false;
        } else {
            $b->event = true;
        }
        $b->save();
        return redirect()->route('backend:blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
        $p_title = [];
        $projects = Project::all();
        foreach ($projects as $p) {
            # code...
            $p_title[] = $p->title;
        }
        $p_tags = [];
        $tags = $blog->tagNames();
        foreach ($tags as $tag) {
            if ($this->in_arrayi($tag, $p_title)){
                $p_tags[] = $tag;
            }
        }
        return view('backend.blog.edit', compact('blog', 'p_title', 'p_tags', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $blog->update($request->all());
         if($request->get('publish') == null){
            $blog->publish = false;
        } else {
            $blog->publish = true;
        }

        if($request->get('event') == null){
            $blog->event = false;
        } else {
            $blog->event = true;
        }
        $blog->save();
        $tags = explode(",",$request->get('tags'));
        array_pop($tags);
        $blog->retag($tags);
        return redirect()->route('backend:blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function in_arrayi($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
}
