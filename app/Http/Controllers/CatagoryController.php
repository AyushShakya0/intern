<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CatagoryController extends Controller
{
    public function index(){
        $catagory=Catagory::all();
        return view('catagory.index',compact('catagory'));
    }
    public function showcreate(){
        
        return view('catagory.create');
    }

    public function create(Request $request){
        $request->validate([
            'catagory'=> 'required|string'
        ]);

        $catagory=new Catagory;
        $catagory->catagory=$request->input('catagory');
        $catagory->status=$request->input('status');
        $catagory->save();
        return redirect()->route('catagory')->with(["success"=>"Successfully stored Data"]);
    }
    public function delete($id){
        $catagory_data=Catagory::find($id);
        if($catagory_data){
            $catagory_data->delete();
        }
        // $catagory=Catagory::all();
        // return redirect()->route('catagory',compact('catagory'))->with(["delete"=>"Deleted Data Successfully"]);
        // return redirect()->route('catagory.create');
    }

    public function update($id){
        $catagory_data=Catagory::find($id);
       return view('catagory.update',compact('catagory_data'));
    }
    public function updatedata(Request $request,$id){
        $catagory_data=$request->updatecatagory;
        $status=$request->updatestatus;
        $catagory_data=Catagory::find($id)
        ->update([
            'catagory'=>$catagory_data,
            'status'=>$status
        ]);

  $catagory=Catagory::all();
  return redirect()->route('catagory',compact('catagory'))->with(["update"=>"Updated Data Successfully"]);

    }


}
