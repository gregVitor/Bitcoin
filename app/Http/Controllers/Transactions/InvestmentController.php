<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\InvestmentService;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * @var InvestmentService
     */
    private $investmentService;

    public function __construct(
        InvestmentService $investmentService
    ) {
        $this->investmentService = $investmentService;
    }

    /**
     * Function create purchase
     *
     * @param Request $request
     *
     * @return void
     */
    public function createPurchase(Request $request)
    {
        //Validator
        $values = $this->validate($request, [
            'amount' => (!isset($request['units']) ? 'required|' : '') . '|numeric|not_in:0|min:0',
            'units'  => (!isset($request['amount']) ? 'required|' : '') . '|numeric|not_in:0|min:0'
        ]);

        if (isset($values['amount']) && isset($values['units'])) {
            abort(400, "Requisição inválida");
        }

        $investement = $this->investmentService->createPurchase($request->user, $values);

        return apiResponse("Valor investido.", 200, $investement);
    }
}
