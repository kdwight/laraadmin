<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function store(PageRequest $request, Page $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->except('password_confirmation'));

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
}
