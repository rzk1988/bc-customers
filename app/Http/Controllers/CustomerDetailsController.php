<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Bigcommerce\Api\Client as Bigcommerce;

class CustomerDetailsController extends BaseController
{
    public function show($id)
    {
        $customers = Bigcommerce::getCustomer($id);

        $orders = Bigcommerce::getOrders(['customer_id' => $id]);

        $lifeTimeValue = 0;
        $ordersData = [];
        if ($orders){
            foreach ($orders as $o){
                $productsCount = Bigcommerce::getOrderProductsCount($o->id);
                $ordersData[] = [
                    'order' => $o,
                    'productsCount' => $productsCount
                ];
                $lifeTimeValue += $o->total_inc_tax;
            }
        }

        return view('details', [
            'customer' => $customers,
            'orders' => $ordersData,
            'lifeTimeValue' => $lifeTimeValue,
        ]);
    }
}
