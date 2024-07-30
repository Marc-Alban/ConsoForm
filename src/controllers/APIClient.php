<?php
declare(strict_types=1);

namespace Controllers;

use App\Controller;
use Controllers\XmlConverter;

class ApiClient extends Controller
{
    private $_xmlConverter;
    private const PRIMARY_ADDRESS = "http://ws.credigo.fr/contact.asmx?WSDL";
    private const FALLBACK_ADDRESS = "http://192.168.100.1/webservicecredigo/contact.asmx?WSDL";

    public function __construct()
    {
        $this->_xmlConverter = new XmlConverter();
    }

    public function sendApi(array $leadData): string
    {
        $xmlString = $this->_xmlConverter->convertArrayToXml($leadData);
        return $this->sendRequestToWebService($xmlString);
    }

    private function sendRequestToWebService(string $xmlString): string
    {
        $address = $this->httpResponse(self::PRIMARY_ADDRESS) ? self::PRIMARY_ADDRESS : self::FALLBACK_ADDRESS;
        $client = new \SoapClient($address);

        try {
            $res = $client->Leadv2([
                'Login' => 'app.solutis.fr',
                'Password' => '2456325214',
                'Version' => 'TEST',
                'Flux' => $xmlString
            ]);

            $_SESSION['result'] = $res->Leadv2Result;

            if (strpos($res->Leadv2Result, 'OK') !== false) {
                return "ok";
            } elseif (strpos($res->Leadv2Result, 'KO-D') !== false) {
                return "ko-d";
            } else {
                return "ko";
            }
        } catch (\SoapFault $e) {
            error_log("SOAP Fault: " . $e->getMessage());
            return "ko";
        }
    }

    private function httpResponse(string $url): bool
    {
        $resURL = curl_init();
        curl_setopt($resURL, CURLOPT_URL, $url);
        curl_setopt($resURL, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($resURL, CURLOPT_FAILONERROR, 1);
        curl_setopt($resURL, CURLOPT_NOSIGNAL, 1);
        curl_setopt($resURL, CURLOPT_TIMEOUT_MS, 200);
        curl_exec($resURL);
        $intReturnCode = curl_getinfo($resURL, CURLINFO_HTTP_CODE);

        if (curl_errno($resURL)) {
            error_log('Curl error: ' . curl_error($resURL));
        }

        curl_close($resURL);

        return in_array($intReturnCode, [200, 301, 302, 304]);
    }
}
