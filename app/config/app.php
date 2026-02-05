<?php
return [
    'base_url' => Env::get('BASE_URL', 'http://localhost/ocims/public'),
    'convenience_fee_percent' => (float) Env::get('CONVENIENCE_FEE_PERCENT', 5),
    'teacher_subscription_months' => (int) Env::get('TEACHER_SUBSCRIPTION_MONTHS', 1),
];
