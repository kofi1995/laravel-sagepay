<?php

return [
  //This is the encryption password that is retrieved from the dashboard. You can use either the test or the live version depending on your configuration

  //I used the exact phrase 'ENCRYPTION--PASS' to provide us with a 16 digits string to try to generate the getCrypt string. Make sure to change it to your real sagepay Encryption Password
    'encryptPassword' => 'ENCRYPTION--PASS',

// ISO 4217 Name of currency, I don't know all the type of currencies they accept. Check their website to verify
    'currency' => strtoupper('EUR'),

];
