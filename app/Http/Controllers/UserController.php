<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContracts;
use App\Facades\CounterFacades;
use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use App\Services\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function __construct( )
    {
        
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        // dump(resolve(Counter::class));
        // dump(resolve(Counter::class));
        // dump(resolve(Counter::class));

        // $counter = resolve(Counter::class);
        return view('users.show', [
            'user' => $user,
            'counter' => CounterFacades::increment("user_{$user->id}")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        //
        if($request->hasFile('avatar')){

            $path = $request->file('avatar')->store('avatars');

            if(isset($user->image)){
                Storage::delete($user->image->path);
                $user->image->path = $path;
                $user->image->save();
            }else{
                $user->image()->save(
                    Image::make( ['path' => $path] )
                );
            }
        }

        $user->locale = $request->get('locale');
        $user->save();
        return redirect()->back()->withStatus('User profile was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
