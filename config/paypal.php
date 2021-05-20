<?php

return array(
/** set your paypal credential **/
'client_id' =>'AWezaWa3Z1Zrpn1t5GNXAvmjCwo8BVfrmXraJrAVMmIVv25awhJNm7FQxzJooicVkf0Z62371VlLYbQH',
'secret' => 'ECTnRf0vDQtujyHVGs75nEyTHNQ9JjnnZyxcXHC_257x2MGntz6FCt6sjAQ2bx0vQYxhBGreYr4S71Hb',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 10000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);

