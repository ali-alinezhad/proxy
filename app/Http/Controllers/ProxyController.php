<?php


namespace App\Http\Controllers;


use App\Services\ProxyService;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proxyService = new ProxyService($request->get('include'));

        return Response($proxyService->makeResult());
    }
}
