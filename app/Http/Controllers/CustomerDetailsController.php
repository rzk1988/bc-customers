<?php

namespace App\Http\Controllers;

use App\Services\BigcommerceService;
use Illuminate\Routing\Controller as BaseController;

class CustomerDetailsController extends BaseController
{

    /**
     * Customer page with order history and life time value
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customer = BigcommerceService::getCustomer($id);
        $orders = BigcommerceService::getOrders(['customer_id' => $id]);
        $ordersData = BigcommerceService::getOrdersWithProductsCount($orders);
        $lifeTimeValue = BigcommerceService::getLifeTimeValue($orders);

        return view('details', [
            'customer' => $customer,
            'orders' => $ordersData,
            'lifeTimeValue' => $lifeTimeValue,
        ]);
    }
}
