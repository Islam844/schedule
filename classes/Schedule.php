<?php

class Schedule extends Table {
    
    public $schedule_id = 0;
    public $lesson_plan_id = 0;
    public $day_id = 1;
    public $lesson_num_id = 1;
    public $classroom_id = 0;
    
    public function validate() {
        return false;
    }

}
