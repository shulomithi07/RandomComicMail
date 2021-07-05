<?php

# EasycronApi 
class EasycronApi
{
	// The token act as a "password" to access the API
	public $token;
	
	// endpoint of the API
	public $uri = 'https://www.easycron.com/rest/';

	/**
	 * Constructor, sets token
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}
	
	/**
	 * Makes the actual call to the easycron.
     *
	 * @param    $method : string the name of the API method (ex: 'add' or 'edit')
	 * @param    $data	 : array array(name => value) pairs to send to API endpoint
	 * @return           : array / false - will return any array returned by easycron or false if the connection to easycron fails.
	 */
	public function call($method, $data = array())
	{
	    $data['token'] = $this->token;
        $arguments = array();
        foreach ($data as $name => $value) {
            $arguments[] = $name . '=' . rawurlencode($value);
        }
        $temp = implode('&', $arguments);

        $url = $this->uri . $method . '?' . $temp;
        $result = file_get_contents($url);

        if ($result) {
            return json_decode($result, true);   
        } else {
            return $result;
        }
	}
}