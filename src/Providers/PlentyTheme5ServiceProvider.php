<?php

namespace PlentyTheme5\Providers;

//use Ceres\Caching\NavigationCacheSettings;
//use Ceres\Caching\SideNavigationCacheSettings;
use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\TemplateContainer;
use IO\Extensions\Functions\Partial;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;
use Plenty\Plugin\ConfigRepository;
use PlentyTheme5\Contexts\ThemeNameSingleItemContext;

/**
 * Class PlentyTheme5ServiceProvider
 * @package PlentyTheme5\Providers
 */
class PlentyTheme5ServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher, ConfigRepository $config)
    {

        $enabledOverrides = explode(", ", $config->get("PlentyTheme5.templates.override"));


        $dispatcher->listen('IO.ctx.item', function (TemplateContainer $templateContainer, $templateData = [])
        {
            $templateContainer->setContext( ThemeNameSingleItemContext::class);
            return false;
        }, 0);


        // Override partials
        $dispatcher->listen('IO.init.templates', function (Partial $partial) use ($enabledOverrides)
        {
            //pluginApp(Container::class)->register('PlentyTheme5::PageDesign.Partials.Header.NavigationList.twig', NavigationCacheSettings::class);
            //pluginApp(Container::class)->register('PlentyTheme5::PageDesign.Partials.Header.SideNavigation.twig', SideNavigationCacheSettings::class);

            $partial->set('head', 'Ceres::PageDesign.Partials.Head');
            $partial->set('header', 'Ceres::PageDesign.Partials.Header.Header');
            $partial->set('page-design', 'Ceres::PageDesign.PageDesign');
            $partial->set('footer', 'Ceres::PageDesign.Partials.Footer');

            if (in_array("head", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('head', 'PlentyTheme5::PageDesign.Partials.Head');
            }

            if (in_array("header", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('header', 'PlentyTheme5::PageDesign.Partials.Header.Header');
            }

            if (in_array("page_design", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('page-design', 'PlentyTheme5::PageDesign.PageDesign');
            }

            if (in_array("footer", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('footer', 'PlentyTheme5::PageDesign.Partials.Footer');
            }

            return false;
        }, self::PRIORITY);

        // Override homepage
        if (in_array("homepage", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.home', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Homepage.Homepage');
                return false;
            }, self::PRIORITY);
        }

        // Override template for content categories
        if (in_array("category_content", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.category.content', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Category.Content.CategoryContent');
                return false;
            }, self::PRIORITY);
        }

        // Override category view
        if (in_array("category_view", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.category.item', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Category.Item.CategoryItem');
                return false;
            }, self::PRIORITY);
        }

        // Override shopping cart
        if (in_array("basket", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.basket', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Basket.Basket');
                return false;
            }, self::PRIORITY);
        }

        // Override checkout
        if (in_array("checkout", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.checkout', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Checkout.CheckoutView');
                return false;
            }, self::PRIORITY);
        }

        // Override order confirmation page
        if (in_array("order_confirmation", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.confirmation', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Checkout.OrderConfirmation');
                return false;
            }, self::PRIORITY);
        }

        // Override login page
        if (in_array("login", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.login', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Customer.Login');
                return false;
            }, self::PRIORITY);
        }

        // Override register page
        if (in_array("register", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.register', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Customer.Register');
                return false;
            }, self::PRIORITY);
        }

        // Override single item page
        if (in_array("item", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Item.SingleItemWrapper');
                return false;
            }, self::PRIORITY);
        }

        // Override search view
        if (in_array("search", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.search', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::ItemList.ItemListView');
                return false;
            }, self::PRIORITY);
        }

        // Override my account
        if (in_array("my_account", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.my-account', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::MyAccount.MyAccountView');
                return false;
            }, self::PRIORITY);
        }

        // Override wish list
        if (in_array("wish_list", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.wish-list', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::WishList.WishListView');
                return false;
            }, self::PRIORITY);
        }

        // Override contact page
        if (in_array("contact", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.contact', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Customer.Contact');
                return false;
            }, self::PRIORITY);
        }

        // Override order return view
        if (in_array("order_return", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.order.return', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::OrderReturn.OrderReturnView');
                return false;
            }, self::PRIORITY);
        }

        // Override order return confirmation
        if (in_array("order_return_confirmation", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.order.return.confirmation', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::OrderReturn.OrderReturnConfirmation');
                return false;
            }, self::PRIORITY);
        }

        // Override cancellation rights
        if (in_array("cancellation_rights", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.cancellation-rights', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.CancellationRights');
                return false;
            }, self::PRIORITY);
        }

        // Override cancellation form
        if (in_array("cancellation_form", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.cancellation-form', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.CancellationForm');
                return false;
            }, self::PRIORITY);
        }

        // Override legal disclosure
        if (in_array("legal_disclosure", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.legal-disclosure', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.LegalDisclosure');
                return false;
            }, self::PRIORITY);
        }

        // Override privacy policy
        if (in_array("privacy_policy", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.privacy-policy', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.PrivacyPolicy');
                return false;
            }, self::PRIORITY);
        }

        // Override terms and conditions
        if (in_array("terms_conditions", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.terms-conditions', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.TermsAndConditions');
                return false;
            }, self::PRIORITY);
        }

        // Override item not found page
        if (in_array("item_not_found", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.item-not-found', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.ItemNotFound');
                return false;
            }, self::PRIORITY);
        }

        // Override page not found page
        if (in_array("page_not_found", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.page-not-found', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::StaticPages.PageNotFound');
                return false;
            }, self::PRIORITY);
        }

        // Override newsletter opt-out page
        if (in_array("newsletter_opt_out", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.newsletter.opt-out', function (TemplateContainer $container)
            {
                $container->setTemplate('PlentyTheme5::Newsletter.NewsletterOptOut');
                return false;
            }, self::PRIORITY);
        }

        $enabledResultFields = [];

        if(!empty($config->get("PlentyTheme5.result_fields.override")))
        {
            $enabledResultFields = explode(", ", $config->get("PlentyTheme5.result_fields.override"));
        }

        if(!empty($enabledResultFields))
        {
            $dispatcher->listen( 'IO.ResultFields.*', function(ResultFieldTemplate $templateContainer) use ($enabledResultFields)
            {
                $templatesToOverride = [];
                
                // Override list item result fields
                if (in_array("list_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_LIST_ITEM] = 'PlentyTheme5::ResultFields.ListItem';
                }
                
                // Override single item view result fields
                if (in_array("single_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_SINGLE_ITEM] = 'PlentyTheme5::ResultFields.SingleItem';
                }
                
                // Override basket item result fields
                if (in_array("basket_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_BASKET_ITEM] = 'PlentyTheme5::ResultFields.BasketItem';
                }

                // Override auto complete list item result fields
                if (in_array("auto_complete_list_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_AUTOCOMPLETE_ITEM_LIST] = 'PlentyTheme5::ResultFields.AutoCompleteListItem';
                }
                
                // Override category tree result fields
                if (in_array("category_tree", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_CATEGORY_TREE] = 'PlentyTheme5::ResultFields.CategoryTree';
                }

                $templateContainer->setTemplates($templatesToOverride);
            }, self::PRIORITY);
        }
    }
}
