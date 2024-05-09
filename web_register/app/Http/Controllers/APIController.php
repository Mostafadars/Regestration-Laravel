<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getActors(Request $request)
    {
        // Get the birthdate from the request
        $birthdate = $request->input('birthdate');

        // Extract the day and month from the birthdate
        $day = substr($birthdate, 8, 2);
        $month = substr($birthdate, 5, 2);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb188.p.rapidapi.com/api/v1/getBornOn?month=$month&day=$day",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: imdb188.p.rapidapi.com",
                "X-RapidAPI-Key: 440cc6e791msh9ceca145473f00ep11b594jsn90a08e3e36a6"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $actors_string = '';

        if ($err) {
            return response()->json("cURL Error #:" . $err, 500);
        } else {
            $data = json_decode($response, true);

        // Check if decoding was successful
            if ($data !== null) {
                // Check if the 'data' key exists and contains 'list' key
                if (isset($data['data']['list']) && is_array($data['data']['list'])) {
                    // Iterate over each actor in the list
                    $i = 1;
                    foreach ($data['data']['list'] as $actor) {
                        // Access and print the name of each actor
                        $actors_string .= $i . ". " . $actor['nameText']['text'] . " ";
                        if ($i == 5) {
                            break;
                        }
                        $i++;
                    }
                } else {
                    return response()->json("Invalid JSON structure. 'data' or 'list' key not found", 500);
                }
            }
        }

        return response()->json($actors_string);
    }
}

