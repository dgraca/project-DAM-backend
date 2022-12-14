<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        // get all reports with pagination (10 each time)
        return Report::with('state')
            ->with('user', 'state', 'images')
            ->where('user_id', Auth::id())
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048'
        ]);

        // store image in public_path('report_images')
        // creates a report with no validation
        $image = $request->image;
        if ($image != null) {
            foreach ($image as $key => $value) {
                $data = hash('sha256', $value->getClientOriginalName() . '_' . time() . $key);
                $imageName = $data . '.' . $value->extension();
                $value->move(public_path('report_images'), $imageName);
                $image[$key] = $imageName;
            }
        }

        // create report
        $report = Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'state_id' => 1,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // create report image
        foreach ($image as $key => $value) {
            // creates report image
            ReportImage::create([
                'image' => $image[$key],
                'report_id' => $report->id,
            ]);
        }

        return $report;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        return Report::with('user', 'state', 'images')->find($id)->where('user_id', Auth::id());
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
        // TODO: update data and deal with images
        //! delete images that are not in the request?
        //! fuck, dealing with images will be problematic
        //! maybe an entry API to delete images?
        return Report::find($id)->where('user_id', Auth::id())->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::with('user', 'state', 'images')->find($id)->where('user_id', Auth::id());
        $report->images()->delete();
        return $report->delete();
    }
}
