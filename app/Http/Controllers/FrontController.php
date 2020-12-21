<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Contact;
use App\Comment;
use App\Document;
use App\Album;
use App\Well;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\ContactSendmailRequest;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use Mail;

class FrontController extends Controller
{
    protected $contact;

    public function __construct()
    {
        Carbon::setLocale('es');
    }

    public function home()
    {
        $articles = Article::orderBy('updated_at', 'DESC')->limit(3)->get();
        $articles->each(function($article)
        {
            $article->category;
            $article->user;
        });


        $albumsAll = Album::orderBy('id', 'ASC')->where('id', '>', 1)->get();
        $albums = $albumsAll->filter(function ($value, $key)
        {
            return $value->photos->count() > 0;
        });

        $contact = Contact::first();

        return view('front.home')->with('albums', $albums)->with('articles', $articles)->with('contact', $contact);
    }

    public function sig()
    {
        $wells = Well::orderBy('id', 'DESC')->get();

        $contact = Contact::first();

    	return view('front.sig')->with('wells', $wells)->with('contact', $contact);
    }

    public function project()
    {
        $contact = Contact::first();

        $photos = Album::find(1)->photos->random(4);

    	return view('front.project')->with('photos', $photos)->with('contact', $contact);
    }

    public function gallery()
    {
        $contact = Contact::first();

        $albumsAll = Album::orderBy('id', 'ASC')->get();
        $albums = $albumsAll->filter(function ($value, $key)
        {
            return $value->photos->count() > 0;
        });

    	return view('front.gallery')->with('albums', $albums)->with('contact', $contact);
    }

    public function repository()
    {
        $documents = Document::orderBy('updated_at', 'DESC')->paginate(6);
        $documents->each(function($document)
        {
            $document->image;
            $document->user;
        });

        $contact = Contact::first();

    	return view('front.repository')->with('documents', $documents)->with('contact', $contact);
    }

    public function news()
    {
        $articles = Article::orderBy('updated_at', 'DESC')->paginate(3);
        $articles->each(function($article)
        {
            $article->category;
            $article->user;
        });

        $contact = Contact::first();

    	return view('front.news')->with('articles', $articles)->with('contact', $contact);
    }

    public function showArticle($id)
    {
        $article = Article::find($id);

        $contact = Contact::first();

        return view('front.article')->with('article', $article)->with('contact', $contact);
    }

    public function addCommentToArticle(CommentCreateRequest $request)
    {
        $responseCode = 0;

        if($request->article_id)
        {
            if($article = Article::find($request->article_id))
            {
                $comment = new Comment();
                $comment->name = $request->name;
                $comment->email = $request->email;
                $comment->content = $request->content;
                $comment->article_id = $article->id;
                $comment->article()->associate($article);

                if($comment->save())
                {
                    $responseCode = 1;
                }
            }
            else
            {
                $responseCode = -1;
            }
        }

        return $responseCode;
    }

    public function contact()
    {
        $contacts = Contact::orderBy('id', 'ASC')->get();

        $contact = Contact::first();

    	return view('front.contact')->with('contacts', $contacts)->with('contact', $contact);
    }

    public function sendEmail(ContactSendmailRequest $request)
    {
        $responseCode = 0;

        if($request->id)
        {
            if($contact = Contact::findOrFail($request->id))
            {
                /*
                $contact = new Contact();
                $values = [
                            'name'  =>  'Contacto pyramIT',
                            'subname'   =>  'Ingenieria Informatica',
                            'email' =>  'contacto@pyramit.cl',
                            'phone' =>  '+12345678',
                            'facebook'  =>  'fb.com',
                            'twitter'   =>  'tw.com'
                ];

                $contact->fill($values);
                */

                $subject = 'Tienes un nuevo mensaje de ' . $request->name;

                Mail::send(
                            'front.email',
                            array(
                                    'name'      =>  $request->name,
                                    'email'     =>  $request->email,
                                    'phone'     =>  $request->phone,
                                    'date'      =>  $date = Carbon::now()->format('d-m-Y') . ' a las ' . Carbon::now()->format('h:i:s'),
                                    'comment'   =>  $request->comment
                            ),
                            function($message) use ($date, $contact, $subject)
                            {
                                $message->to(
                                                $contact->email,
                                                $contact->name
                                )->subject($subject);
                            }
                );

                $responseCode = 1;
            }
        }
        else
        {
            $responseCode = -1;
        }

        return $responseCode;
    }

    public function downloadZipAlbum(Request $request)
    {
        $id = $request->id;

        $path = 'front/upload/albums';

        $status = 0;
        $file_zip = '';

        //Remove all previous ZIP files
        {
            $files_zip = glob($path . '/*.zip');
            foreach($files_zip as $file_zip)
            {
                if(file_exists($file_zip))
                {
                    unlink($file_zip);
                }

            }
        }

        //Generate new ZIP file
        {
            $files_jpg = glob($path . '/albumsCeitpp_' . $id . '*.jpg');

            $file_zip = $id . '_' . time() . rand(10,1000) . '.zip';

            $zipper = new Zipper();
            $zipper->make($path . '/' . $file_zip);
            $zipper->add($files_jpg);
            $zipper->close();

            $status = 1;
        }


        echo $file_zip;
    }


    public function admin()
    {
        //COUNTERS
        {
            $counters = [
                            'articles'        =>  Article::all()->count(),
                            'documents'          =>  Document::all()->count(),
                            'albums'    =>  Album::all()->where('id', '<>', '1')->count(),
                            'wells'       =>  Well::all()->count()
            ];
        }

        return view('admin.index')->with('counters', $counters);
    }
}
