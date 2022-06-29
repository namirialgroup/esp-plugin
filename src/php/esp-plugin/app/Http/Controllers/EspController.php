<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class EspController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @return View
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Show the profile for a given user.
     *
     * @return View
     */
    public function key(): View
    {
        $url = config('esp.host'). '/api/secure/'
            . config('esp.environment_name') . '/getkey';
        $authnKey = Http
            ::withoutVerifying()
            ->withHeaders([
            "Esp-Api-Key" => config('esp.api_key')
        ])->get($url,[
            "attributes" => config('esp.attributes'),
            "level" => config('esp.level')
        ]);
        return view('key',[
            'loginUrl' => config('esp.host'). '/'
                . config('esp.environment_name') . '/spidlogin'
                . '?authnKey=' . $authnKey
                . '&final=' . config('esp.final'),
            'authnKeyProps' => $this->decode_jwt($authnKey)
        ]);
    }

    /**
     * Show the profile for a given user.
     *
     * @param Request $request
     * @return View
     */
    public function user(Request $request): View
    {
        $id = $request->query("sessionid");
        $key = $request->query("sessionkey");

        $url = config('esp.host'). '/api/secure/'
            . config('esp.environment_name') . '/getuser';

        $userJwt = Http::withoutVerifying()->withHeaders([
            "Esp-Api-Key" => config('esp.api_key')
        ])->get($url,[
            "ID" => $id,
            "key" => $key
        ]);
        return view('user',[
            'userJwt' => $this->decode_jwt($userJwt)
        ]);
    }

    private function decode_jwt($jwt)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));
    }
}
