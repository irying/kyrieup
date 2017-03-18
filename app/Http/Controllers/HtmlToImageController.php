<?php
/**
 * Created by PhpStorm.
 * User: kyrie
 * Date: 2017/3/7
 * Time: 下午10:58
 */

namespace App\Http\Controllers;


use Anam\PhantomMagick\Converter;

class HtmlToImageController extends Controller
{
    public function index()
    {

        $converter = new Converter();
        $converter->source('http://www.baidu.com')
            ->toPng()
//            ->download('yahoo.png', true);
//        var_dump($converter);
            ->save('./baidu.png');
    }
}