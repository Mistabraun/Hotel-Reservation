<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/Customer.php";
require_once __DIR__ . "/../models/Transaction.php";

class TransactionService extends BaseService
{

    private Customer $customer;
    private Transaction $transaction;

    public function __construct()
    {


        $this->customer = new Customer();
        $this->transaction = new Transaction();
    }

    public function getTransactions(
        int $userId
    ): array {

        $customer = $this->customer->findByUserId(
            $userId
        );

        if (!$customer) {
            return $this->error(
                "Customer not found."
            );
        }

        return $this->success(
            "Transactions retrieved successfully.",
            [
                "current_booking" =>
                $this->transaction->getCurrentBooking(
                    $customer["id"]
                ),

                "history" =>
                $this->transaction->getHistory(
                    $customer["id"]
                )
            ]
        );
    }
}
