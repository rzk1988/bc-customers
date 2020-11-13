@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th># of Orders</th>
            </tr>
        </thead>
            <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>
                        <a href="{{ action('CustomerDetailsController@show', ['id' => $d['customer']->id]) }}">
                            {{ $d['customer']->first_name }}  {{ $d['customer']->last_name }}
                        </a>
                    </td>
                    <td>{{ $d['count'] }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
@endsection
