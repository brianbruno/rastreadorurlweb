<?php
/**
 * Created by IntelliJ IDEA.
 * User: brian
 * Date: 07/09/2018
 * Time: 14:24
 */

namespace App\Http\Controllers;

use App\Url;

class InsertController extends Controller {

    public function index() {
        $view = view('inserir');
        return $view;
    }

    public function inserir($request) {
        $result = false;
        try {
            $url = $request->input('inputURL');
            $data = array(
                "URL" => $url,
                "ID_ORIGEM" => null
            );
            if (Url::insert($data))
                $result = true;
        } catch (\Exception $exception) {
            $result = false;
        }
        return view('inserir', ["resultado" => $result]);
    }
}
