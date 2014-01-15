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
 * Default taxonomies to play with Sylius.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class LoadTaxonomiesData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createTaxonomy(1, 'Категории', array(
            'Ванны',
            'Мойки кухонные',
            'Мойки для ванных комнат',
            'Душевые кабины',
            'Поддоны душевые',
            'Унитазы',
        )));

        $manager->persist($this->createTaxonomy(2, 'Производители', array(
            'Керамин',
            'Будфарфор',
            'Sanplast',
            'Kolo',
            'Jacob Delafon',
            'Cersanit',
            'ZorG',
        )));

        $manager->flush();
    }

    /**
     * Create and save taxonomy with given taxons.
     *
     * @param string $name
     * @param array  $taxons
     */
    private function createTaxonomy($number, $name, array $taxons)
    {
        $taxonomy = $this
            ->getTaxonomyRepository()
            ->createNew()
        ;

        $taxonomy->setName($name);

        foreach ($taxons as $key => $taxonName) {
            $taxon = $this
                ->getTaxonRepository()
                ->createNew()
            ;

            $taxon->setName($taxonName);

            $taxonomy->addTaxon($taxon);
            $this->setReference('Sylius.Taxon.'.$key, $taxon);
        }

        $this->setReference('Sylius.Taxonomy.'.$number, $taxonomy);

        return $taxonomy;
    }

    public function getOrder()
    {
        return 5;
    }
}
