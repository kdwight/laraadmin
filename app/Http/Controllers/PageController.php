<?php

namespace App\Http\Controllers;

use App\Http\Resources\PagesResource;
use App\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function store()
    {
        $attr = request()->validate([
            'banner' => 'required|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|string|max:65',
            'details' => 'required|string',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string'
        ]);
        unset($attr['meta_description'], $attr['meta_keywords']);

        $pageBanner = $this->imageUpload();

        $seo = [
            'meta_description' => request('meta_description'),
            'meta_keywords' => request('meta_keywords')
        ];

        Page::create(array_merge($attr, [
            'seo' => $seo,
            'banner' => $pageBanner
        ]));

        return response(['success' => 'Page successfully created.'], 200);
    }

    public function edit(Page $page)
    {
        if (request()->wantsJson()) {
            return response($page);
        }

        return view('admin.pages.index');
    }

    public function update(Page $page)
    {
        $attr = request()->validate([
            'banner' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|string|max:65',
            'details' => 'required|string',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string'
        ]);
        unset($attr['meta_description'], $attr['meta_keywords']);

        $seo = [
            'meta_description' => request('meta_description'),
            'meta_keywords' => request('meta_keywords')
        ];

        $oldPage = $page->replicate();

        $page->update(array_merge($attr, [
            'seo' => $seo
        ]));

        if (request()->has('banner')) {
            // change folder name if new title
            if ($oldPage->title != $page->title) {
                Storage::delete("pages/$oldPage->banner");
            }

            $pageBanner = $this->imageUpload();

            $page->update([
                'banner' => $pageBanner
            ]);
        }

        return response(['success' => 'Page successfully updated.'], 200);
    }

    public function destroy(Page $page)
    {
        Storage::delete("pages/$page->banner");
        $page->delete();

        return response(['success' => 'Page successfully deleted.'], 200);
    }

    public function status(Page $page)
    {
        $page->update([
            'status' => request('status')
        ]);

        return response(['success' => 'Status has been updated'], 200);
    }

    public function pagesList()
    {
        $query = Page::orderBy(request('column'), request('order'))
            ->where('title', 'like', '%' . request('filter') . '%'); //you can chain these with searchable columns

        return PagesResource::collection($query->paginate(request('per_page')));
    }

    public function imageUpload()
    {
        $pageBanner = Str::slug(request('title')) . '.' . request()->file('banner')->getClientOriginalExtension();
        request()->file('banner')->storeAs('pages/', $pageBanner);

        \Image::make(public_path("/storage/pages/$pageBanner"))
            ->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save();

        return $pageBanner;
    }
}
