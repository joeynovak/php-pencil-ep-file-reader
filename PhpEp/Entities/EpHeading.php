<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpHeading extends EpEntity{

    public function load($entityQp, EpEntityContainer $container = null){
        parent::load($entityQp, $container);
    }


    public function __construct(){
        parent::__construct("Heading");

    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' =>
            "<h1>$this->text</h1>",
            'elements' => array()
        );
    }
}