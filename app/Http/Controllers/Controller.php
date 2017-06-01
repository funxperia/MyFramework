<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/31
 * Time: 15:00
 */

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function render_template(Request $request){
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__.'/../../../resources/views/%s.php', $_route);

        return new Response(ob_get_clean());
    }
}