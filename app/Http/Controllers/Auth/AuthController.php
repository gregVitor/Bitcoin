<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class AuthController extends Controller
{

     /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Class constructor method.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Function create user
     *
     * @param  Request  $request
     * @return Response
     */
    public function registerUser(Request $request)
    {
        try {

            //Validator
            $this->validate($request, [
                'name'     => 'required|string',
                'email'    => 'required|email|unique:users',
                'password' => 'required|string'
            ]);

            $user = $this->userRepository->registerUser($request);

            $returnData = [
                'id' => hashEncodeId($user->id),
                'email' => $user->email,
                'name' => $user->name
            ];

            return apiResponse("Usuário cadastrado com sucesso", 200, $returnData);
        } catch (\Exception $e) {
            throw ($e);
        }

    }

}
