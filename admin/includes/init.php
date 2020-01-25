<?php
defined ('DS') ? null : define ('DS', DIRECTORY_SEPARATOR);
define ('SITE_ROOT', DS . 'wamp64' . DS . 'www' . DS . 'babitaWebshop');
defined ('INCLUDES_PATH') ? null : define ('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
defined('IMAGES_PATH') ? null : define ('IMAGES_PATH', SITE_ROOT.DS.'admin'.DS.'img');
defined('IMAGES_PATH_PRODUCTS') ? null : define ('IMAGES_PATH_PRODUCTS', SITE_ROOT.DS.'admin'.DS.'img'.DS.'products');
/**

/*php pagina's*/
require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."config.php");
/*objecten*/
require_once(INCLUDES_PATH.DS."Database.php");
require_once (INCLUDES_PATH.DS."Db_object.php");
require_once(INCLUDES_PATH.DS."User.php");
require_once (INCLUDES_PATH.DS."Photo.php");
require_once (INCLUDES_PATH.DS."Order.php");
require_once (INCLUDES_PATH.DS."Category.php");
require_once (INCLUDES_PATH.DS."Order_details.php");
require_once (INCLUDES_PATH.DS."Role.php");
require_once (INCLUDES_PATH.DS."Shopping_cart.php");



require_once (INCLUDES_PATH.DS."Basket.php");
require_once (INCLUDES_PATH.DS."Product.php");
require_once (INCLUDES_PATH.DS."Session.php");
require_once (INCLUDES_PATH.DS."Comment.php");
require_once (INCLUDES_PATH.DS."Paginate.php");


?>