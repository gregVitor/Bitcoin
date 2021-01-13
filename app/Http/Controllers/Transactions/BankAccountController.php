<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\BankAccountRepository;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * Class constructor method.
     *
     * @param BankAccountRepository $bankAccountRepository
     */
    public function __construct(
        BankAccountRepository $bankAccountRepository
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
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

            $balance = $this->bankAccountRepository->createAccountDeposit($request->user->id, $request->amount);

            return apiResponse("Valor depositado em conta.", 200, $balance);

        } catch (\Exception $e) {
            throw ($e);
        }
    }
}
