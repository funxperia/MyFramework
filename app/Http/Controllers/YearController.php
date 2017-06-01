<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/31
 * Time: 13:11
 */

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class YearController extends Controller
{
    public function is_leap_year($year = null){
        if(null === $year){
            $year = date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }

    public function indexAction(Request $request, $year){
        if($this->is_leap_year($year)){
            return new Response('Yep, this is a leep year');
        }

        return new Response('Nope, this is not a leep year');
    }
}