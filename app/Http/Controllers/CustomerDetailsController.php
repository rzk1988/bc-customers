<?php

namespace App\Http\Controllers;

use App\Services\BigcommerceService;
use Illuminate\Routing\Controller as BaseController;

class CustomerDetailsController extends BaseController
{
    protected $bigcommerceService;

    public function __construct(BigcommerceService $bigcommerceService)
    {
        $this->bigcommerceService = $bigcommerceService;
    }

    /**
     * Customer page with order history and life time value
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customer = $this->bigcommerceService::getCustomer($id);
        $orders = $this->bigcommerceService::getOrders(['customer_id' => $id]);
        $ordersData = $this->bigcommerceService->getOrdersWithProductsCount($orders);
        $lifeTimeValue = $this->bigcommerceService->getLifeTimeValue($orders);

        return view('details', [
            'customer' => $customer,
            'orders' => $ordersData,
            'lifeTimeValue' => $lifeTimeValue,
        ]);
    }
}
