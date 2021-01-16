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
        InvestmentService   $investmentService,
        InvestmentValidator $investmentValidator
    ) {
        $this->investmentService   = $investmentService;
        $this->investmentValidator = $investmentValidator;
    }

    /**
     * Function create purchase
     *
     * @param Request $request
     *
     * @return array
     */
    public function createPurchase(Request $request)
    {
        $this->investmentValidator->validateCreatePurchase($request->all());

        $values = (object) [];

        if (isset($request->amount)) {
            $values->amount = $request->amount;
        }
        if (isset($request->units)) {
            $values->units = $request->units;
        }

        $investement = $this->investmentService->createPurchase($request->user, $values);

        return apiResponse("Valor investido.", 200, $investement);
    }

    /**
     * Function getInvestments
     *
     * @param Request $request
     *
     * @return array
     */
    public function getInvestmentsPositions(Request $request)
    {
        try {
            $investments = $this->investmentService->getInvestmentsPositions($request->user->id);

            return apiResponse("Ok.", 200, $investments);
        } catch (\Exception $e) {
            throw ($e);
        }
    }

    /**
     * Function sell investment
     *
     * @param Request $request
     *
     * @return array
     */
    public function createSellInvestment(Request $request)
    {
        $this->investmentValidator->validateCreateSellInvestment($request->all());

        $sell = $this->investmentService->sellBitcoin($request->user, $request->amount);

        return apiResponse("Ok.", 200, $sell);
    }
}
