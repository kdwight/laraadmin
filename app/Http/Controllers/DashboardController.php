<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function activityLists()
    {
        $columns = array(
            0 => 'description'
        );

        $totalData = Activity::count();
        $totalFiltered = $totalData;
        $limit = request('length');
        $start = request('start');
        $order = $columns[request('order.0.column')];
        $dir = request('order.0.dir');

        if (empty(request('search.value'))) {
            $activities = Activity::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = request('search.value');

            $activities =  Activity::where('description', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Activity::where('description', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($activities)) {
            foreach ($activities as $key => $activity) {
                $userName = User::find($activity->causer_id)->username;

                $nestedData['description'] = "$userName $activity->description ";
                $nestedData['created_at'] = $activity->created_at->diffForHumans();

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval(request('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }
}
