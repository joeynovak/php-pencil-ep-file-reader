<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */ 
class EpEntity {
    var $entity_type;
    var $top;
    var $left;

    public function __construct($entity_type){
        $this->entity_type = $entity_type;
    }

    public function load($entityQp, EpEntityContainer $container = null){
        $transform = $entityQp->attr("transform");
        $transform = str_replace("matrix(", "", $transform);
        $transform = str_replace(")", "", $transform);
        $transform = explode(",", $transform);

        if(count($transform) == 6){
            $this->top += $transform[5];
            $this->left += $transform[4];
        }

        if($container != null){
            $this->top += $container->top;
            $this->left += $container->left;
        }

        $this->text = $this->getProperty($entityQp, "textContent");
    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' =>
                "<$this->entity_type>$this->text</$this->entity_type>",
            'elements' => array()
        );
    }

    public function getProperty($entityQp, $propertyName){
        $propertyValue = null;
        $propertyElements = $entityQp->find(" > p|metadata > p|property[name=$propertyName]");
        if(count($propertyElements) > 0){
            $propertyValue = $propertyElements->text();
        }
        $propertyElements->end();
        return $propertyValue;
    }
}
