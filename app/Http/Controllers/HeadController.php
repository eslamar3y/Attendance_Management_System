<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\leaving_request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeadController extends Controller
{

    public function dashboard()
    {
        $department = Auth()->user()->department;
        $users = User::where('role', 'Member')->where('department', $department)->get();
        $users = $users->sortByDesc('created_at');


        // get number of available users
        $availableUsers = array();
        // $availableattences = array();
        foreach ($users as $user) {

            // get current day
            $day = date('Y-m-d');
            // dd($day);

            // get attendance for the current day
            $current_att = attendance::where('user_id', $user->id)->where('day', $day)->first();

            // dd($current_att);


            if ($current_att) {
                if ($current_att->leave_time == null && $current_att->arrival_time != null) {
                    if ($current_att->q1 === null && $current_att->q2 === null) {
                        $availableUsers[] = $user;
                    } else if ($current_att->q1 == "true" && $current_att->q2 === null) {
                        $availableUsers[] = $user;
                    } else if ($current_att->q1 == "true" && $current_att->q2 == "true") {
                        $availableUsers[] = $user;
                    }
                }
            }
        }

        // get number of leaving requests for the users that in the current department
        $leaving_request = leaving_request::where('department', $department);
        $leaving_requests_count = $leaving_request->count();

        return view('head.dashboard', compact('leaving_requests_count', 'department', 'users', 'availableUsers'));
    }

    public function getDepartment($name)
    {
        $department = $name;
        $users = User::where('department', $name)->get();

        return view('head.department', compact('users',  'department', 'name'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $department = Auth()->user()->department;
        return view('head.edit', compact('user', 'department'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->department = $request->department;
        $user->email = $request->email;


        $old_head = User::where('department', $request->department)->where('role', 'head')->first();
        if ($request->role == 'Head' && $old_head  && $old_head->id !== $user->id) {
            // update the old head to be a normal user
            $old_head->role = 'Member';
            $old_head->save();
        }
        $user->role = $request->role;

        $user->password = $request->password;
        // get image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/images/', $filename);
            $user->image = $filename;
        } else {
            $img = $user->image;
            $user->image = $img;
        }
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $department = Auth()->user()->department;

        $leaving_requests = leaving_request::where('user_id', $id)->get();

        return view('head.profile', compact('user', 'department', 'leaving_requests'));
    }

    public function approveRequest($id)
    {
        $request = leaving_request::find($id);
        $request->status = 'Approved';
        $user_id = $request->user_id;
        $request->save();

        // update attendance
        // get the attendance for the current day for that user
        $day = date('Y-m-d');
        $current_att = attendance::where('user_id', $user_id)->where('day', $day)->first();
        // dd($current_att);
        if ($current_att) {
            $current_att->leave_time = $request->request_time;
            if ($current_att->q1 == null) {
                $current_att->q1 = "true";
            }
            if ($current_att->q2 == null) {
                $current_att->q2 = "true";
            }
            $current_att->save();
        }

        return back()->with('success', 'Request approved successfully');
    }

    public function rejectRequest($id)
    {
        $request = leaving_request::find($id);
        $request->status = 'Rejected';
        $request->save();
        return back()->with('success', 'Request rejected successfully');
    }

    public function availableUsers()
    {
        $department = Auth()->user()->department;
        $users = User::where('role', '!=', 'admin')->where('department', $department)->get();
        $availableUsers = array();
        // $availableattences = array();
        foreach ($users as $user) {

            // get current day
            $day = date('Y-m-d');
            // dd($day);

            // get attendance for the current day
            $current_att = attendance::where('user_id', $user->id)->where('day', $day)->first();

            // dd($current_att);


            if ($current_att) {
                if ($current_att->leave_time == null && $current_att->arrival_time != null) {
                    if ($current_att->q1 === null && $current_att->q2 === null) {
                        $availableUsers[] = $user;
                    } else if ($current_att->q1 == "true" && $current_att->q2 === null) {
                        $availableUsers[] = $user;
                    } else if ($current_att->q1 == "true" && $current_att->q2 == "true") {
                        $availableUsers[] = $user;
                    }
                }
            }
        }
        // dd($availableUsers);

        return view('head.available', compact('availableUsers', 'department'));
    }

    public function usersAttendence()
    {
        $department = Auth()->user()->department;
        $users = User::where('role', '!=', 'admin')->where('department', $department)->get();
        $users_att = array();
        foreach ($users as $user) {
            $user_att = array();
            $user_att['user'] = $user;
            $user_att['attendence'] = attendance::where('user_id', $user->id)->get();
            // calculate the the attendence days and the absent days
            $attendence_days = 0;
            $work_days = 0;
            $absent_days = 0;
            $absent_hours = 0;
            foreach ($user_att['attendence'] as $att) {
                if ($att->arrival_time != null && $att->leave_time != null && $att->q1 === "true" && $att->q2 === "true") {
                    $attendence_days++;
                }

                // check leaving time if it's less than 5pm then calculate the absent hours
                if ($att->leave_time != null) {
                    $leave_time = strtotime($att->leave_time);

                    // '17:00:00' as a Unix timestamp
                    $end_of_day = strtotime('17:00:00');

                    // Only calculate if the leave time is before 5pm
                    if ($leave_time < $end_of_day) {
                        $absent_seconds = $end_of_day - $leave_time;
                        $absent_hours += $absent_seconds / 3600;  // Convert seconds to hours
                    }
                }
            }

            // calculate the absent days that the day is not friday and in the current month
            $current_month = date('m');
            $current_year = date('Y');
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
            for ($i = 1; $i <= $days_in_month; $i++) {
                $date = $current_year . '-' . $current_month . '-' . $i;
                $day = date('l', strtotime($date));
                if ($day != 'Friday') {
                    $att = attendance::where('user_id', $user->id)->where('day', $date)->first();
                    if (!$att) {
                        $work_days++;
                    }
                }
            }
            $absent_days = $work_days - $attendence_days;

            $user_att['attendence_days'] = $attendence_days;
            $user_att['absent_days'] = $absent_days;
            $user_att['absent_hours'] = $absent_hours;
            $users_att[] = $user_att;
            // dd($users_att);
        }
        // dd($users_att);
        return view('head.attendance', compact('users_att', 'department'));
    }

    public function usersLeaving()
    {
        $leaving_requests = leaving_request::where('department', Auth()->user()->department)->get();
        $current_id = Auth()->user()->id;
        // get users for this requests
        foreach ($leaving_requests as $request) {
            $user = User::find($request->user_id);
            $request->user = $user;
        }
        $department = Auth()->user()->department;
        return view('head.leaving', compact('leaving_requests', 'department', 'current_id'));
    }
}
