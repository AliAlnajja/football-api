<?php

/**
 * A wrapper class for invoking remote resources using the Guzzle HTTP library.
 *
 * @author Sleiman Rabah
 */
class WebServiceInvoker {

    private $request_options;

    public function __construct($options) {
        $this->request_options = $options;
    }

    protected function invoke($resource_uri) {
        $data = Array();
        $client = new GuzzleHttp\Client();
        $response = $client->get($resource_uri, $this->request_options);
        if ($response->getStatusCode() === 200) {
            $data = $response->getBody()->getContents();
        } else {
            // The request has failed.
            // TODO: Handle erros here.
        }
        // Return the response data.
        return $data;
    }

}
