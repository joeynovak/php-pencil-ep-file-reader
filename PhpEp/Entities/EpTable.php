<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpTable extends EpEntity{
    var $columns = 0;
    var $rows = 0;
    var $name = '';

    public function load($entityQp, EpEntityContainer $container = null){
        $customStyle = $this->getProperty($entityQp, "customStyle");
        if($customStyle != ''){
            $this->name = $customStyle;
        } else {
            $this->name = "{this->columns}x{$this->rows}";

        }
        $content = $this->getProperty($entityQp, "content");
        $lines = explode("\n", $content);
        $this->rows = count($lines);
        $columns = explode("|", array_shift($lines));
        $this->columns = count($columns);
    }

    public function getCakeResources(array $settings = array()){
        if($this->rows == 2){

        } else {

        }

        return array('view_code' => '<table><thead><tr>' . str_repeat("<th></th>", $this->columns) . '</tr></thead><tbody>' . str_repeat("<tr>". str_repeat("<td>Cell</td>", $this->columns) . "</tr>", $this->rows - 1) . '</tbody></table>',
                    'elements' => array('')
                );
    }
}
