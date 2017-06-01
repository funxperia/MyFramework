<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/13
 * Time: 14:52
 */

/*$input = isset($_GET['name']) ? $_GET['name'] : "world";

header("Content-Type:text/html;charset=utf-8");

printf("Hello %s", htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));*/
/*$pathInfo = $request->getPathInfo();
$info1 = explode('/',ltrim($pathInfo,"/"));
$info2 = array();
for($i = 0; $i < count($info1); $i++){
$j = $i;
++$j;
if(isset($info1[$j]) && $i/2!=1)
    $info2[$info1[$i]] = $info1[$j];
}

$input = isset($info2) ? $info2[$info1[0]] : "World";

$method = $request->getMethod();
var_dump($method);

$lang = $request->getLanguages();
var_dump($lang);*/

/*$input = $request->query->get('name','World!');

$response->setContent(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));*/

/*$response->headers->setCookie(new Cookie('foo', 'bar'));*/

/*$name = $request->get('name', 'World') */?>

<!--Hello --><?php /*echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') */?>
<!--Hello --><?php /*echo htmlspecialchars(isset($name) ? $name : 'World', ENT_QUOTES, 'UTF-8') */?>
Hello <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8')?>