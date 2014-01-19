<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\WebBundle\Menu;

use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main menu builder.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class BackendMenuBuilder extends MenuBuilder
{
    /**
     * Builds backend main menu.
     *
     * @param Request $request
     *
     * @return ItemInterface
     */
    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav navbar-nav navbar-right'
            )
        ));

        $childOptions = array(
            'attributes'         => array('class' => 'dropdown'),
            'childrenAttributes' => array('class' => 'dropdown-menu'),
            'labelAttributes'    => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#')
        );

        $menu->addChild('dashboard', array(
            'route' => 'sylius_backend_dashboard'
        ))->setLabel($this->translate('sylius.backend.menu.main.dashboard'));

        $this->addAssortmentMenu($menu, $childOptions, 'main');
        $this->addConfigurationMenu($menu, $childOptions, 'main');
        $this->addCustomersMenu($menu, $childOptions, 'main');

        $menu->addChild('homepage', array(
            'route' => 'sylius_homepage'
        ))->setLabel($this->translate('sylius.backend.menu.main.homepage'));

        $menu->addChild('logout', array(
            'route' => 'fos_user_security_logout'
        ))->setLabel($this->translate('sylius.backend.logout'));

        return $menu;
    }

    /**
     * Builds backend sidebar menu.
     *
     * @param Request $request
     *
     * @return ItemInterface
     */
    public function createSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav'
            )
        ));

        $childOptions = array(
            'childrenAttributes' => array('class' => 'nav'),
            'labelAttributes'    => array('class' => 'nav-header')
        );

        $this->addAssortmentMenu($menu, $childOptions, 'sidebar');
        $this->addCustomersMenu($menu, $childOptions, 'sidebar');
        $this->addConfigurationMenu($menu, $childOptions, 'sidebar');

        return $menu;
    }

    /**
     * Add assortment menu.
     *
     * @param ItemInterface $menu
     * @param array         $childOptions
     * @param string        $section
     */
    protected function addAssortmentMenu(ItemInterface $menu, array $childOptions, $section)
    {
        $child = $menu
            ->addChild('assortment', $childOptions)
            ->setLabel($this->translate(sprintf('sylius.backend.menu.%s.assortment', $section)))
        ;

        $child->addChild('taxonomies', array(
            'route' => 'sylius_backend_taxonomy_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-folder-close'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.taxonomies', $section)));

        $child->addChild('products', array(
            'route' => 'sylius_backend_product_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-th-list'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.products', $section)));

        $child->addChild('options', array(
            'route' => 'sylius_backend_option_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-th'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.options', $section)));

        $child->addChild('properties', array(
            'route' => 'sylius_backend_property_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-list-alt'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.properties', $section)));

        $child->addChild('prototypes', array(
            'route' => 'sylius_backend_prototype_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-compressed'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.prototypes', $section)));

        $child->addChild('promotions', array(
            'route' => 'sylius_backend_promotion_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-bullhorn'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.promotions', $section)));
    }

    /**
     * Add customers menu.
     *
     * @param ItemInterface $menu
     * @param array         $childOptions
     * @param string        $section
     */
    protected function addCustomersMenu(ItemInterface $menu, array $childOptions, $section)
    {
        // $child = $menu
        //     ->addChild('customer', $childOptions)
        //     ->setLabel($this->translate(sprintf('sylius.backend.menu.%s.customer', $section)))
        // ;

        // $child->addChild('users', array(
        //     'route' => 'sylius_backend_user_index',
        //     'labelAttributes' => array('icon' => 'glyphicon glyphicon-user'),
        // ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.users', $section)));
    }

    /**
     * Add configuration menu.
     *
     * @param ItemInterface $menu
     * @param array         $childOptions
     * @param string        $section
     */
    protected function addConfigurationMenu(ItemInterface $menu, array $childOptions, $section)
    {
        $child = $menu
            ->addChild('configuration', $childOptions)
            ->setLabel($this->translate(sprintf('sylius.backend.menu.%s.configuration', $section)))
        ;

        $child->addChild('general_settings', array(
            'route' => 'sylius_backend_general_settings',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-info-sign'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.general_settings', $section)));

        $child->addChild('exchange_rates', array(
            'route' => 'sylius_backend_exchange_rate_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-usd'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.exchange_rates', $section)));
    }
}
