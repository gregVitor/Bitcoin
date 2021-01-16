<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\BankAccountRepository;
use App\Services\Transactions\BankAccountService;
use App\Validators\BankAccountValidator;
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
     * @var BankAccountValidator
     */
    private $bankAccountValidator;

    /**
     * Class constructor method.
     *
     * @param BankAccountRepository $bankAccountRepository
     * @param BankAccountService $bankAccountService
     * @param BankAccountValidator $bankAccountValidator
     */
    public function __construct(
        BankAccountRepository $bankAccountRepository,
        BankAccountService    $bankAccountService,
        BankAccountValidator  $bankAccountValidator
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankAccountService    = $bankAccountService;
        $this->bankAccountValidator  = $bankAccountValidator;
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

            $this->bankAccountValidator->createAccountDeposit($request->all());

            $balance = $this->bankAccountService->createAccountDeposit($request->user, $request->amount);

            return apiResponse("Valor depositado em conta.", 200, $balance);

        } catch (\Exception $e) {
            throw ($e);
        }
    }

    /**
     * Function get user account balance
     *
     * @param Request $request
     *
     * @return void
     */
    public function getBalance(Request $request)
    {
        try {
            $balance = $this->bankAccountRepository->getBalance($request->user->id);

            $data = [
                'balance' => $balance
            ];

            return apiResponse("Ok.", 200, $data);
        } catch (\Exception $e) {
            throw ($e);
        }

    }
}
