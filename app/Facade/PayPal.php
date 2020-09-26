<?php


namespace App\Facade;


class PayPal
{
    public static function apiContext()
    {
    }

    public function apiContex()
    {
        date_default_timezone_set(@date_default_timezone_get());

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $clientId = 'AZ8ys3zpQPsfXKPITdJMer9C8fnDqBArgx9vTKWVkZvsVuJAXpErCLx1zHrxx7ky2vzRtKKK0bYFoeaF';
        $clientSecret = 'EOP441eKesbxxr2mGa2-bxxsfaUSvhkTPEv1t0qTB26yga2J_IwmHQmdgkPnt18zRMfUyrQWP32sl5_n';


// \PayPal\Core\PayPalHttpConfig::$defaultCurlOptions[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1_2;


        /** @var \Paypal\Rest\ApiContext $apiContext */
        $apiContext = self::getApiContext($clientId, $clientSecret);

        return $apiContext;
    }

    public static function getApiContext($clientId, $clientSecret)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );


        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
            )
        );

        return $apiContext;
    }
}
