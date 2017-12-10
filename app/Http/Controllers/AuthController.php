<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use phpseclib\Crypt\RSA;
use phpseclib\Net\SSH2;

class AuthController extends Controller
{
    
	public function getUserInfo($code){
		$client = new GuzzleHttp\Client();
    	$response = $client->post('https://api.instagram.com/oauth/access_token', [
		    'form_params' => [
		        'client_id' => env('CLIENT-ID'),
			    'client_secret' => env('CLIENT-SECRET'), 
			    'grant_type'=> 'authorization_code',
			    'redirect_uri' => env('REDIRECT-URI'),
			    'code' => $code
		    ]
		]);

		$body = $response->getBody()->getContents();
		$body = json_decode($body,true);

        $user_info['code'] = $code;
        $user_info['username'] = $body['user']['username'];
        $user_info['profile_picture'] = $body['user']['profile_picture'];
        $user_info['access_token'] = $body['access_token'];

    	return $user_info;
	}

    public function getTopNine($code){
        $user_info = $this->getUserInfo($code);

        $access_token = $user_info['access_token'];

        $client = new GuzzleHttp\Client();
        $response = $client->get('https://api.instagram.com/v1/users/self/media/recent/?access_token='.$access_token);
        
        $body = $response->getBody()->getContents();
        $content = json_decode($body,true);
        $images = $content['data'];

        $data = array();
        $total_likes = 0;
        $posts = 0;


        foreach($images as $image){
            $year = Carbon::parse(date('M j, Y', $image['created_time']))->year;
            $likes = $image['likes']['count'];

            if($year == 2017){
                $data[$image['images']['standard_resolution']['url']] = $likes;
                $total_likes += $likes;
                $posts +=1;
            }
        }
        
        arsort($data);

        $top_nine = array_slice($data, 0, 8);

        $user_info['top_nine'] = array_keys($top_nine);
        $user_info['total_posts'] = $posts;
        $user_info['total_likes'] = $total_likes;

        return $user_info;
    }

    public function landing(Request $request){
        $code = $request['code'];

        try{
        	$user_info = $this->getTopNine($code);
        	$user_info['top_nine'] = json_encode($user_info['top_nine']);

        	return view('landing')->with('user_info',$user_info);
        } catch(RequestException $e){
		    $message = 'Something went wrong. Please login again.';
		    return redirect('/')->with('message',$message);
    	}
    }

    public function generateImage(Request $request){

    	$username = $request['username'];
        $profile_picture = $request['profile_picture'];
        $total_posts = $request['posts'];
        $total_likes = $request['likes'];
        $top_nine = $request['top_nine'];
        $posts = "";

        foreach ($top_nine as $post) {
            $posts = $posts." ".$post;
        }

        $script_path = __DIR__."/../../../";

        $command = "python {$script_path}generate_image.py {$username} {$profile_picture} {$total_posts} ${total_likes} {$posts}";

        $result = exec($command);

        return $result;
    }

}