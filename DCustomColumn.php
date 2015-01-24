<?php
/*
 * DCustomColumn
 * 
 * @category   grid column 
 * @package    DCustomColumn
 * @author     Tukalov Anatoly <anatoly.tukalov@gmail.com>
 * @copyright  2014 YiiMix Group 
 * @license    https://github.com/atukalov/dcustomcolumn/blob/master/LICENSE
 * @version    SVN: $Id$
 * @link       https://github.com/atukalov/dcustomcolumn
 * @see        http://web-developer.pw/cdatacolumn/
 * @since      File available since Release 0.0.1
 * @deprecated File deprecated in Release 0.0.1
 */


Yii::import('zii.widgets.grid.CDataColumn');

class DCustomColumn extends CDataColumn {

    public $data;
    public $datas=array();
    public $rf;

     /**
     * Renders the header cell content.
     * This method will render a link that can trigger the sorting if the column is sortable.
     */
    protected function renderHeaderCellContent() {
        if ($this->grid->enableSorting && $this->sortable && $this->name !== null)
            echo $this->grid->dataProvider->getSort()->link($this->name, $this->header, array('class' => 'sort-link'));
        elseif ($this->name !== null && $this->header === null) {
            if ($this->grid->dataProvider instanceof CActiveDataProvider)
                echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
            else
                echo CHtml::encode($this->name);
        } else
            parent::renderHeaderCellContent();
    }

    protected function renderDataCellContent($row, $data) {

        $this->grid->controller->renderPartial($this->rf,array_merge(array("data"=>$data),$this->datas));
    }

    protected function getItemValue($row, $data) {
        if (!empty($this->value))
            return $this->evaluateExpression($this->value, array('data' => $data, 'row' => $row));
        elseif (!empty($this->name))
            return CHtml::value($data, $this->name);
        return null;
    }


}


