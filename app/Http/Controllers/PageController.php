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
        $pages = Page::all();
        /*  $response = [
            'pagination' => [
                'total' => $pages->total(),
                'per_page' => $pages->perPage(),
                'current_page' => $pages->currentPage(),
                'last_page' => $pages->lastPage(),
                'from' => $pages->firstItem(),
                'to' => $pages->lastItem()
            ],
            'pages' => $pages
        ]; */
        if (request()->ajax()) {
            return response($pages);
        }
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store()
    {
        $attr = $this->validate(request(), [
            'title' => 'required',
            'slug' => 'required|unique:pages,slug',
            'description' => 'required',
        ]);
        Page::create($attr);
        return response()->json('Page created', 200);
        // return redirect('/pages')->with('success', 'Page created');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Page $page)
    {
        $attr = $this->validate(request(), [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages')->ignore($page->id)],
            'description' => 'required',
        ]);
        $page->update($attr);
        return response()->json('Page updated', 200);
        // return redirect('/pages')->with('success', 'Page updated');
    }

    public function destroy(Page $page)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($page->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $tag) {
            $file = $tag->getAttribute('src');
            @unlink(public_path($file));
        }
        $page->delete();
        if (request()->expectsJson()) {
            return response()->json('Page deleted', 200);
        }
        return redirect('/pages')->with('success', 'Page deleted');
    }

    public function status(Page $page)
    {
        $page->update([
            'status' => request('status')
        ]);
        if (request()->expectsJson()) {
            return response()->json('status updated', 200);
        }
        return back()->with('success', 'Status has been updated');
    }
}
