<?php

namespace App\Http\Controllers;

use App\Domain\Logistic\Services\Interfaces\ILogisticServiceAddWarehouse;
use App\Domain\Logistic\Services\Interfaces\ILogisticServiceCancelOrder;
use App\Domain\Logistic\Services\Interfaces\ILogisticServiceCreateOrder;
use App\Domain\Logistic\Services\Interfaces\ILogisticServiceListWarehouse;

class ControllerForTestIntegration extends Controller
{
    public function __construct(
        private readonly ILogisticServiceAddWarehouse $warehouse,
        private readonly ILogisticServiceCreateOrder $createOrder,
        private readonly ILogisticServiceListWarehouse $serviceListWarehouse,
        private readonly ILogisticServiceCancelOrder $cancelOrder,
    )
    {
    }

    public function createWareHouse(): array
    {
       return $this->warehouse->addWarehouse([]);
    }

    public function listShippingWareHouse(): array
    {
       return $this->serviceListWarehouse->listWarehouses([]);
    }

    public function createShippingOrder(): array
    {
       return $this->createOrder->createShippingOrder([]);
    }

    public function cancelShippingOrder(): array
    {
       return $this->cancelOrder->cancelShippingOrder([]);
    }
}
