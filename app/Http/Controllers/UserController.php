<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\leaving_request;
use App\Models\question;
use App\Models\register_request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        // add new register request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:register_requests',
        ]);

        $reg_request = new register_request();
        $reg_request->name = $request->name;
        $reg_request->department = $request->department;
        $reg_request->email = $request->email;
        $reg_request->role = 'Member';
        $reg_request->password = $request->password;
        $reg_request->img = '';
        $reg_request->save();
        return back()->with('success', 'Request sent successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // get the user from the database
        $email = User::where('email', $request->email)->first();
        $password = User::where('password', $request->password)->first();
        // get the all departments for all users

        // check if the user exists
        if ($email && $password) {
            // check if the user is an admin
            if ($email->role == 'admin') {
                // login the user
                Auth::login($email);
                // get number of users
                $users = User::where('role', '!=', 'admin')->get();
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

                // get number of leaving requests
                $leaving_requests = leaving_request::all();
                // sort the requests by the latest
                $leaving_requests = $leaving_requests->sortByDesc('created_at');


                // dd($users);
                return redirect()->route('admin.dashboard', compact('users', 'availableUsers', 'leaving_requests'));
            } else if ($email->role == 'Head') {
                // login the user
                Auth::login($email);

                // store attendence for the head for today if not exists
                $day = date('Y-m-d');
                $current_att = attendance::where('user_id', $email->id)->where('day', $day)->first();
                if (!$current_att) {
                    $current_att = new attendance();
                    $current_att->user_id = $email->id;
                    $current_att->day = $day;
                    $current_att->arrival_time = date('H:i:s');
                    $current_att->save();
                }

                return redirect()->route('head.dashboard');
            } else {
                // login the user
                Auth::login($email);

                // store attendence for the head for today if not exists
                $day = date('Y-m-d');
                $current_att = attendance::where('user_id', $email->id)->where('day', $day)->first();
                if (!$current_att) {
                    $current_att = new attendance();
                    $current_att->user_id = $email->id;
                    $current_att->day = $day;
                    $current_att->arrival_time = date('H:i:s');
                    $current_att->save();
                }

                return redirect()->route('user.dashboard');
            }
        } else {
            // Authentication failed
            $selected = User::where('email', $request->email); // Throws an exception if the user doesn't exist
            if ($selected->exists() && $selected->first()->password != $request->password) {
                return back()->withErrors(['password' => 'Invalid credentials'])->withInput();
            } else {
                return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
            }
        }
    }
    public function get_deps()
    {
        $deps = User::select('department')->get();
        $departments = [];
        // consider distinct departments
        foreach ($deps as $dep) {
            if (!in_array($dep->department, $departments) && $dep->department != 'admin') {
                $departments[] = $dep->department;
            }
        }
        return $departments;
    }

    public function dashboard()
    {
        $departments = $this->get_deps();
        $users = User::where('role', '!=', 'admin')->get();
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

        // get number of leaving requests
        $leaving_requests = leaving_request::all();
        // sort the requests by the latest
        $leaving_requests = $leaving_requests->sortByDesc('created_at');

        return view('admin.dashboard', compact('departments', 'users', 'availableUsers', 'leaving_requests'));
    }

    public function getDepartment($name)
    {
        $users = User::where('department', $name)->get();
        $departments = $this->get_deps();

        return view('admin.department', compact('users',  'departments', 'name'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        // get all leaving requests for this user and delete them
        $leaving_requests = leaving_request::where('user_id', $id)->get();
        foreach ($leaving_requests as $request) {
            $request->delete();
        }
        // get attendance for this user and delete them
        $attendances = attendance::where('user_id', $id)->get();
        foreach ($attendances as $att) {
            $att->delete();
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User();
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
        return back()->with('success', 'User added successfully');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $departments = $this->get_deps();
        return view('admin.edit', compact('user', 'departments'));
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
        $departments = $this->get_deps();

        $leaving_requests = leaving_request::where('user_id', $id)->get();

        return view('admin.profile', compact('user', 'departments', 'leaving_requests'));
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
        $users = User::where('role', '!=', 'admin')->get();
        $departments = $this->get_deps();
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

        return view('admin.available', compact('availableUsers', 'departments'));
    }

    public function usersAttendence()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $departments = $this->get_deps();
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
                if ($att->arrival_time != null  && $att->leave_time != null  && $att->q1 === "true" && $att->q2 === "true") {
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
        return view('admin.attendance', compact('users_att', 'departments'));
    }

    public function usersLeaving()
    {

        $leaving_requests = leaving_request::all();
        // get users for this requests
        foreach ($leaving_requests as $request) {
            $user = User::find($request->user_id);
            $request->user = $user;
        }
        $departments = $this->get_deps();
        return view('admin.leaving', compact('leaving_requests', 'departments'));
    }

    public function usersRegister()
    {
        $departments = $this->get_deps();
        // get all register requests
        $register_requests = register_request::all();
        return view('admin.register', compact('register_requests', 'departments'));
    }

    public function approveREGRequest($id)
    {
        $request = register_request::find($id);
        $request->status = 'Approved';

        // create new user
        $user = new User();
        $user->name = $request->name;
        $user->department = $request->department;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->image = $request->img;

        $request->save();
        $user->save();

        return back()->with('success', 'Request approved successfully');
    }

    public function rejectREGRequest($id)
    {
        $request = register_request::find($id);
        $request->status = 'Rejected';
        $request->save();
        return back()->with('success', 'Request rejected successfully');
    }

    public function userDashboard()
    {

        // check if there is a leaving request for this user in the current day
        $user_id = Auth::user()->id;
        $day = date('Y-m-d');
        $current_att = attendance::where('user_id', $user_id)->where('day', $day)->first();
        $leaving_request = leaving_request::where('user_id', $user_id)->where('day', $day)->first();
        $leaving_request_status = '';
        if ($leaving_request) {
            $leaving_request_status = $leaving_request->status;
        }

        return view('user.dashboard', compact('leaving_request_status'));
    }

    public function userProfile()
    {
        $user = Auth::user();

        // check if there is a leaving request for this user in the current day
        $user_id = Auth::user()->id;
        $day = date('Y-m-d');
        $current_att = attendance::where('user_id', $user_id)->where('day', $day)->first();
        $leaving_request = leaving_request::where('user_id', $user_id)->where('day', $day)->first();
        $leaving_request_status = '';
        if ($leaving_request) {
            $leaving_request_status = $leaving_request->status;
        }

        return view('user.profile', compact('user', 'leaving_request_status'));
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // get the user
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
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
        return redirect()->route('user.profile')->with('success', 'User updated successfully');
    }

    public function checkAnswer(request $request)
    {
        $user_id = Auth::user()->id;
        $day = date('Y-m-d');
        $current_att = attendance::where('user_id', $user_id)->where('day', $day)->first();

        $Qid = $request->Qid;
        $answer = $request->answer;

        // get question from questions table
        $question = question::find($Qid);
        $correct_answer = $question->answer;

        if ($answer == $correct_answer) {
            if ($current_att->q1 == null) {
                $current_att->q1 = "true";
            } else if ($current_att->q2 == null) {
                $current_att->q2 = "true";
            }
        } else {
            if ($current_att->q1 == null) {
                $current_att->q1 = "false";
            } else if ($current_att->q2 == null) {
                $current_att->q2 = "false";
            }
        }

        $current_att->save();
        return redirect()->route('user.dashboard');
    }

    public function leave()
    {
        $user_id = Auth::user()->id;
        $day = date('Y-m-d');
        $current_att = attendance::where('user_id', $user_id)->where('day', $day)->first();
        $current_att->leave_time = date('H:i:s');
        $current_att->save();

        // logout
        Auth::logout();
        return redirect()->route('home');
    }

    public function requestLeave(request $request)
    {
        // make new leave request
        // request time, get current time
        $request_time = date('H:i:s');
        // get current day
        $day = date('Y-m-d');
        $user_id = Auth::user()->id;
        $department = Auth::user()->department;
        $request_leave = new leaving_request();
        $request_leave->user_id = $user_id;
        $request_leave->department = $department;
        $request_leave->day = $day;
        $request_leave->request_time = $request_time;
        $request_leave->reason = $request->reason;
        $request_leave->status = 'pending';
        $request_leave->save();
        return redirect()->back()->with('success', 'Request sent successfully');
    }
}
