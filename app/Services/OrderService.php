<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderService
{


    protected $orderRepositoryInterface;

    public function __construct(
        OrderRepositoryInterface $orderRepositoryInterface
    ){
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function createOrder(Request $request)
    {
        $orderData = [
            'merchant_order_id' => $request->input('merchant_order_id'),
            'recipient_name' => $request->input('recipient_name'),
            'recipient_phone' => $request->input('recipient_phone'),
            'recipient_address' => $request->input('recipient_address'),
            'item_quantity' => $request->input('item_quantity'),
            'item_weight' => $request->input('item_weight'),
            'amount_to_collect' => $request->input('amount_to_collect'),
            'item_descriptions' => $request->input('item_descriptions'),
            'created_by' => auth()->user()->id,
        ];
        return $this->orderRepositoryInterface->create($orderData);
    }

    public function getCustomerOrders()
    {
        $customerId = auth()->user()->id;
        return $this->orderRepositoryInterface->getOrdersByCustomerId($customerId);
    }

    public function orderCancel(int $orderId)
    {
        $order = $this->orderRepositoryInterface->find($orderId);
        $this->orderRepositoryInterface->cancel($order);
    }
}
