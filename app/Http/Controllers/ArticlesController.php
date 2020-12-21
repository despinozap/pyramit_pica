<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Category;
use App\Image;
use App\Contact;
use App\Comment;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleEditRequest;
use Carbon\Carbon;

class ArticlesController extends Controller
{

    public function __construct()
    {
        Carbon::setLocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::search($request->title)->orderBy('id', 'DESC')->paginate(5);
        $articles->each(function($article)
        {
            $article->category;
            $article->user;
            $article->comments;
        });

        return view('admin.articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.articles.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $responseCode = 0;

        if($request->image_data)
        {
            $name = 'newsCeitpp_' . time() . rand(10,1000) . '.jpg';
            $path = public_path() . '/front/upload/articles/' . $name;

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

                if(imagejpeg($image_tmp, $path, 90))
                {
                    $image = new Image();
                    $image->name = $name;
                    if($image->save())
                    {
                        $article = new Article($request->all());
                        $article->image()->associate($image);
                        $article->user_id = \Auth::user()->id;

                        if($article->save())
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
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        $article = Article::find($id);

        return view('admin.articles.edit')->with('article', $article)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleEditRequest $request, $id)
    {
        $responseCode = 0;

        if($article = Article::find($id))
        {
            $article->fill($request->all());

            $passed = true;
            if($request->image_data)
            {
                $name = 'newsCeitpp_' . time() . rand(10,1000) . '.jpg';
                $path = public_path() . '/front/upload/articles/' . $name;

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

                    if(imagejpeg($image_tmp, $path, 90))
                    {
                        $image = $article->image;
                        $previous_path = public_path() . '/front/upload/articles/' . $image->name;
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
                if($article->save())
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
            $article = Article::find($request->id);
            $image_id = $article->image_id;

            if($article->delete())
            {
                $responseCode = 1;

                $image = Image::find($image_id);
                $image->delete();

                $path = public_path() . '/front/upload/articles/' . $image->name;
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }

    public function comments($id)
    {
        $article = Article::find($id);
        $comments = Comment::orderBy('id', 'ASC')->where('article_id', $article->id)->where('approved', true)->paginate(5);

        return view('admin.articles.comments')->with('article', $article)->with('comments', $comments);
    }

    public function removeComment(Request $request)
    {
        $responseCode = 0;

        if(($request->article_id) && ($request->id))
        {
            $comment = Comment::find($request->id);

            if($comment->delete())
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
}
