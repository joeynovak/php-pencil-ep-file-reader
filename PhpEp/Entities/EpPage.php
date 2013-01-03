<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntityContainer.php");
class EpPage extends EpEntityContainer{
    var $title = '';
    var $entities = array();
    public function __construct(){
    }

    public function load($entityQp, EpEntityContainer $container = null){
        parent::load($entityQp, $container);
        $this->title = $entityQp->find(" > Properties > Property[name=name]")->text();
        $entityQp->end();
        $this->entities = $this->loadEntities($entityQp);
    }

    public function getCakeResources(array $settings = array()){
        $entitiesCakeResources = $this->getEntitiesCakeResources($settings);
        $cakeResources = array(
            'views' => array(
                $this->getFilePathForView() => implode("\n", $entitiesCakeResources['view_code'])
            ),
            'elements' => $entitiesCakeResources['elements']
        );
        return $cakeResources;
    }

    public function getCakeViewCode($settings){
        return "a";
    }

    protected function getEntityXmlElements($entityQp) {
        $entityQp->find("Content > g");
    }

    private function getFilePathForView() {
        $title_pieces = explode(".", $this->title);
        if(count($title_pieces) > 1){
            $directory = Inflector::camelize(str_replace(" ", "", array_shift($title_pieces)));
            $file_name = Inflector::underscore(str_replace(" ", "_", implode('.', $title_pieces)));
        } else {
            $directory = Inflector::camelize(str_replace(" ", "", $title_pieces[0]));
            $file_name = Inflector::underscore(str_replace(" ", "", $title_pieces[0]));
        }

        return "$directory/$file_name.ctp";
    }

    private function getEntitiesCakeResources($settings) {
        $allCakeResources = array('view_code' => array(), 'elements' => array());
        foreach($this->entities as $entity){
            /** @var EpEntity $entity  */
            $cakeResources = $entity->getCakeResources();

            $allCakeResources['view_code'] = array_merge($allCakeResources['view_code'], array($cakeResources['view_code']));

            if(isset($cakeResources['elements'])){
                $allCakeResources['elements'] = array_merge($allCakeResources['elements'], $cakeResources['elements']);
            }
        }

        return $allCakeResources;
    }
}