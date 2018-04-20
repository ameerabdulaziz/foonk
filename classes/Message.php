<?php
/**
 * Created by PhpStorm.
 * User: EngAm
 * Date: 2/20/2018
 * Time: 12:57 PM
 *
 * This is a Message Class that has to functions:
 *      - Set Message
 *      - Display Message
 */

class Message
{

    /**
     * This method sets message in SESSION
     *
     * @param $text
     * @param $type
     */
    public static function setMsg($text, $type)
    {
        if ($type === 'error'){
            $_SESSION['error_msg'] = $text;
        } elseif ($type === 'success') {
            $_SESSION['success_msg'] = $text;
        }
    }


    /**
     * This method displays and unset the message in SESSION
     */
    public static function display()
    {
        if(isset($_SESSION['error_msg'])){
            echo '<div class="alert alert-danger text-center">'.$_SESSION['error_msg'].'</div>';
            unset($_SESSION['error_msg']);
        }
        if(isset($_SESSION['success_msg'])){
            echo '<div class="alert alert-success text-center">'.$_SESSION['success_msg'].'</div>';
            unset($_SESSION['success_msg']);
        }
    }

}