<?php

namespace VarunAgw\Maps;

use VarunAgw\Framework\Config;
use GuzzleHttp\Client;

class Maps {

    protected $_key;

    public function __construct() {
        $config = new Config();
        $this->_key = $config->readOrFail('Google.Maps.key');
    }

    /**
     * Internal function to call Google Maps API
     * @param string $endpoint endpoint you want to call in map API
     * @return json JSON response from API
     * @throws MapsException
     */
    protected function _apiQuery($endpoint) {
        $endpoint = 'https://maps.googleapis.com/maps/api/' . $endpoint . '&key=' . urlencode($this->_key);

        $httpClient = new Client();
        $res = $httpClient->request('GET', $endpoint);

        $body = json_decode($res->getBody());

        if (!in_array($body->status, ['OK', 'ZERO_RESULTS'])) {
            throw new MapsException($body->status . ' - ' . $body->error_message);
        }
        return $body;
    }

    /**
     * Get Google place id for a address
     * @param string$address
     * @return string|null
     */
    protected function _getPlaceId($address) {
        $response = $this->_apiQuery('place/textsearch/json?query=' . urlencode($address));

        if (empty($response->results)) {
            return null;
        } else {
            return $response->results[0]->place_id;
        }
    }

    /**
     * Get details of a place from Google Maps
     * @param string $placeId
     * @return object
     */
    protected function _getPlaceDetails($placeId) {
        $response = $this->_apiQuery('place/details/json?placeid=' . urlencode($placeId));
        $details = [];

        if (empty($response->result)) {
            return null;
        } else {
            foreach ($response->result->address_components as $address_component) {
                $details[$address_component->types[0]] = $address_component->long_name;
            }

            return (object) $details;
        }
    }

    /**
     * Get details of any address
     * @param string $address 
     * @return object
     */
    public function getAddressDetails($address) {
        $placeId = $this->_getPlaceId($address);
        if (empty($placeId)) {
            return null;
        }

        $placeDetails = $this->_getPlaceDetails($placeId);
        return $placeDetails;
    }

}
