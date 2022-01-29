<?php
/**
 * LIB REST Countries 
 */
//EXECUTION TIME
ini_set('max_execution_time', '0');

//ERROR REPORTING
//error_reporting(0);
error_reporting(E_ALL);

//LIBS
require_once(dirname(__FILE__).'/src/restcountriesclient.php');
use librestcountries\restCountriesClient as rcClient;

/**                                                                        
 *  MAIN
 */
try{
	echo "---------------- INIT <br>".PHP_EOL;
	$restClient 			= 	new rcClient();
	$restClient->urlBase	=	"https://restcountries.com/v3.1/";
	
	echo "---------------- LIST ALL <br>".PHP_EOL;
	$result					=	$restClient->listAll();
	foreach($result as $key=>$value)
	{
		$name=$value->name->common;
		echo ".- $name <br>".PHP_EOL;
	}
	
	echo "---------------- FILTER BY <br>".PHP_EOL;
	echo ".-AVAILABLE FILTERS name,full_name,code,list_of_codes,currency,lang,capital,region,subregion-.<br>";
	$field	=	"name";
	$value	=	"spain";
	$result	=	$restClient->filterBy($field,$value);
	foreach($result as $key=>$value)
	{
		$name=$value->name->common;
		$official=$value->name->official;
		echo ".- $name/$official".PHP_EOL;
	}
	
}catch(\Exception $e){
    echo $e->getMessage();
}
?>

