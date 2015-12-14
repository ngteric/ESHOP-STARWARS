<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 27/11/2015
 * Time: 10:12
 */

trait DebugTrait {
    private function debug($value){
        if(defined('DEBUG') && DEBUG){
            var_dump($value);
        }
    }
}