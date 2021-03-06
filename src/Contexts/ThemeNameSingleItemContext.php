<?php
namespace PlentyTheme5\Contexts;

use IO\Helper\ContextInterface;
use Ceres\Contexts\SingleItemContext;
use Plenty\Modules\Item\Item\Contracts\ItemRepositoryContract;

class ThemeNameSingleItemContext extends SingleItemContext implements ContextInterface
{
  public $themeItem;

  public function init($params)
  {
    parent::init($params);
    $itemRep =  pluginApp(ItemRepositoryContract::class);
    $this->themeItem= $itemRep->show($this->item['documents'][0]['data']['item']['id']);
  }
}
?>