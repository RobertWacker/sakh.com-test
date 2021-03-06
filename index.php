<?php

use app\core\Router;

session_start();

/**
* 
*/
define ('ROOT', dirname(__FILE__));
define ('APP', dirname(__FILE__).'/app/');
define ('CONFIG', dirname(__FILE__).'/app/configs/');

/**
* 
*/
include APP.'libs/debug.php';

/**
* 
*/
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

/**
* 
*/
$router = new Router;
$router -> run();


/*

Общие правила на сайте
Общие правила поведения на сайте:

Начнем с того, что на сайте общаются сотни людей, разных религий и взглядов, и все они являются полноправными посетителями нашего сайта, поэтому если мы хотим чтобы это сообщество людей функционировало нам и необходимы правила. Мы настоятельно рекомендуем прочитать настоящие правила, это займет у вас всего минут пять, но сбережет нам и вам время и поможет сделать сайт более интересным и организованным.

Начнем с того, что на нашем сайте нужно вести себя уважительно ко всем посетителям сайта. Не надо оскорблений по отношению к участникам, это всегда лишнее. Если есть претензии - обращайтесь к Админам или Модераторам (воспользуйтесь личными сообщениями). Оскорбление других посетителей считается у нас одним из самых тяжких нарушений и строго наказывается администрацией. У нас строго запрещен расизм, религиозные и политические высказывания. Заранее благодарим вас за понимание и за желание сделать наш сайт более вежливым и дружелюбным.

На сайте строго запрещено: 

- сообщения, не относящиеся к содержанию статьи или к контексту обсуждения
- оскорбление и угрозы в адрес посетителей сайта
- в комментариях запрещаются выражения, содержащие ненормативную лексику, унижающие человеческое достоинство, разжигающие межнациональную рознь
- спам, а также реклама любых товаров и услуг, иных ресурсов, СМИ или событий, не относящихся к контексту обсуждения статьи

Давайте будем уважать друг друга и сайт, на который Вы и другие читатели приходят пообщаться и высказать свои мысли. Администрация сайта оставляет за собой право удалять комментарии или часть комментариев, если они не соответствуют данным требованиям.

При нарушении правил вам может быть дано предупреждение. В некоторых случаях может быть дан бан без предупреждений. По вопросам снятия бана писать администратору.

Оскорбление администраторов или модераторов также караются баном - уважайте чужой труд.

*/
