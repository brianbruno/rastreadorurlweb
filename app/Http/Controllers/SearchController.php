<?php
/**
 * Created by IntelliJ IDEA.
 * User: brian
 * Date: 24/06/2018
 * Time: 10:43
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SearchController extends Controller {

    public function index($request) {
        $url = $request->input('inputURL');
        $view = view('dashboard');

        if (isset($url)) {
            $resultado = $this->buscarURL($url);
            if (sizeof($resultado) > 0)
                $view = view('busca', ['resultados' => $resultado->jsonSerialize()]);
        }
        return $view;
    }

    public function contarVisitas() {
        $registro = DB::table('visitas')
            ->select(DB::raw('count(ID) as visitas'))
            ->get();
        return $registro[0]->visitas;
    }

    public function buscarURL($url) {
        $registro = DB::table('url')
            ->select('ID', 'URL', 'ID_ORIGEM')
            ->whereRaw('URL LIKE "%'.$url.'%"')
            ->get();

        if (sizeof($registro) > 0)
            return $registro;
        else
            return null;
    }

    public function buscarOrigem($id) {
        $array = array();
        $id_origem = $id;

        while ($id_origem != null) {
            $origem = DB::table('url')
                ->select('ID', 'URL', 'ID_ORIGEM')
                ->where('ID', $id_origem)
                ->get();
            $id_origem = $origem[0]->ID_ORIGEM;
            $array[] = $origem[0]->URL;
        }

        return $array;
    }

}
