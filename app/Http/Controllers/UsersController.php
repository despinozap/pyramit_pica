<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserChangePasswordRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $responseCode = 0;

        $user = new User($request->all());
        $user->password = bcrypt($request->password);

        if($user->save())
        {
            $responseCode = 1;
        }

        return $responseCode;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $responseCode = 0;

        if($user = User::find($id))
        {
            $user->fill($request->all());

            if($user->save())
            {
                $responseCode = 1;
            }
        }
        else
        {
            $responseCode = -1;
        }


        return $responseCode;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $responseCode = 0;

        if($request->id)
        {
            $user = User::find($request->id);

            if($user->type == 'admin')
            {
                $countAdmin = User::orderBy('id', 'ASC')->get()->where('type', 'admin')->count();

                if($countAdmin > 1)
                {
                    if($user->delete())
                    {
                        $responseCode = 1;
                    }
                }
                else
                {
                    $responseCode = -2;
                }
            }
            else
            {
                if($user->delete())
                {
                    $responseCode = 1;
                }
            }
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }

    public function changeState(Request $request)
    {
        $responseCode = 0;

        if($request->id)
        {
            $user = User::find($request->id);

            if($request->state == 0)
            {
                $user->active = false;

                if($user->type == 'admin')
                {
                    $countAdmin = User::orderBy('id', 'ASC')->get()->where('type', 'admin')->count();

                    if($countAdmin > 1)
                    {
                        if($user->save())
                        {
                            $responseCode = 1;
                        }
                    }
                    else
                    {
                        $responseCode = -2;
                    }
                }
                else
                {
                    if($user->save())
                    {
                        $responseCode = 1;
                    }
                }
            }
            else
            {
                $user->active = true;
                if($user->save())
                {
                    $responseCode = 1;
                }
            }

        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        $responseCode = 0;

        if($request->new_password == $request->re_password)
        {
            if (Auth::attempt(['email' => $request->user()->email, 'password' => $request->current_password]))
            {
                $user = User::find($request->user()->id);
                $user->password = bcrypt($request->new_password);

                if($user->save())
                {
                    $responseCode = 1;
                }
            }
            else
            {
                $responseCode = -1;
            }
        }
        else
        {
            $responseCode = -2;
        }


        return $responseCode;
    }
}
