<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/CustomerProfile.php";

class CustomerProfileService extends BaseService
{

    private CustomerProfile $customer;

    public function __construct()
    {
        parent::__construct();

        $this->customer = new CustomerProfile();
    }

    public function getProfile(
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
            "Customer profile retrieved successfully.",
            $customer
        );
    }
}
