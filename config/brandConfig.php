<?php
use App\Enums\LeverageEnum;
use App\Enums\OrderTypeEnum;
use App\Enums\TradeOrderTypeEnum;
use App\Enums\TransactionOrderTypeEnum;
use App\Enums\TransactionOrderStatusEnum;
use App\Enums\TransactionOrderMethodEnum;
use App\Enums\TradingAccountStatusEnum;


return[
    'trade_order_types' => TradeOrderTypeEnum::getTypes(),
    'transaction_order_types' => TransactionOrderTypeEnum::getTypes(),
    'transaction_methods' =>  TransactionOrderMethodEnum::getMethods(),
    'transaction_status' =>  TransactionOrderStatusEnum::getStatuses(),
    'order_types' =>   OrderTypeEnum::getOrderTypes(),
    'leverages' =>   LeverageEnum::getLeverages(),
    'trading_status' => TradingAccountStatusEnum::getStatuses(),
    'currencies'=>['$','€','£'],
];