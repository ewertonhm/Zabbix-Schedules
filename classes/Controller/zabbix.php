<?php

namespace controller;

Class ZabbixApi
{
    protected $zabUrl = 'http://zabbix.monitor.redeunifique.com.br/';
	protected $zabUser = 'api_zabbix_schedule';
	protected $zabPassword = '123mudar*';
	protected $authKey;
    protected $timeout = 30; //max. time in seconds to process request
	protected $connectTimeout = 10; //max. time in seconds to connect to server
    protected $debug = false;


    /**
	 * Constructor
	 * Check for required Curl module
	 * @throws Exception $e
	 */
	public function __construct() {
		if (!function_exists('curl_init')) {
			throw new \Exception("Missing Curl support. Install the PHP Curl module.");
		}
		$this->login();
	}

    public function call($method, $params = array()) {
		if (!$this->zabUrl) {
			throw new \Exception("Missing Zabbix URL.");
		}
		//try to call API with existing auth. on Error re-login and try again
		try {
			$response = $this->callZabbixApi($method, $params);
            return $response;
		}
		catch (\Exception $e) {
			$this->login();
			$response = $this->callZabbixApi($method, $params);
		}
	}
	/**
	 * Internal call to Zabbix API via RPC/API call
	 *
	 * @param string $method
	 * @param mixed $params
	 * @return mixed $response. Json decoded response
	 * @throws Exception
	 */
    protected function callZabbixApi($method, $params = array()) {

		if (!$this->authKey && $method != 'user.login' && $method != 'apiinfo.version') {
			throw new \Exception("Not logged in and no authKey");
		}

		$request = $this->buildRequest($method, $params);
		$rawResponse = $this->executeRequest($this->zabUrl.'api_jsonrpc.php', $request);

		if ($this->debug) {
			print "DBG callZabbixApi(). Raw response from API: $rawResponse\n";
		}
		$response = json_decode($rawResponse, true);

		if ( isset($response['id']) && $response['id'] == 1 && isset($response['result']) ) {
			$this->authKeyIsValid = true;
			return $response['result'];
		}

		$msg = "Error without further information.";
		if (is_array($response) && array_key_exists('error', $response)) {
			$code = $response['error']['code'];
			$message = $response['error']['message'];
			$data = $response['error']['data'];
			$msg = "$message [$data]";
			throw new \Exception($msg, $code);
		}

		throw new \Exception($msg);

	}

	protected function login(){
        $method = 'user.login';
        $params = Array(
            "user"=>$this->zabUser,
            "password"=>$this->zabPassword
        );
        $response = $this->call($method, $params);
        $this->authKey = $response;
	}

    	/**
	 * Build the Zabbix JSON-RPC request
	 *
	 * @param string $method
	 * @param mixed $params
	 * @return string $request. Json encoded request object
	 * @throws Exception
	 */
	protected function buildRequest($method, $params = array()) {
		if ($params && !is_array($params)) {
			throw new \Exception("Params passed to API call must be an array");
		}

		$request = array(
			'auth' => $this->authKey,
			'method' => $method,
			'id' => 1,  // since we do not work in parallel, always using the same id should work
			'params' => ( is_array($params) ? $params : array() ),
			'jsonrpc' => "2.0"
		);

		if ($method == 'user.login') {
			unset($request['auth']);
		}

		if ($method == 'apiinfo.version') {
			unset($request['auth']);
		}

		return json_encode($request);
	}


	/**
	 * Low level execute the request
	 *
	 * @param string $zabUrl. Url pointing to API endpoint
	 * @param mixed $data.
	 * @return string $response. Json encoded response from API
	 */
	protected function executeRequest($zabUrl, $data = '') {
		$c = curl_init($zabUrl);
		// These are required for submitting JSON-RPC requests

		$headers = array();
		$headers[]  = 'Content-Type: application/json-rpc';

		$opts = array(
			// allow to return a curl handle
			CURLOPT_RETURNTRANSFER => true,
			// max number of seconds to allow curl to process the request
			CURLOPT_TIMEOUT => $this->timeout,
			// max number of seconds to establish a connection
			CURLOPT_CONNECTTIMEOUT => $this->connectTimeout,
			// follow if url has changed
			CURLOPT_FOLLOWLOCATION => true,
			// no cached connection or responses
			CURLOPT_FRESH_CONNECT => true
		);


		$opts[CURLOPT_HTTPHEADER] = $headers;

		$opts[CURLOPT_CUSTOMREQUEST] = "POST";
		$opts[CURLOPT_POSTFIELDS] = ( is_array($data) ? http_build_query($data) : $data );

		// use compression
		#$opts[CURLOPT_ENCODING] = 'gzip';

		if ($this->debug) {
			print "DBG executeRequest(). CURL Params: ". $opts[CURLOPT_POSTFIELDS]. "\n";
		}

		curl_setopt_array($c, $opts);

		$response = @curl_exec($c);
		$info = curl_getinfo($c);

		$httpCode = $info['http_code'];

		if ( $httpCode == 0 || $httpCode >= 400) {
			throw new \Exception("Request failed with HTTP-Code: $httpCode", $httpCode);
		}

		curl_close($c);
		return $response;
	}


}

Class ZabbixQuery
{
    public static function getMacros($hostid)
    {  
        $api = new ZabbixApi();
        $method = 'usermacro.get';
        $params = Array(
            "hostids"=>$hostid,
            "selectHosts"=>["host"]
        );
        $response = $api->call($method, $params);
        
        return $response;
    }
    public static function getMacro($hostmacroid)
    {
        $api = new ZabbixApi();
        $method = 'usermacro.get';
        $params = Array(
            "hostmacroids"=>$hostmacroid,
            "selectHosts"=>["host"]
        );
        $response = $api->call($method, $params);
        
        return $response[0];
    }
    public static function updateMacro($hostmacroid, $value)
    {
        $api = new ZabbixApi();
        $method = 'usermacro.update';
        $params = Array(
            "hostmacroid"=>$hostmacroid,
            "value"=>$value
        );
        $response = $api->call($method, $params);
        
        return $response;
    }
    public static function getHosts()
    {
        $api = new ZabbixApi();
        $method = 'host.get';
        $params = Array(
            "monitored_hosts"=>1,
            "with_items"=>1,
            "output"=>["hostid","name"],
            "sortfield"=>"name",
            "sortorder"=>"ASC"
        );
        $response = $api->call($method, $params);
        
        return $response;
    }

    public static function getHostGroups()
    {
        $api = new ZabbixApi();
        $method = 'hostgroup.get';
        $params = Array(
            "sortfield"=>"name",
            "output"=>["name","groupid"]
        );
        $response = $api->call($method, $params);
        
        return $response;
    }
    public static function getHostGroupsWithHosts($groupid)
    {
        $api = new ZabbixApi();
        $method = 'hostgroup.get';
        $params = Array(
            "groupids"=>$groupid,
            "selectHosts"=>["host"]
        );
        $response = $api->call($method, $params);
        
        return $response;
    }
    public static function addHostsToGroups($hostids, $groupids)
    {
        $api = new ZabbixApi();
        $method = 'hostgroup.massadd';
        $groups = [];
        $hosts = [];

        foreach($groupids as $group){
            $groups[] = array("groupid"=>$group);
        }
        foreach($hostids as $host){
            $hosts[] = array("hostid"=>$host);
        }

        $params = Array(
            "groups"=>$groups,
            "hosts"=>$hosts
        );
        $response = $api->call($method, $params);
        
        return $response;
    }
    public static function removeHostsFromGroups($hostids, $groupids)
    {
        $api = new ZabbixApi();
        $method = 'hostgroup.massremove';
        $groups = [];
        $hosts = [];

        foreach($groupids as $group){
            $groups[] = $group;
        }
        foreach($hostids as $host){
            $hosts[] = $host;
        }

        $params = Array(
            "groupids"=>$groups,
            "hostids"=>$hosts
        );
        $response = $api->call($method, $params);
		return $response;

    }
    
}

?>