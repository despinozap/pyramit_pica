<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Well;
use App\Image;
use App\Http\Requests\WellCreateRequest;
use App\Http\Requests\WellEditRequest;

class WellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wells = Well::orderBy('id', 'DESC')->paginate(5);

        return view('admin.wells.index')->with('wells', $wells);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wells.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WellCreateRequest $request)
    {
        $responseCode = 0;

        if($request->image_data)
        {
            $name = 'wellsCeitpp_' . time() . rand(10,1000) . '.jpg';
            $path = public_path() . '/front/upload/wells/' . $name;

            $file = preg_replace('/data:image\/[A-z]+;base64,/', '', $request->image_data);
            $img = str_replace(' ', '+', $file);
            $data = base64_decode($img);

            $tmpFile = tmpfile();
            fwrite($tmpFile, $data);
            $metaDatas = stream_get_meta_data($tmpFile);
            $tmpFilename = $metaDatas['uri'];

            if(is_file($tmpFilename))
            {
                $src = imagecreatefromstring(file_get_contents($tmpFilename));
            }
            else
            {
                $responseCode = -2;
            }

            if($responseCode != -2)
            {
                list($width, $height) = getimagesize($tmpFilename);

                $image_tmp = imagecreatetruecolor($width, $height);

                imagecopyresampled($image_tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);

                if(imagejpeg($image_tmp, $path, 100))
                {
                    $image = new Image();
                    $image->name = $name;

                    if($image->save())
                    {
                        $well = new Well($request->all());
                        $well->image()->associate($image);
                        $well->user_id = \Auth::user()->id;

                        if($well->save())
                        {
                            $responseCode = 1;
                        }
                    }
                }
                else
                {
                    $responseCode = 0;
                }
            }

            fclose($tmpFile);
        }
        else
        {
            $responseCode = -1;
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
        $well = Well::find($id);

        return view('admin.wells.edit')->with('well', $well);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WellEditRequest $request, $id)
    {
        $responseCode = 0;

        if($well = Well::find($id))
        {
            $well->fill($request->all());

            $passed = true;
            if($request->image_data)
            {
                $name = 'wellsCeitpp_' . time() . rand(10,1000) . '.jpg';
                $path = public_path() . '/front/upload/wells/' . $name;

                $file = preg_replace('/data:image\/[A-z]+;base64,/', '', $request->image_data);
                $img = str_replace(' ', '+', $file);
                $data = base64_decode($img);

                $tmpFile = tmpfile();
                fwrite($tmpFile, $data);
                $metaDatas = stream_get_meta_data($tmpFile);
                $tmpFilename = $metaDatas['uri'];

                if(is_file($tmpFilename))
                {
                    $src = imagecreatefromstring(file_get_contents($tmpFilename));
                }
                else
                {
                    $responseCode = -2;
                }

                if($responseCode != -2)
                {
                    list($width, $height) = getimagesize($tmpFilename);

                    $image_tmp = imagecreatetruecolor($width, $height);

                    imagecopyresampled($image_tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);

                    if(imagejpeg($image_tmp, $path, 100))
                    {
                        $image = $well->image;
                        $previous_path = public_path() . '/front/upload/wells/' . $image->name;
                        $image->name = $name;

                        if($image->save())
                        {
                            if(file_exists($previous_path))
                            {
                                unlink($previous_path);
                            }
                        }
                        else
                        {
                            $passed = false;
                        }
                    }
                    else
                    {
                        $passed = false;

                        $responseCode = -2;
                    }
                }

                fclose($tmpFile);
            }

            if($passed == true)
            {
                if($well->save())
                {
                    $responseCode = 1;
                }
                else
                {
                    $responseCode = 0;
                }
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
            $well = Well::find($request->id);
            $image_id = $well->image_id;

            if($well->delete())
            {
                $image = Image::find($image_id);
                $image->delete();

                $path = public_path() . '/front/upload/wells/' . $image->name;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }

            $responseCode = 1;
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }
}
