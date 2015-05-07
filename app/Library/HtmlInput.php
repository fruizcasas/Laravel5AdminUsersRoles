<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 7/05/15
 * Time: 17:04
 */

namespace App\Library;


class HtmlInput {

    static public function addon($indicator = false, $text ='')
    {
        if (!$indicator) {
            return "<span class='input-group-addon'>$text</span>";
        } else {
            return "<span class='input-group-addon'><span class='glyphicon glyphicon-$indicator'></span></span>";
        }
    }

    static public function has_feedback($errors, $field)
    {
        if ($errors->count() > 0) {
            if ($errors->first($field)) {
                return "has-feedback has-error";
            } else {
                return "has-feedback has-success";
            }
        } else {
            return "";
        }
    }

    static public function get_feedback($errors, $field)
    {
        $result = '';
        foreach ($errors->get($field) as $error) {
            $result .= "<p class='help-block error-msg'>$error</p>" . PHP_EOL;
        };
        if ($errors->count() > 0) {
            if ($errors->first($field)) {
                $result .= '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
            } else {
                $result .= '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>';
            }
        };
        return $result;
    }


}