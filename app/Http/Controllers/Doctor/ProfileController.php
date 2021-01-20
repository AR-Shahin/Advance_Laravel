<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Experience;
use function differenceBetweenTwoDate;
use function file_exists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use function redirect;
use function unlink;

class ProfileController extends Controller
{
    public function showUpdateProfileForm(){
        if(View::exists('doctor.profile.profile')){
            return \view('doctor.profile.profile',[
                'doctor' => Doctor::findOrfail(Auth::guard('doctor')->id()),
                'countries' => Country::select('id','name')->latest()->get()
            ]);
        }
    }
    public function updateProfile(Request $request){
        $id = Auth::guard('doctor')->id();
        // return $request->all();
        $request->validate([
            'resume' => ['mimes:pdf'],
            'avatar' => ['mimes:jpg,png,jpeg'],
//            'certificate' => ['mimes:jpg,png,jpeg,pdf'],
        ]);
        //experience
        $experience = array_filter($request->start_date, function($filter){
            return ! empty($filter);
        });
        $counter = sizeof($experience);
        $experience_in_month = 0;
        for($i =0 ;$i<$counter;$i++){
            $diff = differenceBetweenTwoDate($request->start_date[$i],$request->end_date[$i]);
            $experience_in_month += $diff ;

            if($this->doctorExpericenceIsExists($request->experience_id[$i]))
            {
                Experience::where('id',$request->experience_id[$i])
                    ->update([
                        'start_date' => $request->start_date[$i],
                        'end_date' => $request->end_date[$i],
                        'clinic_name' => $request->clinic_name[$i],
                    ]);
            }
            else
            {
                Experience::create([
                    'doctor_id' => $id,
                    'start_date' => $request->start_date[$i],
                    'end_date' => $request->end_date[$i],
                    'clinic_name' => $request->clinic_name[$i],
                ]);
            }
        }
        $old_data = Doctor::select('avatar','resume')->find($id);
        //avatar
        if ($img = $request->file('avatar')) {
            $avatar = $request->file('avatar');
            $ext = $avatar->extension();
            $name =  hexdec(uniqid()) . '.' .$ext;
            $path = 'uploads/avatars/';
            $last_image = $path.$name;
            Doctor::find($id)->update(['avatar' => $last_image]);
            $avatar->move($path,$last_image);
            if(file_exists($old_data->avatar)){
                unlink($old_data->avatar);
            }
        }

        //resumes
        if ($resume = $request->file('resume')) {
            $resume = $request->file('resume');
            $ext = $resume->extension();
            $name =  hexdec(uniqid()) . '.' .$ext;
            $path = 'uploads/resumes/';
            $last_resume = $path.$name;
            Doctor::find($id)->update(['resume' => $last_resume]);
            $resume->move($path,$last_resume);
            if(file_exists($old_data->resume)){
                unlink($old_data->resume);
            }
        }
        $update = Doctor::find($id)->update(
            $request->except([
                '_token','_method','start_date','end_date','clinic_name','resume','is_experience',
                'certificate',
                'experience_id','avatar','resumes',
                'update_certificate'
            ])
        );
        if($request->has('avatar'))
        {
            Doctor::find($id)->update([
                'avatar' => $last_image,
                'experience' => round($experience_in_month / 12,1)
            ]);
        }
        else
        {
            Doctor::find($id)->update([
                'experience' => round($experience_in_month / 12,1)
            ]);
        }

        if($request->has('resume'))
        {
            Doctor::find($id)->update([
                'resume' => $last_resume,
                'experience' => round($experience_in_month / 12,1)
            ]);
        }
        else
        {
            Doctor::find($id)->update([
                'experience' => round($experience_in_month / 12,1)
            ]);
        }
        $certificates = Certificate::where('doctor_id',$id)->get();
        $cer_count =  $certificates->count();
       $x =  $request->update_certificate;
       if($x == ''){
           $x = 0;
       }
//return count($request->update_certificate);
        //delete
        if($cer_count>0){
            if($cer_count != $x){
                if($request->update_certificate == true && $certificates){
                    foreach ($request->update_certificate as $item) {
                        foreach ($certificates as $certificate){
                            if($certificate->id != $item){
                                $old_data = Certificate::select('documents')->where('id',$certificate->id)->first();
                                if(file_exists($old_data->documents)){
                                    unlink($old_data->documents);
                                }
                                Certificate::where('id',$certificate->id)->delete();
                            }
                        }
                    }
                }
            }
        }

        //insert documents
        if ($files = $request->file('certificate')) {
            foreach($files as $img) {
                $ext = $img->extension();
                $name =  hexdec(uniqid()) . '.' .$ext;
                $path = 'uploads/certificates/';
                $last_image = $path.$name;
                $certificate = new Certificate();
                $certificate->doctor_id = $id;
                $certificate->documents = $last_image;
                if( $certificate->save()){
                    $img->move($path,$last_image);
                }
            }
        }
        if ($update){
            return redirect()->back();
        }else{
            return $request->all();
        }

    }

    public function doctorExpericenceIsExists($id) : bool
    {
        $check = Experience::where('id',$id)->exists();

        if($check)
        {
            return true;
        }
        return false;
    }
}
