<?php

// app/Http/Controllers/ApiController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function fetchDataFromJendelatani()
    {
        $url = "https://jendelatani.tech/apitest";
        $data = file_get_contents($url);
        $data = json_decode($data, true);

        return view('welcome', ['data' => $data]);
    }

    public function fetchProvinces()
    {
        $apiKey = 'e049d10db2bd7fc4d5ec3cb4035633be';
        $provinceEndpoint = 'https://api.rajaongkir.com/starter/province';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $provinceEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'key: ' . $apiKey,
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json(['error' => 'Failed to fetch provinces from RajaOngkir API.']);
        }

        curl_close($curl);

        $provinces = json_decode($response, true);

        return view('welcome', ['provinces' => $provinces]);
    }

    public function fetchCities(Request $request)
    {
        $apiKey = 'e049d10db2bd7fc4d5ec3cb4035633be';

        if ($request->has('province')) {
            $selectedProvinceId = $request->input('province');
            $cityEndpoint = 'https://api.rajaongkir.com/starter/city?province=' . $selectedProvinceId;

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $cityEndpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'key: ' . $apiKey,
                ],
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                return response()->json(['error' => 'Failed to fetch cities from RajaOngkir API.']);
            }

            curl_close($curl);

            $cities = json_decode($response, true);

            return view('welcome', ['cities' => $cities]);
        }

        return response()->json(['error' => 'Province parameter is required.']);
    }
}
