@extends('layouts.app')

@section('title', $customer->first_name . "'s Order History")

@section('content')
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th># of Products</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $o)
            <tr>
                <td>{{ $o['order']->date_created }}</td>
                <td>{{ $o['productsCount'] }}</td>
                <td>${{ $o['order']->total_ex_tax }}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="2">Lifetime Value</td>
                <td>${{ $lifeTimeValue }}</td>
            </tr>
        </tbody>
    </table>
@endsection
