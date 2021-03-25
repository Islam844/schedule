<?php

class Special extends Table {
    
    public $special_id = 1;
    public $name = '';
    public $otdel_id = 1;
    public $active = 1;
    
    public function validate() {
        return false;
    }

}
