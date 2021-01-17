<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->post('register', 'Auth\AuthController@registerUser');

    $router->post('login', 'Auth\AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->group(['prefix' => 'account'], function () use ($router) {
            $router->post('deposit', 'Transactions\BankAccountController@createAccountDeposit');
            $router->get('balance', 'Transactions\BankAccountController@getBalance');
            $router->get('extract', 'Transactions\BankAccountController@getExtract');
        });

        $router->group(['prefix' => 'btc'], function () use ($router) {
            $router->get('price', 'Bitcoin\BitcoinController@getPrice');
            $router->get('historic', 'Bitcoin\BitcoinController@getHistoricBitcoinPrice');
        });

        $router->group(['prefix' => 'investment'], function () use ($router) {
            $router->post('purchase', 'Transactions\InvestmentController@createPurchase');
            $router->post('sell', 'Transactions\InvestmentController@createSellInvestment');
            $router->get('position', 'Transactions\InvestmentController@getInvestmentsPositions');
            $router->get('volume', 'Transactions\InvestmentController@getMovements');

        });
    });

});
