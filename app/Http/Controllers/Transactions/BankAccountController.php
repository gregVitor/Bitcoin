<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\BankAccountRepository;
use App\Services\Transactions\BankAccountService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * @var BankAccountService
     */
    private $bankAccountService;

    /**
     * Class constructor method.
     *
     * @param BankAccountRepository $bankAccountRepository
     */
    public function __construct(
        BankAccountRepository $bankAccountRepository,
        BankAccountService    $bankAccountService
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankAccountService    = $bankAccountService;
    }

    /**
     * Function create deposit
     *
     * @param Request $request
     *
     * @return void
     */
    public function createAccountDeposit(Request $request)
    {
        try {

            //Validator
            $this->validate($request, [
                'amount' => 'required|numeric|not_in:0|min:0'
            ]);

            $balance = $this->bankAccountService->createAccountDeposit($request->user, $request->amount);

            return apiResponse("Valor depositado em conta.", 200, $balance);

        } catch (\Exception $e) {
            throw ($e);
        }
    }
}
