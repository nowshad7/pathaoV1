<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function find($id): ?Order
    {
        return Order::find($id);
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): Order
    {
        $order->update($data);
        return $order;
    }

    public function cancel(Order $order): void
    {
        $order->status = Order::STATUS_CANCELLED;
        $order->save();
    }

    public function getOrdersByCustomerId(int $customerId)
    {
        return Order::where('created_by', $customerId)->where('status', Order::STATUS_ACTIVE)->paginate(10);
    }
}
