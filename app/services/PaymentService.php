<?php
class PaymentService
{
    public function calculateConvenienceFee($amount, $percent)
    {
        return round($amount * ($percent / 100), 2);
    }

    public function processOnlinePayment($amount)
    {
        return [
            'status' => 'captured',
            'gateway_reference' => 'MOCK-' . strtoupper(bin2hex(random_bytes(4))),
        ];
    }
}
