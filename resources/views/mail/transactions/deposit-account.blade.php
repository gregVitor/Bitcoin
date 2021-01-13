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
            <p style="color: #000;">Depósito no valor de  <strong>R$ {{depositAmount}} </strong> realizado com sucesso.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color: #000;">Depósito realizado em {{date('d/m/Y', strtotime($createdAt))}} as {{date('H:i', strtotime($createdAt))}} </p>
        </td>
    </tr>

@endsection
