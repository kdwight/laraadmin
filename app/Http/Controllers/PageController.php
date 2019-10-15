<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Http\Resources\PagesResource;
use App\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function store(PageRequest $request)
    {
        $pageBanner = Str::slug($request->title) . '.' . request()->file('banner')->getClientOriginalExtension();
        request()->file('banner')->storeAs('pages/', $pageBanner);

        \Image::make(public_path("/storage/pages/$pageBanner"))
            ->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save();

        $seo = [
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
        ];

        Page::create(
            [
                'title' => $request->title,
                'details' => $request->details,
                'seo' => $seo,
                'banner' => $pageBanner
            ]
        );

        return response(['success' => 'Page successfully created.'], 200);
    }

    public function edit(Page $page)
    {
        if (request()->wantsJson()) {
            return response($page);
        }

        return view('admin.pages.index');
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password', 'password_confirmation'])
        );

        return response(['success' => 'Page successfully updated.'], 200);
    }

    public function destroy(Page $page)
    {
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
}
