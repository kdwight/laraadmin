<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('page_access')->except('welcome');
    }

    public function welcome()
    {
        return view('welcome');
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
        $this->validate(request(), [
            'title' => 'required',
            'slug' => 'required|unique:pages,slug',
            'description' => 'required',
        ]);

        Page::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'description' => request('description'),
            'created_by' => auth()->id()
        ]);

        return redirect('/pages')->with('success', 'Page created');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Page $page)
    {
        $this->validate(request(), [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages')->ignore($page->id)],
            'description' => 'required',
        ]);

        $page->update([
            'title' => request('title'),
            'slug' => request('slug'),
            'description' => request('description'),
            'updated_by' => auth()->user()->id
        ]);

        return redirect('/pages')->with('success', 'Page updated');
    }

    public function destroy(Page $page)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($page->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $tag) {
            $file = $tag->getAttribute('src');
            unlink(public_path($file));
        }

        $page->delete();
        return redirect('/pages')->with('success', 'Page deleted');
    }

    public function status(Page $page)
    {
        $page->update([
            'status' => request()->has('status'),
            'updated_by' => auth()->id()
        ]);
        return back()->with('success', 'Status has been updated');
    }
}
