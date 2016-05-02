# Welcome to Scherzo!
A PHP micro-framework for static websites - Now dareboost.com 100% ready

[https://scherzo.io](https://scherzo.io "https://scherzo.io")

###What is Scherzo ?
Scherzo is an easy-to-use micro-framework allowing static websites to have Symfony-inspired router and views.

#####With Scherzo, you get :

1 : Easy-to-use router :
```
$routes = array(
    '/' => 'index.html.twig',
    '/your-page' => 'your-file.html.twig',
);
```

2 : Twig cache and templates with inheritance and variables :
```
$twigVars = array(
    'request' => $REQUEST,
    'whatever' => $whatever,
);
```

3 : And a easy-to-switch devmode to see your modifications and clear the cache automatically !

###How to setup Scherzo ?
1. Run `git clone https://github.com/AymericWilke/scherzo-php.git`
2. Create a folder at the root of your project with the name "temp" and read/write access
3. Run a `composer update` in order to get Twig


####Why Scherzo ?
I build websites for living. For the big ones, I use Symfony, and I wanted a Symfony-like thing for the little sites.

Because I hate to have to copy-paste the menu on all pages, for example. And to redeclare css and js files in all the head of the files. So I wanted Twig to inherit my templates, and do all the cache thing.

Then, I got rid of the '/page.html' urls, transforming them in '/page' instead.

Those ideas took a few months and a few iterations to be all in one file. But now that I have been using the same version of it for some time now, I just putted it on GitHub so it's even easier to set up.
