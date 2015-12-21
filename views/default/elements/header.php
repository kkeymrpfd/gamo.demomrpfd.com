<?php
    Core::ensure_defaults(array(
        'title' => (isset($input['title'])) ? $input['title'] : null,
        'page' => (isset($input['page'])) ? $input['page'] : null,
        'bodyClasses' => (isset($input['bodyClasses'])) ? $input['bodyClasses'] : 'body'
    ), $input);
    $siteName = 'Dell Overdrive';
    $input['title'] = str_replace('Blue Coat', 'Dell Overdrive', $input['title']);
?>
<? $view_output .= '
<!doctype html>
<html lang="en" class="' . $input['bodyClasses'] . '">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>
'; ?>
<?php if (!empty($input['title'])) : ?>
<? $view_output .= '
        ' . $input['title']  . ' &mdash;
'; ?>
<?php endif; ?>
<? $view_output .= '
        ' . $siteName . '
    </title>
    <link type="image/x-icon" rel="icon" href="/favicon.ico" />
    
    <link rel="stylesheet" href="/css/fonts.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/reset.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/main.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/responsive.css" type="text/css" media="all" />
    <link href="css/impromptu.css" rel="stylesheet" media="screen">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="apple-touch-icon" href="/img/site-icon.png" />
    <link rel="apple-touch-icon-precomposed" href="/img/site-icon.png" />
	<meta name="apple-mobile-web-app-title" content="' . $siteName . '" />
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="/css/ie.css" type="text/css" media="all" />
    <!--<![endif]-->
    <script type="text/javascript" src="/js/modernizr.custom.96844.js"></script>
    <script type="text/javascript" src="/js/core.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/impromptu.js"></script>
    <script type="text/javascript">
        var preloadImages = [
            "/img/input-checkbox-unchecked.png",
            "/img/input-checkbox-unchecked.svg",
            "/img/input-checkbox-checked.png",
            "/img/input-checkbox-checked.svg"
        ];
    </script>
</head>
<body class="' . $input['bodyClasses'] . '">
    <div id="site">
'; ?>