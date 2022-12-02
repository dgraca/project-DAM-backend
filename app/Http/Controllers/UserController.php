<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id)->where('id', Auth::id())->first();
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
        if ($id != Auth::user()->id) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::find($id);

        // validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // stores image in public_path('report_images')
        $image = $request->image;
        if ($image != null) {
            $data = hash('sha256', $image->getClientOriginalName() . '_' . time() . $image->getClientOriginalExtension());
            $imageName = $data . '.' . $image->extension();
            $image->move(public_path('report_images'), $imageName);
        }


        return $user->update($request->all());
    }
}
