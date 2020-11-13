<?php

namespace App\Http\Controllers;

use App\Services\BigcommerceService;
use Illuminate\Routing\Controller as BaseController;

class CustomersController extends BaseController
{
    protected $bigcommerceService;

    public function __construct(BigcommerceService $bigcommerceService)
    {
        $this->bigcommerceService = $bigcommerceService;
    }

    public function index()
    {
        $data = [];
        $customers = $this->bigcommerceService->getCustomers();
        if ($customers){
            foreach ($customers as $customer){
                $count = $this->bigcommerceService->getOrdersCount(['customer_id' => $customer->id]);
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
