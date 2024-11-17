<?php

namespace App\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function find($id): ?Order;
    public function create(array $data): Order;
    public function update(Order $order, array $data): Order;
    public function cancel(Order $order): void;

    public function getOrdersByCustomerId(int $customerId);
}
