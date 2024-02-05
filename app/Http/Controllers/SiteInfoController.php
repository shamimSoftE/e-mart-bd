<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Image;

class SiteInfoController extends Controller
{
    public function index()
    {
        $siteInfo = SiteInfo::all();
        $site = SiteInfo::get()->first();

        if(count($siteInfo) != 0)
        {
            return view('BackEnd.siteInfo.side-info-edit',compact('site'));
        }
        else
        {
            return view('BackEnd.siteInfo.side-info-add');
        }
    }

    protected function Img($request)
    {
        if($request->hasFile('logo')){

            $img_tmp = $request->file('logo');

            if ($img_tmp->isValid()){
               $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = rand(111, 99999).'.'.$img_exten;
                $img_path = public_path('Back/images/logo');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    protected function UrlLogo($request)
    {
        if($request->hasFile('app_logo')){

            $img_tmp = $request->file('app_logo');

            if ($img_tmp->isValid()){
                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = rand(111, 99999).'.'.$img_exten;
                $img_path = public_path('Back/images/logo/appLogo/');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'site_name' => 'required',
        //     'address' => 'required',
        //     'facebook' => 'required',
        //     'contact_number' => 'required',
        //     'email' => 'required',
        //     'logo' => 'required',
        //     'url_logo' => 'required',
        // ]);

        $logo = $this->Img($request);
        $url_logo = $this->UrlLogo($request);
        // dd($request->all());
        SiteInfo::create([
            'site_name' => $request->site_name,
            'address' => $request->address,
            'site_about' => $request->site_about,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'instagram_link' => $request->instagram_link,
            'youtube_link' => $request->youtube_link,
            'e_cad_id' => $request->e_cad_id,
            'tin' => $request->tin,
            'trade_licence_no' => $request->trade_licence_no,
            'developed_by' => $request->developed_by,
            'app_link' => $request->app_link,
            'logo' => $logo,
            'app_logo' => $url_logo,
        ]);

        return back()->with('sms','Information Created');
    }

    public function update(Request $request,SiteInfo $site)
    {
        // dd($request->all());

        if($request->hasFile('logo'))
        {
            $img_tmp = $request->file('logo');
            $img_name = md5(time() . rand()) . '.' . $img_tmp->getClientOriginalExtension();
            $img_url = public_path('Back/images/logo/');
            $img_tmp->move($img_url, $img_name);

            // Image::make($img_tmp)->resize(933, 390)->save($img_url);

            $old_img = 'Back/images/logo/'.$site->logo;

            if(file_exists($old_img))
            {
                unlink($old_img);
            }
        }
        else
        {
            $img_name = $site->logo;
        }

        if($request->hasFile('app_logo'))
        {
            $img_tmp = $request->file('app_logo');
            $img_name2 = md5(time() . rand()) . '.' . $img_tmp->getClientOriginalExtension();
            $img_url = public_path('Back/images/logo/appLogo/');
            $img_tmp->move($img_url, $img_name2);

            $old_imgN = 'Back/images/logo/appLogo/'.$site->app_logo;

            if(file_exists($old_imgN))
            {
                unlink($old_imgN);
            }
        }
        else
        {
            $img_name2 = $site->app_logo;
        }

        $site->update([
            'site_name' => $request->site_name,
            'address' => $request->address,
            'site_about' => $request->site_about,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'youtube_link' => $request->youtube_link,
            'instagram_link' => $request->instagram_link,
            'e_cad_id' => $request->e_cad_id,
            'tin' => $request->tin,
            'trade_licence_no' => $request->trade_licence_no,
            'developed_by' => $request->developed_by,
            'app_link' => $request->app_link,
            'logo' => $img_name,
            'app_logo' => $img_name2,
        ]);
        return back()->with('sms', 'Information Updated');
    }

}
