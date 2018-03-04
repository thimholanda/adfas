<?php
// todo add support for using product page in multiple product!
// Ex: welcome page url is admin.php?page=bs-product-pages-welcome
// and we cannot detect which product is active

// todo refactor product pages for new home

define( 'BF_PRODUCT_PAGES_URI', BF_URI . 'product-pages/' );
define( 'BF_PRODUCT_PAGES_PATH', BF_PATH . 'product-pages/' );

require_once BF_PRODUCT_PAGES_PATH . 'core/class-bf-product-pages-base.php';

require_once BF_PRODUCT_PAGES_PATH . 'core/class-bf-product-item.php';

require_once BF_PRODUCT_PAGES_PATH . 'core/class-bf-product-multi-step-item.php';

require_once BF_PRODUCT_PAGES_PATH . 'core/class-bf-product-pages.php';

require_once BF_PRODUCT_PAGES_PATH . 'core/functions.php';

