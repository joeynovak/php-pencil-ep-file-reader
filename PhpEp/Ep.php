<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/15/12
 * Time: 9:51 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('Entities/EpPage.php');
require_once('Entities/EpGroup.php');
class Ep {
    var $pages = array();
    public static $auto_create_missing_entities = true;

    public function epToObjectTree($input, array $settings = array()){
        if(substr(trim($input), 0, 1) != '<'){
            $svg_xml = file_get_contents($input);
        } else {
            $svg_xml = $input;
        }

        //We initialize the class so that cake will load the file and give us the qp function...
        $qp = new QueryPath();
        $queryPath = qp($svg_xml,'',array('ignore_parser_warnings' => TRUE));

        $pages = $queryPath->find("Document > Pages > Page");

        foreach($pages as $page){
            $pageAsArray = array();
            $epPage = new EpPage();
            $epPage->load($page);
            $page->end();
            $this->pages[] = $epPage;

        }

        return $this->pages;
    }



    public static function loadGroup($entityInfo, EpEntityContainer $container) {
        $group = new EpGroup();
        $group->load($entityInfo, $container);
        return $group;
    }

    static public function loadEntity($entity_type, $entityQp, EpEntityContainer $container){
        /** @var $entity EpEntity */
        $className = self::getClassNameToUseForEntity($entity_type);
        $entity = new $className($entity_type);
        $entity->load($entityQp, $container);
        return $entity;
    }

    static public function getClassNameToUseForEntity($entity_type){
        $entity_type = ucfirst($entity_type);
        $className = "Ep$entity_type";
        if(!class_exists($className)){
            if(!file_exists(self::getEntityClassFilePath($entity_type))){
                if(self::$auto_create_missing_entities){
                    $contents = <<<AOB
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class $className extends EpEntity{

    public function __construct(){
        parent::__construct("$entity_type");
    }

    public function load(\$entityQp, EpEntityContainer \$container){
        parent::load(\$entityQp, \$container);
    }

    public function getCakeResources(array \$settings = array()){
        return array(
            'view_code' =>
            "<$entity_type>\$this->text</$entity_type>",
            'elements' => array()
        );
    }
}
AOB;
                    file_put_contents(self::getEntityClassFilePath($entity_type), $contents);
                }  else {
                    $entity_type = 'Entity';
                    $className = 'EpEntity';
                }

            }
            require_once(self::getEntityClassFilePath($entity_type));
        }
        return $className;
    }

    static private function getEntityClassFilePath($entity_type) {
        return dirname(__FILE__) . "/Entities/Ep$entity_type.php";
    }
}
