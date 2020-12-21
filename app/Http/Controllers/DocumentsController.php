<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentCreateRequest;
use App\Http\Requests\DocumentEditRequest;
use App\Document;
use App\Image;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::search($request->title)->orderBy('id', 'DESC')->paginate(5);
        $documents->each(function($document)
        {
            $document->image;
            $document->user;

            switch($document->category)
            {
                case 'biblio':
                {
                    $document->category = 'Bibliografía';

                    break;
                }

                case 'report':
                {
                    $document->category = 'Presentación';

                    break;
                }

                case 'other':
                {
                    $document->category = 'Otro';

                    break;
                }

                default:
                {
                    $document->category = 'Otro';

                    break;
                }
            }
        });

        return view('admin.documents.index')->with('documents', $documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentCreateRequest $request)
    {
        $responseCode = 0;

        if(($request->image_data) && ($request->file('file')))
        {
            $front_name = 'documentsCeitpp_FRONT_' . time() . rand(10,1000) . '.jpg';
            $front_path = public_path() . '/front/upload/documents/' . $front_name;

            $front_file = preg_replace('/data:image\/[A-z]+;base64,/', '', $request->image_data);
            $img = str_replace(' ', '+', $front_file);
            $front_data = base64_decode($img);

            $file_file = $request->file('file');
            $file_name = 'documentsCeitpp_FILE_' . time() . rand(10,1000) . '.' . $file_file->getClientOriginalExtension();
            $file_path = public_path() . '/front/upload/documents/';

            $tmpFile = tmpfile();
            fwrite($tmpFile, $front_data);
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
                if((imagejpeg($image_tmp, $front_path, 75)) && ($file_file->move($file_path, $file_name)))
                {
                    $image = new Image();
                    $image->name = $front_name;
                    if($image->save())
                    {
                        $document = new Document($request->all());
                        $document->name = $file_name;
                        $document->original_name = $file_file->getClientOriginalName();
                        $document->image()->associate($image);
                        $document->user_id = \Auth::user()->id;

                        if($document->save())
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
        $document = Document::find($id);

        return view('admin.documents.edit')->with('document', $document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentEditRequest $request, $id)
    {
        $responseCode = 0;

        if($document = Document::find($id))
        {
            $document->fill($request->all());

            $passed = true;
            if($request->file('file'))
            {
                $file_file = $request->file('file');
                $file_name = 'documentsCeitpp_FILE_' . time() . rand(10,1000) . '.' . $file_file->getClientOriginalExtension();
                $file_path = public_path() . '/front/upload/documents/';


                if($file_file->move($file_path, $file_name))
                {
                    $previous_path = $file_path . $document->name;
                    if(file_exists($previous_path))
                    {
                        unlink($previous_path);
                    }

                    $document->name = $file_name;
                    $document->original_name = $file_file->getClientOriginalName();
                    $document->user_id = \Auth::user()->id;
                }
                else
                {
                    $passed = false;
                }
            }

            if($passed == true)
            {
                if($request->image_data)
                {
                    $front_name = 'documentsCeitpp_' . time() . rand(10,1000) . '.jpg';
                    $front_path = public_path() . '/front/upload/documents/' . $front_name;

                    $front_file = preg_replace('/data:image\/[A-z]+;base64,/', '', $request->image_data);
                    $img = str_replace(' ', '+', $front_file);
                    $front_data = base64_decode($img);

                    $tmpFile = tmpfile();
                    fwrite($tmpFile, $front_data);
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
                        if(imagejpeg($image_tmp, $front_path, 75))
                        {
                            $image = $document->image;
                            $previous_path = public_path() . '/front/upload/documents/' . $image->name;

                            if(file_exists($previous_path))
                            {
                                unlink($previous_path);
                            }

                            $image->name = $front_name;

                            if($image->save())
                            {
                                $passed = true;
                            }
                            else
                            {
                                $passed = false;
                            }
                        }
                        else
                        {
                            $passed = false;

                            $responseCode = 0;
                        }
                    }

                    fclose($tmpFile);
                }
            }

            if($passed === true)
            {
                if($document->save())
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
            $document = Document::find($request->id);
            $image_id = $document->image_id;

            if($document->delete())
            {
                $image = Image::find($image_id);
                $image->delete();

                $path = public_path() . '/front/upload/documents/' . $document->name;
                if(file_exists($path))
                {
                    unlink($path);
                }

                $path = public_path() . '/front/upload/documents/' . $image->name;
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
