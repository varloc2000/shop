<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Settings;

use Sylius\Bundle\SettingsBundle\Schema\SchemaInterface;
use Sylius\Bundle\SettingsBundle\Schema\SettingsBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Locale;
use Symfony\Component\Validator\Constraints\Currency;

/**
 * General settings schema.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class GeneralSettingsSchema implements SchemaInterface
{
    /**
     * @var array
     */
    protected $defaults;

    /**
     * @param array $defaults
     */
    public function __construct(array $defaults = array())
    {
        $this->defaults = $defaults;
    }

    /**
     * {@inheritdoc}
     */
    public function buildSettings(SettingsBuilderInterface $builder)
    {
        $builder
            ->setDefaults(array_merge(array(
                'title'            => 'Магазин сантехники',
                'meta_keywords'    => 'Сантехника, интернет магазин, интернет-магазин, магазин, ванны, Минск, Беларусь',
                'meta_description' => 'Интернет магазин мантехники в Минске.',
                'phones' => array(
                    array(
                        'operator' => 'velcom',
                        'number' => '80295555555',
                    ),
                    array(
                        'operator' => 'мтс',
                        'number' => '80291111111',
                    ),
                ),
                'skype' => 'skypename',
                'promo' => 'Интернет магазин сантехники от известных производителей',
                'email' => 'shop@gmail.com',
                'address' => 'Minsk',
                // 'locale'           => 'en',
                'currency'         => 'USD',
            ), $this->defaults))
            ->setAllowedTypes(array(
                'title'            => array('string'),
                'meta_keywords'    => array('string'),
                'meta_description' => array('string'),
                // 'locale'           => array('string'),
                'phones'           => array('array'),
                'skype'           => array('string', 'null'),
                'promo'           => array('string', 'null'),
                'email'           => array('string', 'null'),
                'address'           => array('string', 'null'),
                'currency'         => array('string'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('title', 'text', array(
                'label'       => 'sylius.form.settings.general.title',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('meta_keywords', 'text', array(
                'label'       => 'sylius.form.settings.general.meta_keywords',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('meta_description', 'textarea', array(
                'label'       => 'sylius.form.settings.general.meta_description',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('phones', 'collection', array(
                'type'         => 'sylius_phone',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'sylius.form.settings.general.phones',
            ))
            ->add('promo', 'text', array())
            ->add('skype', 'text', array())
            ->add('email', 'email', array())
            ->add('address', 'text', array(
                'label'        => 'sylius.form.settings.general.address',
            ))
            // ->add('locale', 'locale', array(
            //     'label'       => 'sylius.form.settings.general.locale',
            //     'constraints' => array(
            //         new NotBlank(),
            //         new Locale(),
            //     )
            // ))
            ->add('currency', 'currency', array(
                'label'       => 'sylius.form.settings.general.currency',
                'constraints' => array(
                    new NotBlank(),
                    new Currency(),
                )
            ))
        ;
    }
}
