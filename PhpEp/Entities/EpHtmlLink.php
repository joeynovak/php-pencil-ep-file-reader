<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpHtmlLink extends EpEntity{

    public function __construct(){
        parent::__construct("HtmlLink");
    }

    public function load($entityQp){
        parent::load($entityQp);
    }

    public function getCakeCode(array $settings = array()){
        return array(
            'view_code' =>
            "<$HtmlLink>$this->text</HtmlLink>",
            'elements' => array()
        );
    }
}