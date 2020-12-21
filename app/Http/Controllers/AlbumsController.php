<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Image;
use App\Photo;
use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumEditRequest;
use App\Http\Requests\PhotoCreateRequest;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::orderBy('id', 'DESC')->paginate(5);
        //$albums = Album::orderBy('id', 'ASC')->where('id', '=', 1)->paginate(5);

        return view('admin.albums.index')->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumCreateRequest $request)
    {
        $responseCode = 0;

        if($request->image_data)
        {
            $name = 'albumsCeitpp_' . time() . rand(10,1000) . '.jpg';
            $path = public_path() . '/front/upload/albums/' . $name;

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

                if(imagejpeg($image_tmp, $path, 75))
                {
                    $image = new Image();
                    $image->name = $name;
                    if($image->save())
                    {
                        $album = new Album($request->all());
                        $album->image()->associate($image);
                        //$album->user_id = \Auth::user()->id;
                        $album->user_id = 1;

                        if($album->save())
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
        $album = Album::find($id);
        $photos = $album->photos()->paginate(10);

        return view('admin.albums.show')->with('album', $album)->with('photos', $photos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);

        return view('admin.albums.edit')->with('album', $album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumEditRequest $request, $id)
    {
        $responseCode = 0;

        if($album = Album::find($id))
        {
            $album->fill($request->all());

            $passed = true;
            if($request->image_data)
            {
                $name = 'albumsCeitpp_' . time() . rand(10,1000) . '.jpg';
                $path = public_path() . '/front/upload/albums/' . $name;

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

                    if(imagejpeg($image_tmp, $path, 75))
                    {
                        $image = $album->image;
                        $previous_path = public_path() . '/front/upload/albums/' . $image->name;
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

            if($passed === true)
            {
                if($album->save())
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
            $album = Album::find($request->id);
            $image_id = $album->image_id;
            $photos = $album->photos;

            if($album->delete())
            {
                $image = Image::find($image_id);
                $image->delete();

                $path = public_path() . '/front/upload/albums/' . $image->name;
                if(file_exists($path))
                {
                    unlink($path);
                }

                $photos = $album->photos;
                $photos->each(function($photo)
                {
                    $path = public_path() . '/front/upload/albums/' . $photo->image->name;
                    if(file_exists($path))
                    {
                        unlink($path);
                    }
                });

                $responseCode = 1;
            }
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }

    public function photoUpload(PhotoCreateRequest $request, $id)
    {
        $responseCode = 0;

        $album = Album::find($id);

        if($request->image_data)
        {
            $name = 'albumsCeitpp_' . $album->id . '_' . time() . rand(10,1000) . '.jpg';
            $path = public_path() . '/front/upload/albums/' . $name;

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
                $responseCode = -3;
            }

            if($responseCode != -3)
            {
                list($width, $height) = getimagesize($tmpFilename);

                //Adjust max size
                {
                    $image_maxSize = 1024;

                    $width_new = $width;
                    $height_new = $height;

                    if($width > $height) //landscape
                    {
                        if($width > $image_maxSize)
                        {
                            $width_new = $image_maxSize;

                            $height_new = ($height / $width) * $width_new;
                        }
                    }
                    else if($height > $width) //portrait
                    {
                        if($height > $image_maxSize)
                        {
                            $height_new = $image_maxSize;

                            $width_new = ($width / $height) * $height_new;
                        }
                    }
                    else
                    {
                        if($width > $image_maxSize)
                        {
                            $width_new = $image_maxSize;
                            $height_new = $image_maxSize;
                        }
                    }
                }

                $image_tmp = imagecreatetruecolor($width_new, $height_new);

                imagecopyresampled($image_tmp, $src, 0, 0, 0, 0, $width_new, $height_new, $width, $height);

                if(imagejpeg($image_tmp, $path, 75))
                {
                    $image = new Image();
                    $image->name = $name;
                    $image->save();

                    $responseCode = 1;
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


        $message = '';
        switch($responseCode)
        {
            case -3:
            {
                $message = 'Archivo defectuoso';

                break;
            }

            case -2:
            {
                $message = 'Formato no permitido';

                break;
            }

            case -1:
            {
                $message = 'Error al subir la foto';

                break;
            }

            case 0:
            {
                $message = 'Error al subir la foto';

                break;
            }

            case 1:
            {
                $photo = new Photo();
                $photo->image_id = $image->id;
                $photo->album_id = $album->id;
                $photo->description = $request->description;
                $photo->save();

                $message = 'Foto subida exitosamente';

                break;
            }

            default:
            {

                break;
            }
        }

        return response()->json([
                                    'status' => $responseCode,
                                    'message' => $message
                                ]
        );
    }

    public function photoDestroy(Request $request)
    {
        $responseCode = 0;

        if($request->id)
        {
            $photo = Photo::find($request->id);
            if($photo->delete())
            {
                $path = public_path() . '/front/upload/albums/' . $photo->image->name;
                if(file_exists($path))
                {
                    unlink($path);
                }

                $responseCode = 1;
            }
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }
}
