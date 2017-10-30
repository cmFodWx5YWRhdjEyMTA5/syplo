<?php namespace mondido\settings;
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:51
 * To change this template use File | Settings | File Templates.
 */
/*
Get your merchant password and secret from the Mondido merchant settings page.
*/
class configuration {
    public static $app_settings =  array(
    "api_url" 		=> 'https://api.mondido.com/v1/',
    "username" 		=> 'testshubj285@gmail.com',
    "password" 		=> 'shubham@123',
    "secret" 		=> '$2a$10$nA.uGNZOlUOy3WWAFJmxru',
    "algorithm" 	=> 'md5'
    );

}