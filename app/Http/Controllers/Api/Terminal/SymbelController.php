<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Terminal\SymbelRepository;
use App\Helpers\ExceptionHandlerHelper;

class SymbelController extends Controller
{
    protected $symbelRepository;

    public function __construct(SymbelRepository $SymbelRepository)
    {
        $this->symbelRepository = $SymbelRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($request){
            $symbel = $this->symbelRepository->getAllSymbels($request);
            return $this->sendResponse($symbel, 'All Symbels');
        });
        
    }
}