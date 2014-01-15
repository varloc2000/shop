<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Default assortment product options to play with sandbox.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class LoadOptionsData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $option = $this->createOption('Размер ванной', 'Размер', array('2000 х 500', '2000 х 2000', '1800 х 450'));
        $manager->persist($option);

        $option = $this->createOption('Цвет ванной', 'Цвет', array('Красный', 'Голубой', 'Белый', 'Черный'));
        $manager->persist($option);

        $option = $this->createOption('Размер умывальника', 'Размер', array('300 х 500', '400 х 400'));
        $manager->persist($option);

        $option = $this->createOption('Тип смесителя', 'Тип', array('Однорычажный', 'Электронный', 'Двойного излива'));
        $manager->persist($option);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }

    /**
     * Create an option.
     *
     * @param string $name
     * @param string $presentation
     * @param array  $values
     */
    private function createOption($name, $presentation, array $values)
    {
        $option = $this
            ->getOptionRepository()
            ->createNew()
        ;

        $option->setName($name);
        $option->setPresentation($presentation);

        foreach ($values as $text) {
            $value = $this->getOptionValueRepository()->createNew();
            $value->setValue($text);

            $option->addValue($value);
        }

        $this->setReference('Sylius.Option.'.$name, $option);

        return $option;
    }
}
