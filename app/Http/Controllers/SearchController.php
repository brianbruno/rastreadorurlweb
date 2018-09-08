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

    public function index() {
        $visitas = $this->contarVisitas();
        $view = view('dashboard', ['resultados' => true, 'visitas' => $visitas]);
        return $view;
    }

    public function buscar($request) {
        $url = $request->input('inputURL');
        $visitas = $this->contarVisitas();
        $view = view('dashboard', ['resultados' => false, 'visitas' => $visitas]);

        if (isset($url)) {
            $resultado = $this->buscarURL($url);
            if (!empty($resultado))
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
        $registro = DB::table('links')->distinct()
            ->select('links.ID', 'links.URL')
            ->whereRaw('links.URL LIKE "%'.$url.'%"')
            ->get();

        if (sizeof($registro) > 0)
            return $registro;
        else
            return null;
    }

    public function buscarOrigem($id) {
        $array = array();

        $ocorrencias = DB::table('url')->distinct()
            ->select('url.ID')
            ->where('url.URL', $id)
            ->get();

        foreach ($ocorrencias as $ocorrencia) {

            $id_origem = $ocorrencia->ID;
            $info = array();

            while ($id_origem != null) {
                $origem = DB::table('url')->distinct()
                    ->select('url.ID', 'links.URL', 'url.ID_ORIGEM')
                    ->join('links', 'url.URL', '=', 'links.ID')
                    ->where('url.ID', $id_origem)
                    ->get();

                $id_origem = $origem[0]->ID_ORIGEM;
                $info[] = $origem[0]->URL;
            }

            $array[] = array_reverse($info);
        }

        return $array;
    }

}
