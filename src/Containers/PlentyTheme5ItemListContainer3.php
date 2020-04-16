<?php

namespace PlentyTheme5\Containers;

use Plenty\Plugin\Templates\Twig;

class PlentyTheme5ItemListContainer3
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('PlentyTheme5::Containers.ItemLists.ItemList3', ["item" => $arg[0]]);
    }
}