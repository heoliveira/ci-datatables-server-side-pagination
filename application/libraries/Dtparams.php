<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dtparams {

    private $ArrayModelParams  = [
		"DTModelParams"    => [
			"TableName"        => NULL, 
			"TableJoin"        => NULL, 
			"ColumnOrder"      => NULL,
			"ColumnSearch"     => NULL,
            "ColumnOrderable"  => NULL,
            "ColumnReplace"    => NULL,
            "DbConnectionName" => NULL
		],
		"DTFilterView"    => array(),
		"DTModelPaginate" => [
			"Length"           => NULL,
			"Start"            => NULL,
			"Draw"             => NULL,
			"SearchValue"      => NULL,
			"OrderColumnIndex" => NULL,
            "OrderColumnDir"   => NULL,
            "recordsTotal"     => NULL,
            "recordsFiltered"  => NULL,
		],
		"DTModelSQL"      => NULL,
    ];
    
    public function init_all($_ArrayModelParams = array())
    {
        /** Starting table variabels and params */
        $this->ArrayModelParams["DTModelParams"]["TableName"]       
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["TableName"], 
            $_ArrayModelParams["DTModelParams"]["TableName"]);
            
        if(isset($_ArrayModelParams["DTModelParams"]["TableJoin"]))
            $this->ArrayModelParams["DTModelParams"]["TableJoin"] 
                = $this->init_parse($this->ArrayModelParams["DTModelParams"]["TableJoin"], 
                $_ArrayModelParams["DTModelParams"]["TableJoin"]);

        $this->ArrayModelParams["DTModelParams"]["ColumnOrder"]     
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnOrder"],
            $_ArrayModelParams["DTModelParams"]["ColumnOrder"]);

        $this->ArrayModelParams["DTModelParams"]["ColumnSearch"]    
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnSearch"],
            $_ArrayModelParams["DTModelParams"]["ColumnSearch"]);

        if(isset($_ArrayModelParams["DTModelParams"]["ColumnOrderable"])) 
            $this->ArrayModelParams["DTModelParams"]["ColumnOrderable"]
                = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnOrderable"],
                $_ArrayModelParams["DTModelParams"]["ColumnOrderable"]);

        if(isset($_ArrayModelParams["DTModelParams"]["ColumnReplace"])) 
            $this->ArrayModelParams["DTModelParams"]["ColumnReplace"]
                = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnReplace"],
                $_ArrayModelParams["DTModelParams"]["ColumnReplace"]);

        $this->ArrayModelParams["DTModelParams"]["DbConnectionName"] 
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["DbConnectionName"],
            $_ArrayModelParams["DTModelParams"]["DbConnectionName"]);

        /** Starting forms fields filter params */
        $this->ArrayModelParams["DTFilterView"]
            = $this->init_parse($this->ArrayModelParams["DTFilterView"] ,
            $_ArrayModelParams["DTFilterView"]);
        
        /** Starting paginate variabels and params */
        $this->ArrayModelParams["DTModelPaginate"]["Length"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Length"],
            $_ArrayModelParams["DTModelPaginate"]["Length"]);

        $this->ArrayModelParams["DTModelPaginate"]["Start"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Start"],
            $_ArrayModelParams["DTModelPaginate"]["Start"]);

        $this->ArrayModelParams["DTModelPaginate"]["Draw"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Draw"],
            $_ArrayModelParams["DTModelPaginate"]["Draw"]);

        $this->ArrayModelParams["DTModelPaginate"]["SearchValue"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["SearchValue"],
            $_ArrayModelParams["DTModelPaginate"]["SearchValue"]);

        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"],
            $_ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"]);

        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"],
            $_ArrayModelParams["DTModelPaginate"]["OrderColumnDir"]);

        /** Starting SQLQuery for query params */
        $this->ArrayModelParams["DTModelSQL"]           
            = $this->init_parse($this->ArrayModelParams["DTModelSQL"],
            $_ArrayModelParams["DTModelSQL"]);

        return $this->ArrayModelParams;
    }

    public function init_DTModelParams($_ArrayModelParams = array())
    {
        /** Starting table variabels and params */
        $this->ArrayModelParams["DTModelParams"]["TableName"]       
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["TableName"], 
            $_ArrayModelParams["DTModelParams"]["TableName"]);

        $this->ArrayModelParams["DTModelParams"]["TableJoin"]       
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["TableJoin"], 
            $_ArrayModelParams["DTModelParams"]["TableJoin"]);

        $this->ArrayModelParams["DTModelParams"]["ColumnOrder"]     
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnOrder"],
            $_ArrayModelParams["DTModelParams"]["ColumnOrder"]);

        $this->ArrayModelParams["DTModelParams"]["ColumnSearch"]    
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnSearch"],
            $_ArrayModelParams["DTModelParams"]["ColumnSearch"]);

        $this->ArrayModelParams["DTModelParams"]["ColumnOrderable"] 
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnOrderable"],
            $_ArrayModelParams["DTModelParams"]["ColumnOrderable"]);

        if(isset($_ArrayModelParams["DTModelParams"]["ColumnReplace"])) 
            $this->ArrayModelParams["DTModelParams"]["ColumnReplace"]
                = $this->init_parse($this->ArrayModelParams["DTModelParams"]["ColumnReplace"],
                $_ArrayModelParams["DTModelParams"]["ColumnReplace"]);
        
        $this->ArrayModelParams["DTModelParams"]["DbConnectionName"] 
            = $this->init_parse($this->ArrayModelParams["DTModelParams"]["DbConnectionName"],
            $_ArrayModelParams["DTModelParams"]["DbConnectionName"]);

        return $this->ArrayModelParams;
    }

    public function init_DTFilterView($_ArrayModelParams = array())
    {
        /** Starting forms fields filter params */
        $this->ArrayModelParams["DTFilterView"]
            = $this->init_parse($this->ArrayModelParams["DTFilterView"] ,
            $_ArrayModelParams["DTFilterView"]);

        return $this->ArrayModelParams;
    }

    public function init_DTModelPaginate($_ArrayModelParams = array())
    {
        /** Starting paginate variabels and params */
        $this->ArrayModelParams["DTModelPaginate"]["Length"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Length"],
            $_ArrayModelParams["DTModelPaginate"]["Length"]);

        $this->ArrayModelParams["DTModelPaginate"]["Start"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Start"],
            $_ArrayModelParams["DTModelPaginate"]["Start"]);

        $this->ArrayModelParams["DTModelPaginate"]["Draw"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["Draw"],
            $_ArrayModelParams["DTModelPaginate"]["Draw"]);

        $this->ArrayModelParams["DTModelPaginate"]["SearchValue"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["SearchValue"],
            $_ArrayModelParams["DTModelPaginate"]["SearchValue"]);

        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"],
            $_ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"]);

        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"]  
            = $this->init_parse($this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"],
            $_ArrayModelParams["DTModelPaginate"]["OrderColumnDir"]);

        return $this->ArrayModelParams;

    }

    private function init_parse($default_value=NULL, $new_value=NULL)
    {
        if (empty($new_value))
            return $default_value;

        return $new_value;
    }

    public function getTableName()
    {
        return $this->ArrayModelParams["DTModelParams"]["TableName"];
    }

    public function getTableJoin()
    {
        return $this->ArrayModelParams["DTModelParams"]["TableJoin"];
    }

    public function getColumnOrder()
    {
        return $this->ArrayModelParams["DTModelParams"]["ColumnOrder"];
    }

    public function getColumnOrderable()
    {
        return $this->ArrayModelParams["DTModelParams"]["ColumnOrderable"];
    }
   
    public function getColumnReplace()
    {
        return $this->ArrayModelParams["DTModelParams"]["ColumnReplace"];
    }
   
    public function getColumnSearch()
    {
        return $this->ArrayModelParams["DTModelParams"]["ColumnSearch"];
    }
   
    public function getDbConnectionName()
    {
        return $this->ArrayModelParams["DTModelParams"]["DbConnectionName"];
    }

    public function getDTFilterView()
    {
        return $this->ArrayModelParams["DTFilterView"];
    }

    public function getLength()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["Length"];
    }

    public function getStart()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["Start"];
    }

    public function getDraw()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["Draw"];
    }

    public function getSearchValue()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["SearchValue"];
    }

    public function getOrderColumnIndex()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"];
    }

    public function getOrderColumnDir()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"];
    }

    public function getrecordsTotal()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["recordsTotal"];
    }

    public function getrecordsFiltered()
    {
        return $this->ArrayModelParams["DTModelPaginate"]["recordsFiltered"];
    }

    public function getDTModelSQL()
    {
        return $this->ArrayModelParams["DTModelSQL"];
    }

    public function setTableName($_value)
    {
        $this->ArrayModelParams["DTModelParams"]["TableName"] = $_value;
    }

    public function setTColumnOrder($_value)
    {
        $this->ArrayModelParams["DTModelParams"]["ColumnOrder"] = $_value;
    }
   
    public function setColumnOrderable($_value)
    {
        $this->ArrayModelParams["DTModelParams"]["ColumnOrderable"] = $_value;
    }

    public function setColumnReplace($value)
    {
       $this->ArrayModelParams["DTModelParams"]["ColumnReplace"] = $value;
    }
   
    public function setColumnSearch($_value)
    {
        $this->ArrayModelParams["DTModelParams"]["ColumnSearch"] = $_value;
    }
   
    public function setDbConnectionName($_value)
    {
        $this->ArrayModelParams["DTModelParams"]["DbConnectionName"] = $_value;
    }

    public function setDTFilterView($_value)
    {
        $this->ArrayModelParams["DTModelParams"] = $_value;
    }

    public function setLength($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["Length"] = $_value;
    }

    public function setStart($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["Start"] = $_value;
    }

    public function setDraw($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["Draw"] = $_value;
    }

    public function setSearchValue($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["SearchValue"] = $_value;
    }

    public function setOrderColumnIndex($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnIndex"] = $_value;
    }

    public function setOrderColumnDir($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["OrderColumnDir"] = $_value;
    }

    public function setrecordsTotal($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["recordsTotal"] = $_value;
    }

    public function setrecordsFiltered($_value)
    {
        $this->ArrayModelParams["DTModelPaginate"]["recordsFiltered"] = $_value;
    }

    public function setDTModelSQL($_value)
    {
        $this->ArrayModelParams["DTModelSQL"] = $_value;
    }

}
