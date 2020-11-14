<?php


namespace App\Services;

use Bigcommerce\Api\Client;

class BigcommerceService extends Client
{
    /**
     * Return a customer list and their order count
     *
     * @return array
     */
    public static function getCustomersWithOrdersCount(): array
    {
        $data = [];
        $customers = self::getCustomers();
        $orders = self::getOrders();
        if ($customers){
            foreach ($customers as $customer){
                $data[$customer->id] = [
                    'customer' => $customer,
                    'count' => 0
                ];
            }
        }
        if ($orders){
            foreach ($orders as $order){
                if (array_key_exists($order->customer_id, $data)) $data[$order->customer_id]['count']++;
            }
        }
        return $data;
    }

    /**
     * Return orders with products count by customer ID
     *
     * @param array $orders
     * @return array
     */
    public static function getOrdersWithProductsCount($orders): array
    {
        $ordersData = [];
        if ($orders){
            foreach ($orders as $o){
                $productsCount = self::getOrderProductsCount($o->id);
                $ordersData[] = [
                    'order' => $o,
                    'productsCount' => $productsCount
                ];
            }
        }
        return $ordersData;
    }


    /**
     * Return life time value of a customer by his orders
     *
     * @param $orders
     * @return int
     */
    public static function getLifeTimeValue($orders): int
    {
        $lifeTimeValue = 0;
        if ($orders){
            foreach ($orders as $o){
                $lifeTimeValue += $o->total_ex_tax;
            }
        }
        return $lifeTimeValue;
    }

}