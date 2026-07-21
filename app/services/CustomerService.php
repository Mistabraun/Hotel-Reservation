<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Customer.php";

class CustomerService extends BaseService
{
    private User $user;
    private Customer $customer;
    private mysqli $connection;

    public function __construct()
    {
        $this->user = new User();
        $this->customer = new Customer();
        $this->connection = Database::connect();
    }

    /**
     * Registers a new customer.
     */
    public function register(array $data): array
    {
        $firstName = trim($data["first_name"] ?? "");
        $lastName = trim($data["last_name"] ?? "");
        $email = trim($data["email"] ?? "");
        $password = $data["password"] ?? "";
        $phoneNumber = trim($data["phone_number"] ?? "");

        if (
            $firstName === "" ||
            $lastName === "" ||
            $email === "" ||
            $password === ""
        ) {
            return $this->error("Please complete all required fields.");
        }

        if ($this->user->findByEmail($email)) {
            return $this->error("Email address already exists.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            $password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // 2 = Customer
            $userId = $this->user->create(
                $email,
                $password,
                2
            );

            if (!$userId) {
                throw new Exception(
                    "Unable to create user."
                );
            }

            $customerId = $this->customer->create(
                $userId,
                $firstName,
                $lastName,
                $phoneNumber
            );

            if (!$customerId) {
                throw new Exception(
                    "Unable to create customer."
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Customer registered successfully.",
                [
                    "id" => $customerId
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }

    public function getAll(): array
    {
        return $this->success(
            "Customers retrieved successfully.",
            $this->customer->getAll()
        );
    }

    public function getById(int $id): array
    {
        $customer = $this->customer->findWithUser($id);

        if (!$customer) {
            return $this->error(
                "Customer does not exist."
            );
        }

        return $this->success(
            "Customer retrieved successfully.",
            $customer
        );
    }

    public function getByUserId(int $userId): array
    {
        $customer = $this->customer->findWithUserId(
            $userId
        );

        if (!$customer) {
            return $this->error(
                "Customer does not exist."
            );
        }

        return $this->success(
            "Customer retrieved successfully.",
            $customer
        );
    }

    public function update(
        int $id,
        array $data
    ): array {

        $customer = $this->customer->findById($id);

        if (!$customer) {
            return $this->error(
                "Customer does not exist."
            );
        }

        if (
            !$this->customer->update(
                $id,
                trim($data["first_name"]),
                trim($data["last_name"]),
                trim($data["phone_number"] ?? "")
            )
        ) {
            return $this->error(
                "Unable to update customer."
            );
        }

        return $this->success(
            "Customer updated successfully."
        );
    }

    public function delete(int $id): array
    {
        $customer = $this->customer->findById($id);

        if (!$customer) {
            return $this->error(
                "Customer does not exist."
            );
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (
                !$this->customer->delete($id)
            ) {
                throw new Exception(
                    "Unable to delete customer."
                );
            }

            if (
                !$this->user->delete(
                    $customer["user_id"]
                )
            ) {
                throw new Exception(
                    "Unable to delete user."
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Customer deleted successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }
}
