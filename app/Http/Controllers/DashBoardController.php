<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;
use Image;


class DashBoardController extends Controller
{
    public function home()
    {
        $todayOrders = Order::whereDate('created_at', '=', Carbon::today()->toDateString())->get();
        return view('BackEnd.home.dashboard',compact('todayOrders'));
    }

    /*========= for admin profile ============ */

    public function index()
    {

        $users = User::latest()->get();

        return view('BackEnd.access.users.user_list',compact('users'));
    }

    public function create ()
    {
        return view('BackEnd.access.users.new_user');
    }
    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:30',
            'password_confirmation' => 'required|same:password',
//            'role_id' => 'required',
        ]);
        $request['password'] = Hash::make($request->password);
        unset($request['password_confirmation']);

        User::create([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name.'-'.rand('00', '99')),
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'created_by' => auth()->user()->id,
        ]);
        return redirect()->route('user_create')->with('sms','Data Stored!');
    }

    public function edit(User $user)
    {
       //
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|unique:users|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:30',
            'password_confirmation' => 'required|same:password',
//            'role_id' => 'required',
        ]);

        if($request->password === null)
        {
            $request['password'] = $user->password;
        }else
        {
            $request['password'] = Hash::make($request->password);
        }
        unset($request['password_confirmation']);

        $user->update([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name.'-'.rand('00', '99')),
            'email' => $request->email,
            'password' => $request->password,
            // 'role_id' => $request->role_id,
            'updated_by' => auth()->user()->id,
        ]);

        return back()->with('sms','User Updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('sms','User Deleted!');
    }


    /* profile info */

    public function profile($id)
    {
        $user = User::find($id);
        return view('BackEnd.profile.profile_show',compact('user'));
    }

    public function proUpdate(Request $request,$id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profession = $request->profession;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;

        if($request->password === null)
        {
            $request['password'] = $user->password;
        }else
        {
            $request['password'] = Hash::make($request->password);
        }

        $img_tmp = $request->file('avatar');

        if ($img_tmp)
        {
            $img_name = $img_tmp->getClientOriginalName();
            $img_path = public_path('Back/images/admin');
            $img_tmp->move($img_path,$img_name);

            $old_img = 'Back/images/admin/'.$user->avatar;

            try {
                if(file_exists($old_img)){
                    unlink($old_img);
                }
            } catch (\Throwable $th) {  }

            $user->avatar = $img_name;
        }
        $user->password = $request['password'];
        $user->save();
        return redirect('/dashboard')->with('sms','Information Updated');
    }














// about

    public function aboutAddOrEdit()
    {
        $abouts = About::get();
        $about =About::get()->first();

        if(count($abouts) != 0)
        {
            return view('BackEnd.about.about_edit',compact('about'));
        }
        else{
            return view('BackEnd.about.about_add');
        }
    }

    public function storeAbout(Request $request)
    {
        // dd($request->all());
        if($request->hasFile('logo'))
        {
            $img_temp = $request->file('logo');
            $img_ext = $img_temp->getClientOriginalExtension();
            $img_name = rand(111, 99999).'.'.$img_ext;
            $img_path = 'Back/images/about/'.$img_name;
            Image::make($img_temp)->resize(933, 390)->save($img_path);

            About::create([
                'mission' => $request->mission,
                'vission' => $request->vission,
                'our_store' => $request->our_store,
                'image' => $img_name,
            ]);
        }

        return redirect()->route('AddEdit')->with('sms', 'About Stored');
    }

    public function aboutUpdate(Request $request,$id)
    {

        $about = About::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $img_temp = $request->file('logo');
            $img_ext = $img_temp->getClientOriginalExtension();
            $img_name = rand(111, 99999).'.'.$img_ext;
            $img_path = 'Back/images/about/'.$img_name;
            Image::make($img_temp)->resize(933, 390)->save($img_path);

            $old_img = 'Back/images/about/'.$about->image;

            if(file_exists($old_img))
            {
                unlink($old_img);
            }

        }
        else
        {
            $img_name = $about->image;
        }
        $about->update([
            'mission' => $request->mission,
            'vission' => $request->vission,
            'our_store' => $request->our_store,
            'image' => $img_name,
        ]);


        return redirect()->route('AddEdit')->with('sms', 'About Updated');
    }

    // contact

    public function contactAddEdit()
    {
        $contacts = Contact::get();
        $contact = Contact::get()->first();

        if(count($contacts) != 0)
        {
            return view('BackEnd.contact.contact_edit',compact('contact'));
        }
        else{
            return view('BackEnd.contact.contact_add');
        }
    }

    public function storeContact(Request $request)
    {
        // dd($request->all());
        if($request->hasFile('image'))
        {
            $img_temp = $request->file('image');
            $img_ext = $img_temp->getClientOriginalExtension();
            $img_name = rand(111, 99999).'.'.$img_ext;
            $img_path = 'Back/images/contact/'.$img_name;
            Image::make($img_temp)->resize(933, 390)->save($img_path);

            Contact::create([
                'con_form_sms' => $request->con_form_sms,
                'contact_info' => $request->contact_info,
                'map_link' => $request->map_link,
                'image' => $img_name,
            ]);
        }

        return redirect()->route('conAddEdit')->with('sms', 'Contact Stored');
    }

    public function contactUpdate(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        if($request->hasFile('image'))
        {
            $img_temp = $request->file('image');
            $img_ext = $img_temp->getClientOriginalExtension();
            $img_name = rand(111, 99999).'.'.$img_ext;
            $img_path = 'Back/images/contact/'.$img_name;
            Image::make($img_temp)->resize(933, 390)->save($img_path);

            $old_img = 'Back/images/contact/'.$contact->image;

            if(file_exists($old_img))
            {
                unlink($old_img);
            }

        }
        else
        {
            $img_name = $contact->image;
        }
        $contact->update([
            'con_form_sms' => $request->con_form_sms,
            'contact_info' => $request->contact_info,
            'map_link' => $request->map_link,
            'image' => $img_name,
        ]);
        return redirect()->route('conAddEdit')->with('sms', 'Contact Updated');
    }

}

