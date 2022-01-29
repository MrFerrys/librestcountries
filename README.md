# librestcountries
Library for getting countries info from restcountries.com

## Description

Library for getting countries info from restcountries.com

## Getting Started

### Dependencies

* PHP >= 5

### Installation
composer require mrferrys/librestcountries

### Usage

* How to list all countries.
```
	require_once(dirname(__FILE__).'/src/restcountriesclient.php');
	use librestcountries\restCountriesClient as rcClient;
	
	$restClient 			= 	new rcClient();
	$restClient->urlBase	=	"https://restcountries.com/v3.1/";
	$result					=	$restClient->listAll();
	foreach($result as $key=>$value)
	{
		$name=$value->name->common;
		echo ".- $name ".PHP_EOL;
	}
```
* How to filter by property.Filter fields (name,full_name,code,list_of_codes,currency,lang,capital,region,subregion).
```
	$field	=	"name";
	$value	=	"spain";
	$result	=	$restClient->filterBy($field,$value);
	foreach($result as $key=>$value)
	{
		$name=$value->name->common;
		$official=$value->name->official;
		echo ".- $name/$official ".PHP_EOL;
	}
```
## Authors

MrFerrys  

## Version History

* 1.0.0
    * Initial Release (X.Y.Z MAJOR.MINOR.PATCH)

## License

This project is licensed under the MiT License - see the LICENSE file for details

## Acknowledgments

REST Countries API:
* [restcountries.com](https://restcountries.com/)