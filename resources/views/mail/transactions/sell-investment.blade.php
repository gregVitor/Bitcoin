@extends('email.layout')

@section('title', 'Page Title')

@section('content')

    <tr>
        <td>
            <h2>Olá, {{$name}}</h2>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Você resgatou  <strong>R$ {{amountRescued}} </strong>.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Quantidate de Bitcoins vendida de  <strong>$BTC {{quantityBitcoinSell}} </strong>.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Resgate realizado em {{date('d/m/Y', strtotime($date))}} as {{date('H:i', strtotime($date))}} </p>
        </td>
    </tr>

@endsection
