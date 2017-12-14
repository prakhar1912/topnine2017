<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use phpseclib\Crypt\RSA;
use phpseclib\Net\SSH2;
use File;

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

        $data = array();
        $total_likes = 0;
        $posts = 0;
        $images = array();

        $max_id = 0;
        $new_images = true;

        do{
            if($max_id == 0){
                $response = $client->get('https://api.instagram.com/v1/users/self/media/recent/?access_token='.$access_token.'&amp;count=1000');
            } else {
                $response = $client->get('https://api.instagram.com/v1/users/self/media/recent/?access_token='.$access_token.'&amp;max_id='.$max_id.'&amp;count=1000');
            }

            $body = $response->getBody()->getContents();
            $content = json_decode($body,true);
            $images = $content['data'];

            if(empty($images)){
                $new_images = false;
            } else{
                foreach($images as $image){
                    $year = Carbon::parse(date('M j, Y', $image['created_time']))->year;
                    $likes = $image['likes']['count'];

                    if($year == 2017){
                        $data[$image['images']['standard_resolution']['url']] = $likes;
                        $total_likes += $likes;
                        $posts +=1;
                    }
                }
                $max_id = end($images)['id'];
            }
        }while($new_images);
        
        arsort($data);

        $top_nine = array_slice($data, 0, 9);

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

    public function logout(Request $request){
        $username = $request['username'];
        $delete1 = File::delete('images/insta/2017topnine_'.$username.'_original.jpeg');
        $delete2 = File::delete('images/insta/2017topnine_'.$username.'_photo.jpeg');
        return [$delete1,$delete2];
    }

    public function cronFunction(){
        $current_time = Carbon::now();
        $files = File::allFiles('images/insta');
        foreach ($files as $file)
        {
            $timestamp = Carbon::createFromTimestamp(File::lastModified($file));
            $difference = $current_time->diffInHours($timestamp);
            if($difference!=0){
                File::delete($file);
            }
        }
    }
}
