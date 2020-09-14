<?php

namespace App\Http\Controllers\Admin;

use Auth;
use View;
use Validator;
use ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentUsers;
use App\Http\Controllers\Controller;

class Departments extends Controller
{
	public function index(Request $request)
    {	
		$data = array();
		return view('admin.index',$data); 
	}
	public function AjaxGetList(Request $request){
		$data=[];
		$count = 10;
		$departments = Department::orderBy("created_at",'DESC')->paginate($count);
		$data['total'] = $departments->total();
		$data['lastPage'] = $departments->lastPage();
		$data['currentPage'] = $departments->currentPage();
		// pagination list page
		$data['links'] = [];
		foreach($departments->links()->elements as $group){
			if(is_array($group)){
				foreach($group as $pageNum=>$link){
					$data['links'][]=$pageNum;
				}
			}
		}
		// department list
		$data['departments']=[];
		$startNum = $data['currentPage']*$count-$count+1;
		foreach($departments as $department){ 
			$logo = null;
			if($department->logo!=null){
				$logo = $department->logo."?".$department->updated_at->format("YmdHis");
			}
			$users = [];
			foreach($department->users as $user){
				$users[]=$user->user->name;
			}
			$data['departments'][]=array(
				"num"=>$startNum++,
				"id"=>$department->id,
				"name"=>$department->name,
				"description"=>$department->description,
				"logo"=>$logo,
				"users"=>$users,
				"created"=>$department->created_at->format("Y-m-d H:i:s"),
				"update"=>$department->updated_at->format("Y-m-d H:i:s"),
			);
		}
		return response()->json($data);
	}
	public function addForm(Request $request)
    {	
		$data = array();
		return view('admin.index',$data); 
	}
	public function add(Request $request){
		$validator = Validator::make($request->all(),$this->Validation(),$this->ValidationMessage());
		if($validator->fails()){
			return response()->json([
				'status' => 'error',
				'errors' => $validator->errors()->all(),
			], 200);
		} 
		
		$DepartmentID = Department::insertGetId([
            'name' => $request->input('name'),
            'description' => $request->input('description')??null,
            'logo' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
		
		$logoName = $DepartmentID.".jpg";
		$logoBase64 = $request->input('logo')??null;
		$logo = $this->ImageBase64Upload($logoBase64,$logoName);
		if($logo!=null){
			Department::where('id','=',$DepartmentID)->update(['logo'=>$logo]);
		}
		
		$insert = [];
		$users = $request->input('users');
		if(is_array($users)){
			foreach($users as $userID=>$bool){
				if($bool===true){
					$insert[] = array(
						"department_id"=>$DepartmentID,
						"user_id"=>$userID,
					);
				}
			}
		}
		DepartmentUsers::insert($insert);
		
		return response()->json([
			'status' => 'done',
			'errors' => null,
		], 200);
    }
	public function editForm($idDepartment, Request $request)
    {	
		$data = array();
		return view('admin.index',$data); 
	}
	public function getDepartmentInfo(Request $request)
    {	
		$data = ['status' => 'error'];
		if($request->has('id')){
			$DepartmentID = $request->input('id');
			$Department = Department::where('id',"=",$DepartmentID)->first();
			if($Department){
				$data = [
					'status' => 'done',
					'name' => $Department->name,
					'description' => $Department->description,
					'logo' => $Department->logo, 
				];
			} 
		}
		return response()->json($data, 200);
	}
	public function edit($DepartmentID, Request $request)
    {	
		$validator = Validator::make($request->all(),$this->Validation(),$this->ValidationMessage());
		if($validator->fails()){
			return response()->json([
				'status' => 'error',
				'errors' => $validator->errors()->all(),
			], 200);
		} 
		
		$logoName = $DepartmentID.".jpg";
		$logoBase64 = $request->input('logo')??null;
		$logo = $this->ImageBase64Upload($logoBase64,$logoName);
		if($logo==null){
			$logoPath = storage_path('app/logo/'.$logoName);
			if(file_exists($logoPath)){
				unlink($logoPath);
			}
		}

		$update = array(
			'name' => $request->input('name'), 
            'description' => $request->input('description')??null,
            'logo' => $logo,
        ); 
		Department::where('id','=',$DepartmentID)->update($update);
		
		DepartmentUsers::where('department_id','=',$DepartmentID)->delete();
		$insert = [];
		$users = $request->input('users');
		if(is_array($users)){
			foreach($users as $userID=>$bool){
				if($bool===true){
					$insert[] = array(
						"department_id"=>$DepartmentID,
						"user_id"=>$userID,
					);
				}
			}
		}
		DepartmentUsers::insert($insert);
		
		return response()->json([
			'status' => 'done',
			'errors' => null,
		], 200);
	}
	public function DepartmentDelete(Request $request)
    {	
		Department::where("id","=",$request->input('id'))->delete();
		return response()->json([
			'status' => 'done',
			'errors' => null,
		], 200);
	}
	// ImageBase64Upload
	public function ImageBase64Upload($image, $imageName=false){
		if($image!=null){
			if(filter_var($image, FILTER_VALIDATE_URL)){
				return $image;
			}
			$image = mb_substr($image, mb_strpos($image, ",")+1);
			$image = base64_decode($image);
			if($image){
				if(!$imageName){
					$imageName = md5(md5(md5($image))).".jpg";
				}
				$path = 'app/logo/'.$imageName;
				$pathStorage = storage_path($path);
				file_put_contents($pathStorage,$image);
				if(in_array(exif_imagetype($pathStorage), [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF])){
					ImageOptimizer::optimize($pathStorage);
					$image = Storage::disk('public')->url($path);
				} else {
					if(file_exists($pathStorage)){
						unlink($pathStorage);
					}
					$image = null;
				}
			}
		}
		return $image;
	}
	// AjaxGetAllUser 
	public function AjaxGetDepartmentUser(Request $request){
		$users = User::all();
		$data['status']='done';
		$data['usersChecked']=[];
		$data['users']=[];
		foreach($users as $user){ 
			$data['users'][$user->id]=array(
				"id"=>$user->id,
				"name"=>$user->name,
			);
		}
		if($request->has('id')&&intval($request->input('id'))>0){
			$DepartmentID = intval($request->input('id'));
			$Department = Department::where("id","=",$DepartmentID)->first();
			$list = $Department->users;
			foreach($list as $user){
				$data['usersChecked'][$user->user_id]=true;
			}
		}
		return response()->json($data);
	}
	// Validation rules
	public function Validation(){
		return [
			'name' => 'required|min:2|max:100', 
		]; 
    }
	// Validation Message
	public function ValidationMessage(){
		return [
			'name.min' => 'Name must be longer than 2 characters', 
			'name.required' => 'Name not entered',
		]; 
    }
}
