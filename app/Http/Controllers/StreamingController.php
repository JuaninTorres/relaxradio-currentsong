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
        $title = $this->getTitle();
        $locutor = $this->getLocutor();

        return compact('title', 'locutor');
    }

    /**
     * Obtención del titulo de la canción
     *
     * @return string
     */
    protected function getTitle()
    {
        $response = $this->client->request('GET', config('streaming.uri'));
        $title = $response->getBody()->getContents();

        return $title;
    }

    /**
     * Obtención del nombre del Locutor, que por mientras está fijo
     *
     * @return string
     */
    protected function getLocutor()
    {
        return "RELAX AUTO DJ";
    }
}
