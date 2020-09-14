<?php

namespace App\Http\Controllers\Admin;

use Auth;
use View;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\Controller;

class Users extends Controller
{
	public function index(Request $request)
    {	
		$data = array();
		return view('admin.index',$data); 
	}
	public function AjaxGetList(Request $request){
		$data=[];
		$count = 10;
		$users = User::orderBy("created_at",'DESC')->paginate($count);
		$data['total'] = $users->total();
		$data['lastPage'] = $users->lastPage();
		$data['currentPage'] = $users->currentPage();
		// pagination list page
		$data['links'] = [];
		foreach($users->links()->elements as $group){
			if(is_array($group)){
				foreach($group as $pageNum=>$link){
					$data['links'][]=$pageNum;
				}
			}
		}
		// user list
		$data['users']=[];
		$startNum = $data['currentPage']*$count-$count+1;
		foreach($users as $user){ 
			$data['users'][]=array(
				"num"=>$startNum++,
				"id"=>$user->id,
				"name"=>$user->name,
				"email"=>$user->email,
				"created"=>$user->created_at->format("Y-m-d H:i:s"),
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
		$user = User::where('email',"=",$request->input('email'))->first();
		if($user){			
			return response()->json([
				'status' => 'error',
				'errors' => ['User with this E-Mail exists'],
			], 200);
		}
		User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
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
	public function getUserInfo(Request $request)
    {	
		$data = ['status' => 'error'];
		if($request->has('id')){
			$idUser = $request->input('id');
			$user = User::where('id',"=",$idUser)->first();
			if($user){
				$data = [
					'status' => 'done',
					'name' => $user->name,
					'email' => $user->email,
				];
			} 
		}
		return response()->json($data, 200);
	}
	public function edit($idUser, Request $request)
    {	
		$rules = $this->Validation();
		unset($rules['password']);
		$validator = Validator::make($request->all(),$rules,$this->ValidationMessage());
		if($validator->fails()){
			return response()->json([
				'status' => 'error',
				'errors' => $validator->errors()->all(),
			], 200);
		} 
		$update = array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
		);
		if(mb_strlen($request->input('password'))>0){
			$update['password']= bcrypt($request->input('password'));
		}
		User::where('id',"=",$idUser)->update($update); 
		return response()->json([
			'status' => 'done',
			'errors' => null,
		], 200);
	}
	public function UserDelete(Request $request)
    {	
		if($request->has('id')){
			if(Auth::user()->id==$request->input('id')){
				return response()->json([
					'status' => 'error',
					'errors' => ["Can't delete your account"],
				], 200);
			}
			User::where("id","=",$request->input('id'))->delete();
		}
		return response()->json([
			'status' => 'done',
			'errors' => null,
		], 200);
	}
	// Validation rules
	public function Validation(){
		return [
			'email' => 'required|email|min:5|max:50',
			'name' => 'required|min:2|max:100', 
			'password' => 'required|min:2|max:50'
		]; 
    }
	// Validation Message
	public function ValidationMessage(){
		return [
			'email.email' => 'The E-Mail was entered incorrectly',
			'email.required' => 'E-Mail not entered',
			'name.min' => 'Name must be longer than 2 characters', 
			'name.required' => 'Name not entered',
			'password.min' => 'Password must be longer than 2 characters',
			'password.required' => 'Password not entered',
		]; 
    }
}
