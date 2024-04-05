<?php

namespace App\Http\Controllers\Api\Terminal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Terminal\SymbelInterface;
use App\Helpers\ExceptionHandlerHelper;

class SymbelController extends Controller
{
    protected $symbelRepository;

    public function __construct(SymbelInterface $SymbelRepository)
    {
        $this->symbelRepository = $SymbelRepository;
    }

    // TODO: Get all symbel Groups with symbel settings for the terminal.
    public function index()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $symbel = $this->symbelRepository->getAllSymbels();
            return $this->sendResponse($symbel, 'All Symbels');
        });

    }
}
