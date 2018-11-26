<?php

namespace App\Libraries;

use GuzzleHttp\Client;

class ImageUploader
{
    static public function save($path){

        $image_path = $path->getPathname();
        $image_mime = $path->getmimeType();
        $image_org = $path->getClientOriginalName();

        $client = new Client();

        $response = $client->post(env('WHFIMG_API_URL', 'http://whf-api.test/image'), [
            'multipart' => [
                [
                    'name' => 'image',
                    'filename' => $image_org,
                    'Mime-Type' => $image_mime,
                    'contents' => fopen($image_path, 'r'),  
                ]
            ]
        ]);

        $uploadedImage = json_decode($response->getBody()->getContents())->uploaded_image_url;
        
        return $uploadedImage;
    }
}
