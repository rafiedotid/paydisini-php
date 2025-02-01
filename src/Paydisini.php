<?php

namespace Paydisini;

class Paydisini {
    private $apiKey;
    private $apiUrl = 'https://api.paydisini.co.id/v1/';
    
    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getPaymentChannels() {
        $signature = md5($this->apiKey . 'PaymentChannel');
        return $this->callAPI([
            'request' => 'payment_channel',
            'signature' => $signature
        ]);
    }

    public function createTransaction($params) {
        $required = ['unique_code', 'service', 'amount', 'note', 'valid_time', 'type_fee'];
        foreach($required as $field) {
            if(!isset($params[$field])) {
                throw new \Exception("Field $field is required");
            }
        }
        
        $signature = md5(
            $this->apiKey . 
            $params['unique_code'] . 
            $params['service'] . 
            $params['amount'] . 
            $params['valid_time'] . 
            'NewTransaction'
        );

        $data = array_merge($params, [
            'request' => 'new',
            'key' => $this->apiKey,
            'signature' => $signature
        ]);

        return $this->callAPI($data);
    }

    public function getTransactionStatus($uniqueCode) {
        $signature = md5($this->apiKey . $uniqueCode . 'StatusTransaction');
        return $this->callAPI([
            'request' => 'status',
            'unique_code' => $uniqueCode,
            'signature' => $signature
        ]);
    }

    public function cancelTransaction($uniqueCode) {
        $signature = md5($this->apiKey . $uniqueCode . 'CancelTransaction');
        return $this->callAPI([
            'request' => 'cancel',
            'unique_code' => $uniqueCode,
            'signature' => $signature
        ]);
    }

    private function callAPI($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }

    public static function handleCallback($apiKey, $callbackData) {
        // Validate IP origin
        if($_SERVER['REMOTE_ADDR'] !== '45.87.242.188') {
            return ['success' => false, 'error' => 'Invalid IP address'];
        }

        // Validate signature
        $expectedSignature = md5($apiKey . $callbackData['unique_code'] . 'CallbackStatus');
        if($callbackData['signature'] !== $expectedSignature) {
            return ['success' => false, 'error' => 'Invalid signature'];
        }

        return [
            'success' => true,
            'data' => [
                'unique_code' => $callbackData['unique_code'],
                'status' => $callbackData['status'],
                'amount' => $callbackData['amount']
            ]
        ];
    }
}
