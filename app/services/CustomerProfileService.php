<?php

require_once __DIR__ . "/BaseService.php";


require_once __DIR__ . "/../../config/Database.php";

require_once __DIR__ . "/../models/CustomerProfile.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Customer.php";

class CustomerProfileService extends BaseService
{

    private CustomerProfile $customerProfile;
    private User $user;
    private mysqli $connection;
    private Customer $customer;

    public function __construct()
    {


        $this->customerProfile = new CustomerProfile();
        $this->user = new User();
        $this->customer = new Customer();
        $this->connection = Database::connect();
    }

    public function changePassword(
        int $userId,
        array $data
    ): array {

        $currentPassword = $data["current_password"] ?? "";
        $newPassword = $data["new_password"] ?? "";
        $confirmPassword = $data["confirm_password"] ?? "";

        if (
            $currentPassword === "" ||
            $newPassword === "" ||
            $confirmPassword === ""
        ) {
            return $this->error(
                "All password fields are required."
            );
        }

        if ($newPassword !== $confirmPassword) {
            return $this->error(
                "Passwords do not match."
            );
        }

        if (strlen($newPassword) < 8) {
            return $this->error(
                "Password must be at least 8 characters."
            );
        }

        $user = $this->user->findById($userId);

        if (!$user) {
            return $this->error("User not found.");
        }

        if (
            !password_verify(
                $currentPassword,
                $user["password"]
            )
        ) {
            return $this->error(
                "Current password is incorrect."
            );
        }

        $hash = password_hash(
            $newPassword,
            PASSWORD_DEFAULT
        );

        if (
            !$this->user->updatePassword(
                $userId,
                $hash
            )
        ) {
            return $this->error(
                "Unable to change password."
            );
        }

        return $this->success(
            "Password changed successfully."
        );
    }
    public function update(
        int $userId,
        array $data
    ): array {

        $customer = $this->customer->findByUserId($userId);

        if (!$customer) {
            return $this->error(
                "Customer not found."
            );
        }

        $user = $this->user->findById($userId);
        if (!$user) {
            return $this->error(
                "User not found."
            );
        }
        $firstName = trim(
            $data["first_name"] ?? $customer["first_name"]
        );


        $lastName = trim(
            $data["last_name"] ?? $customer["last_name"]
        );

        $phone = trim(
            $data["phone"] ?? $customer["phone_number"]
        );

        $email = trim(
            $data["email"] ?? $user["email"]
        );

        if (isset($data["first_name"]) && $firstName === "") {
            return $this->error(
                "First name cannot be empty."
            );
        }

        if (isset($data["last_name"]) && $lastName === "") {
            return $this->error(
                "Last name cannot be empty."
            );
        }

        if (isset($data["phone"]) && $phone === "") {
            return $this->error(
                "Phone number cannot be empty."
            );
        }

        if (isset($data["email"])) {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->error(
                    "Invalid email address."
                );
            }

            $existing = $this->user->findByEmail($email);

            if (
                $existing &&
                (int)$existing["id"] !== $userId
            ) {
                return $this->error(
                    "Email address already exists."
                );
            }
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (
                !$this->customer->updateBasicInformation(
                    (int)$customer["id"],
                    $firstName,
                    $lastName,
                    $phone
                )
            ) {
                throw new Exception(
                    "Unable to update customer information."
                );
            }

            if (
                !$this->user->updateEmail(
                    $userId,
                    $email
                )
            ) {
                throw new Exception(
                    "Unable to update email address."
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Profile updated successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }


    public function getProfile(
        int $userId
    ): array {

        $customer = $this->customerProfile->findByUserId(
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
