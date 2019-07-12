<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('pages_access')->except('pages');
    }

    public function pages()
    {
        return view('pages');
    }

    //admin side
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store()
    {
        $attr = request()->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string'
        ]);

        Page::create($attr);

        return redirect('/admin/pages')->with([
            'success' => "Page created",
            'status' => 'success'
        ]);
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Page $page)
    {
        $attr = request()->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string'
        ]);

        $page->update($attr);

        return redirect('/admin/pages')->with([
            'success' => "Page updated!",
            'status' => 'info'
        ]);
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect('/admin/pages')->with([
            'success' => "Page deleted!",
            'status' => 'warning'
        ]);
    }

    public function status(Page $page)
    {
        $page->update([
            'status' => request()->has('status')
        ]);

        return back()->with([
            'success' => "Status has been updated",
            'status' => 'info'
        ]);
    }
}
