<?php
/**
 * Created by PhpStorm.
 * User: cpippert
 * Date: 08.11.2018
 * Time: 12:46
 */

class service
{
    /**
     * Get the title of the alarm message based on the alarm keyword.
     * @param string $keyword given by the alarm message from TetraControl
     * @param array $alarmKeywords relevant keywords from config file
     * @param integer $alarmKeywords max length of field type defined in Divera API
     * @return string alarm title
     */
    public function getAlarmType($keyword, $alarmKeywords, $maxStrLenType){
        if(is_string($keyword) && array_key_exists ( $keyword , $alarmKeywords )){
            $title =  $keyword." - ".$alarmKeywords[$keyword]['short'];
            if (strlen($title) > $maxStrLenType)
                $title = substr($title, 0, $maxStrLenType-3) . '...';
            return $title;
        }
        else{
            return $keyword;
        }
    }

    /**
     * Get the text of the alarm message based on the alarm keyword.
     * @param string $keyword given by the alarm message from TetraControl
     * @param array $alarmKeywords relevant keywords from config file
     * @param integer $alarmKeywords max length of field type defined in Divera API
     * @return string alarm title
     */
    public function getAlarmText($keyword, $alarmKeywords){
        if(is_string($keyword) && array_key_exists ( $keyword , $alarmKeywords )){
            $title =  $alarmKeywords[$keyword]['long'];
            return $title;
        }
        else{
            return "";
        }
    }

    /**
     * Get the vehicle(s) based on the alarm keyword.
     * @param string $keyword given by the alarm message from TetraControl
     * @param array $alarmKeywords relevant keywords from config file
     * @param integer $alarmKeywords max length of field type defined in Divera API
     * @return string vehicle(s) comma separated
     */
    public function getVehicle($keyword, $alarmKeywords){
        if(is_string($keyword) && array_key_exists ( $keyword , $alarmKeywords )){
            $vehicle =  $alarmKeywords[$keyword]['vehicle'];
            return $vehicle;
        }
        else{
            return "";
        }
    }

    /**
     * Find the address based on the alert message from TetraControl. Remove the district and if the last Word is a number
     * then the number is removed.
     * @param string $address
     * @param array $districts Ortsteile von Lohfelden
     * @return string
     */
    public function formatAddress($address,$districts){
        preg_match('/\s(\w+)$/', $address, $matchesLastWord);
        preg_match('/^([\w\-]+)/', $address, $matchesFirstWord);
        $returnAddress = $address;

        if($matchesLastWord){
            if(is_numeric ( $matchesLastWord[1])) {
                $returnAddress = str_replace($matchesLastWord[0], '', $returnAddress);
            }
        }
        if($matchesFirstWord){
            if(in_array($matchesFirstWord[0], $districts)){
                $returnAddress = substr_replace ($returnAddress, '', 0, strlen($matchesFirstWord[0]));
            }
        }
        return trim($returnAddress);
    }
}