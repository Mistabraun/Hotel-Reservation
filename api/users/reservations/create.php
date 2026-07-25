<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../../app/services/ReservationService.php";
require_once __DIR__ . "/../../../app/services/PaymentService.php";


AuthMiddleware::method("POST");
$service = new ReservationService();
$paymentService = new PaymentService();

$_POST["status_id"] = 1; # ALWAYS PENDING FIRST


$createReservation = $service->create($_POST);

if ($createReservation["success"]) {
    $reservationId = $createReservation["data"]["reservationId"];

    $paymentMethod = $paymentService->getPaymentMethodId($_POST["paymentMethod"]);
    if (!$paymentMethod["success"]) {
        return Response::error("Invalid payment method.");
    }

    $gcashReference = trim($data["gcash_reference"] ?? "");

    $cardholderName = trim($data["cardholder_name"] ?? "");
    $cardNumber = preg_replace("/\s+/", "", $data["card_number"] ?? "");
    $expiryDate = trim($data["expiry_date"] ?? "");
    $cvv = trim($data["cvv"] ?? "");

    $transactionReference = null;

    switch ($paymentMethod["name"]) {

        case "GCash":

            if (!preg_match('/^\d{13}$/', $gcashReference)) {
                return Response::error(
                    "GCash reference number must be exactly 13 digits."
                );
            }

            $transactionReference = $gcashReference;

            break;

        case "Card":

            if ($cardholderName === "") {
                return Response::error("Cardholder name is required.");
            }

            if (!preg_match('/^\d{16}$/', $cardNumber)) {
                return Response::error("Invalid card number.");
            }

            if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiryDate)) {
                return Response::error("Invalid expiry date.");
            }

            if (!preg_match('/^\d{3,4}$/', $cvv)) {
                return Response::error("Invalid CVV.");
            }

            $transactionReference =
                $this->generateCardTransactionReference();

            break;

        case "Cash":

            $transactionReference = null;

            break;

        default:

            return Response::error("Unsupported payment method.");
    }

    $paymentService->create([
        "reservation_id" => $reservationId,
        "payment_method_id" => $paymentMethod["id"],
        1, # ALWAYS PENDING
        "transaction_reference" => $transactionReference
    ]);
    return Response::success("Sucecssfully booked.");;
}

Response::json($createReservation);
