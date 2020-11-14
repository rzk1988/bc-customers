<?php

namespace App\Http\Controllers;

use App\Services\BigcommerceService;
use Illuminate\Routing\Controller as BaseController;

class CustomersController extends BaseController
{
    /**
     * Index page with a customer list with their order count
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('customers', [
            'data' => BigcommerceService::getCustomersWithOrdersCount()
        ]);
    }
}
