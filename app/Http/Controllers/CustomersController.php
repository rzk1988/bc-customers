<?php

namespace App\Http\Controllers;

use Bigcommerce\Api\Client as Bigcommerce;
use Illuminate\Routing\Controller as BaseController;

class CustomersController extends BaseController
{
    public function index()
    {
        $data = [];
        $customers = Bigcommerce::getCustomers();
        if ($customers){
            foreach ($customers as $customer){
                $count = Bigcommerce::getOrdersCount(['customer_id' => $customer->id]);
                $data[] = [
                    'customer' => $customer,
                    'count' => $count
                ];
            }
        }
        return view('customers', [
            'data' => $data
        ]);
    }
}
