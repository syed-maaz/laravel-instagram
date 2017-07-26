<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramController extends Controller
{
    /**
     * Get username from request URL and return Instagram posts 
     *
     * @return string
    */
    public function index(Request $request)
    {
    	$instaPosts = [];

    	if($request->has('username')){

        // GuzzleHttp is used here to make Http call 
	       $client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

	       $url = sprintf('https://www.instagram.com/%s/media', $request->input('username'));
        
           $response = $client->get($url);

           $instaPosts = json_decode((string) $response->getBody(), true);//['items'];

            return response()->json($instaPosts);
    	}

    	
    }
}