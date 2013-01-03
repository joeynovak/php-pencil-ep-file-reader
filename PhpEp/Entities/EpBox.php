<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpBox extends EpEntity{

    public function __construct(){
        parent::__construct("Box");
    }

    public function load($entityQp){
        parent::load($entityQp);
    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' =>
            "<div class=\"box\">$this->text</div>",
            'elements' => array()
        );
    }
}