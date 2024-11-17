<?php

namespace App\Http\Controllers\Api;

use App\Common\ResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OrderCancelRequest;
use App\Http\Requests\Api\User\OrderCreateRequest;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $userService;
    protected $orderService;
    protected $responseClass;

    public function __construct(
        UserService $userService,
        OrderService $orderService,
        ResponseClass $responseClass
    ){
        $this->userService = $userService;
        $this->responseClass = $responseClass;
        $this->orderService = $orderService;
    }

    public function create(OrderCreateRequest $request)
    {
        try {
            $order = $this->orderService->createOrder($request);
            return $this->responseClass->apiResponse(200, "Order Created Successfully", null, $order);
        } catch(\Exception $e){
            return $this->responseClass->apiResponse(500, 'Something Went Wrong', $e->getMessage());
        }
    }

    public function getOrders(Request $request)
    {
        try {
            $orders = $this->orderService->getCustomerOrders();
            return $this->responseClass->apiResponse(200, "Orders Successfully fetched", null, $orders);
        } catch(\Exception $e){
            return $this->responseClass->apiResponse(500, 'Something Went Wrong', $e->getMessage());
        }
    }

    public function cancel(OrderCancelRequest $request)
    {
        try {
            $this->orderService->orderCancel($request->order_id);
            return $this->responseClass->apiResponse(200, "Orders order canceled successfully", null, null);
        } catch(\Exception $e){
            return $this->responseClass->apiResponse(500, 'Something Went Wrong', $e->getMessage());
        }
    }

}
