<?php

namespace App\Http\Controllers;

use App\Services\BigcommerceService;
use Illuminate\Routing\Controller as BaseController;
use Bigcommerce\Api\Client as Bigcommerce;

class CustomerDetailsController extends BaseController
{
    protected $bigcommerceService;

    public function __construct(BigcommerceService $bigcommerceService)
    {
        $this->bigcommerceService = $bigcommerceService;
    }

    public function show($id)
    {
        $customers = $this->bigcommerceService->getCustomer($id);

        $orders = $this->bigcommerceService->getOrders(['customer_id' => $id]);

        $lifeTimeValue = 0;
        $ordersData = [];
        if ($orders){
            foreach ($orders as $o){
                $productsCount = $this->bigcommerceService->getOrderProductsCount($o->id);
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
