<?php

return [
    'db.host' => getenv('DB_HOST'),
    'db.user' => getenv('DB_USER'),
    'db.password' => getenv('DB_PASSWORD'),
    'db.name' => getenv('DB_NAME'),
    'fake-bank-a.host' => getenv('FAKE_BANK_A_HOST'),
    'fake-bank-a.client-id' => getenv('FAKE_BANK_A_CLIENT_ID'),
    'fake-bank-a.client-secret' => getenv('FAKE_BANK_A_CLIENT_SECRET'),
    'fake-bank-a.certificate-path' => getenv('FAKE_BANK_A_CERTIFICATE_PATH'),
    'fake-bank-a.certificate-password' => getenv('FAKE_BANK_A_CERTIFICATE_PASSWORD'),
];
