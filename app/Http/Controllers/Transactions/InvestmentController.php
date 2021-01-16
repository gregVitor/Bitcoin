<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\InvestmentService;
use App\Validators\InvestmentValidator;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * @var InvestmentService
     */
    private $investmentService;

    /**
     * @var InvestmentValidator
     */
    private $investmentValidator;

    public function __construct(
        InvestmentService $investmentService,
        InvestmentValidator $investmentValidator
    ) {
        $this->investmentService = $investmentService;
        $this->investmentValidator = $investmentValidator;
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
        $this->investmentValidator->createPurchase($request->all());

        $values = (object)[];

        if(isset($request->amount)){
            $values->amount = $request->amount;
        }
        if(isset($request->units)){
            $values->units = $request->units;
        }

        $investement = $this->investmentService->createPurchase($request->user, $values);

        return apiResponse("Valor investido.", 200, $investement);
    }
}
