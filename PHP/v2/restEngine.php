<?php
/**
 * REST service for RestAPI 
 * In the Engine we have two options for RestServices fuction that "doRestAPI($method, $httpParam, $url) and doRestAPI_void()", both are same usage in this case.
 */	
	class restEngine {			
		private $HttpParam;	
		private $method = 'GET';	
		private $httpParam;
		private $restUrl;
		private $result;
		
		public function doRestAPI($method, $httpParam, $restUrl){		//method:"POST, GET"; HttpParam: Arr of method; url: Rest API 
			$this -> setRequMeth($method);
			$this -> setHttpParam($httpParam);
			$this -> setRestUrl($restUrl);
			$this -> callHttpService($this->method, $this->httpParam, $this->restUrl);	
			return $this -> getResult();			
		}	

		public function doRestAPI_void(){		
			if(isset($this->method) && isset($this->httpParam) && isset($this->restUrl))
				$this -> callHttpService($this->method, $this->httpParam, $this->restUrl);			
		}		
		
		private function callHttpService($method, $httpParam, $restUrl){
			$opts = array('http' =>
				array(
					'method'  => $method,
					'header'  => 'Content-Type: application/x-www-form-urlencoded',
					'content' => $httpParam
				)
			);
			$context  = stream_context_create($opts);
			switch($method){
				case 'POST':	
					$this->result = file_get_contents($restUrl, false, $context);	
					break;
					
				case 'GET':	
					$this->result = file_get_contents($restUrl.'?'.$httpParam , false, $context);	
					break;
			}
		}	
		
		public function setRequMeth($method){
			$this->method = $method;
		}	
		
		public function setHttpParam($httpParam){
			$this->httpParam = http_build_query($httpParam);
		}	
		
		public function setRestUrl($restUrl){
			$this->restUrl = $restUrl;
		}
		
		public function getResult(){
			return $this->result;
		}
	}
?>