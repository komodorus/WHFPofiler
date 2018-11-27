<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Libraries\ImageUploader;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('profile.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function toggleActive(User $user){
        $status = $user->active;

        $user->active = !$status;
        $user->save();

        return response()->json([
            $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 'name' => ['required', 'string', 'max:255'],
        // 'email'  => ['required', 'string', 'email', 'max:255', 'unique:users'],
        // 'password'  => ['required', 'string', 'min:6', 'confirmed'],
        // 'birthday'  => ['required', 'data'],
        // 'picture'  =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ,
        // 'cpf'  => ['required', 'formato_cpf', 'cpf', 'unique:users']
        
        // dd($request->all());
        

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'string|nullable|min:6|confirmed',
            'birthday' => 'required|data',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cpf' => 'required|formato_cpf|cpf'
        ]);

        $user = User::find($id);

        if($request->hasFile('picture')){
            $user->picture = ImageUploader::save($request->file('picture'));
        }

        if(!!$request->password){
            
            $user->password = bcrypt($request->password);
            
            if(auth()->user()->id == $user->id){
                Auth::logout();
            }
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday);
        $user->cpf = $request->cpf;
        $user->save();
        return redirect()->back()->with('success', 'Registro atualizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Registro removido com sucesso.');
    }
}
