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
            <p style="color: #000;">Investimento em bitcoin no valor de  <strong>R$ {{investmentAmount}} </strong> realizado com sucesso.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Quantidade de Bitcoins adiquirida <strong>$BTC {{purchasedAmount}} </strong></p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Investimento realizado em {{date('d/m/Y', strtotime($createdAt))}} as {{date('H:i', strtotime($createdAt))}} </p>
        </td>
    </tr>

@endsection
