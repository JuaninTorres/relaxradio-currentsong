<?php

namespace App\Http\Controllers;

class StreamingController extends Controller
{

    protected $baseuri;
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseuri = 'http://' .
            config('streaming.host') .
            ':' . config('streaming.port');
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->baseuri,
            'timeout' => 5
        ]);
    }

    public function show()
    {
        $response = $this->client->request('GET', config('streaming.uri'));
        $title = $response->getBody()->getContents();
        $locutor = "RELAX AUTO DJ";

        return compact('title', 'locutor');
    }
}
