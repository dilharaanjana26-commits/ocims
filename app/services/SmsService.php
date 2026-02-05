<?php
class SmsService
{
    public function send($mobile, $message)
    {
        return [
            'status' => 'sent',
            'provider' => Env::get('SMS_PROVIDER', 'mock'),
        ];
    }
}
