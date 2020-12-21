<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Http\Requests\ConfigurationContactEditRequest;
use App\Http\Requests\ConfigurationLogoEditRequest;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $contact = Contact::first();

        return view('admin.configuration.contact')->with('contact', $contact);
    }

    public function updateContact(ConfigurationContactEditRequest $request, $id)
    {
        $responseCode = 0;

        if($contact = Contact::find($id))
        {
            $contact->fill($request->all());

            if($contact->save())
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

    public function logos()
    {
        return view('admin..configuration.logos');
    }

    public function updateLogo(ConfigurationLogoEditRequest $request)
    {
        $responseCode = 0;

        if($request->id >= 0)
        {
            if(($request->id >= 0) && ($request->id <= 2))
            {
                $name = '';
                $filename = '';

                switch($request->id)
                {
                    case 0:
                    {
                        //GORE
                        $filename = 'logo_gore.png';
                        $name = 'Gobierno Regional (GORE)';

                        break;
                    }

                    case 1:
                    {
                        //CORE
                        $filename = 'logo_core.png';
                        $name = 'Consejo Regional (CORE)';

                        break;
                    }

                    case 2:
                    {
                        //IMP
                        $filename = 'logo_imp.png';
                        $name = 'Ilustre Municipalidad de Pica';

                        break;
                    }

                    default:
                    {

                        break;
                    }
                }

                if(strlen($filename) > 0)
                {
                    $path = public_path() . '/front/img/logos/' . $filename;

                    $file = preg_replace('/data:image\/[A-z]+;base64,/', '', $request->image_data);
                    $img = str_replace(' ', '+', $file);
                    $data = base64_decode($img);

                    if(file_put_contents($path, $data))
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
                $responseCode = 0;
            }

        }
        else
        {
            $responseCode = -1;
        }


        return $responseCode;
    }
}
