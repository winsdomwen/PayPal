<?php

set_time_limit(3600);
require_once('./common.php');

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

if (isset($_GET['success']) && $_GET['success'] == 'true') {

    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $details->setShipping(1)
        ->setTax(2)
        ->setSubtotal(7.8);

    $amount->setCurrency('USD');
    $amount->setTotal(10.8);
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);

    try {
        $result = $payment->execute($execution, $apiContext);
        echo "支付成功";



    } catch (Exception $ex) {
        echo "支付失败";
        die;
    }

    return $payment;
} else {
    echo "PayPal返回回调地址参数错误";
}