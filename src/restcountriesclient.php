<?php
namespace librestcountries;
/**
 * RestCountriesClient
 * This class was designed for connecting to the restcountries api hosted in
 * https://restcountries.com/#rest-countries and for retrieving all the available
 * countries data. This code is ready for the current version of the api v3.1.
 * 
 * @author ferrys
 */
class restCountriesClient
{
    public $url;
    public $urlBase;//"https://restcountries.com/v3.1/"
    public $fieldNameList = array('name','full_name','code','list_of_codes','currency','lang','capital','region','subregion');

    /**
     * Constructor.
     * @param string $urlbase
     */
    function __construct($urlbase='')
    {
        $this->urlBase = $urlbase;
    }

    /**
     * List all countries
     * @return mixed
     */
    public function listAll()
    {
        $this->url  =$this->urlBase.'all';
        $response   =$this->exec();
        $response   =json_decode($response);
        return $response; 
    }

    /**
     * filter by a given field.
     * @return mixed
     */
    public function filterBy(){
        list($fieldName,$keyWords) = (func_num_args()>1)?func_get_args():array("","");

        //CHECK WHETHER PARAMS ARE OK OR NOT
        $response   =   array();
        if(empty($fieldName) || empty($keyWords)){return $response;}

        //CHECK WHETHER FIELDNAME IS AVAILABLE OR NOT
        if(!in_array($fieldName,$this->fieldNameList)){return $response;}

        //REQUEST BUILDING
        switch($fieldName)
        {
            case 'full_name':
                $this->url = $this->urlBase."name/".$keyWords."?fullText=true";
                break;
            case 'list_of_codes':
                $keyWords = implode(",",$keyWords);
                $this->url = $this->urlBase."alpha?codes=".$keyWords;
                break;
            case 'code':
                $this->url = $this->urlBase."alpha/".$keyWords;
                break;
            default:
                $this->url = $this->urlBase.$fieldName."/".$keyWords;
                break;
        }

        //EXECS THE REQUEST
        $response   =   $this->exec();
        $response   =   json_decode($response);
        return $response;
    }

    /**
     * Executes the request.
     * @return mixed
     */
    public function exec()
    {
        $response = file_get_contents($this->url);
        return $response;
    }
}
?>
