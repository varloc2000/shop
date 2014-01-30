<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Repository;

use Sylius\Bundle\TaxonomiesBundle\Model\TaxonInterface;
use Sylius\Bundle\VariableProductBundle\Doctrine\ORM\VariableProductRepository;

/**
 * Product repository.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ProductRepository extends VariableProductRepository
{
    /**
     * Create paginator for products categorized
     * under given taxon.
     *
     * @param TaxonInterface $taxon
     *
     * @return PagerfantaInterface
     */
    public function createByTaxonPaginator(TaxonInterface $taxon)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();

        $queryBuilder
            ->innerJoin('product.taxons', 'taxon')
            ->andWhere('taxon = :taxon')
            ->setParameter('taxon', $taxon)
        ;

        return $this->getPaginator($queryBuilder);
    }

    /**
     * Create filter paginator.
     *
     * @param array $criteria
     * @param array $sorting
     *
     * @return PagerfantaInterface
     */
    public function createFilterPaginator($criteria = array(), $sorting = array())
    {
        $queryBuilder = parent::getCollectionQueryBuilder()
            ->select('product, variant')
            ->leftJoin('product.variants', 'variant')
        ;

        if (!empty($criteria['name'])) {
            $queryBuilder
                ->andWhere('product.name LIKE :name')
                ->setParameter('name', '%'.$criteria['name'].'%')
            ;
        }
        if (!empty($criteria['sku'])) {
            $queryBuilder
                ->andWhere('variant.sku = :sku')
                ->setParameter('sku', $criteria['sku'])
            ;
        }

        if (empty($sorting)) {
            if (!is_array($sorting)) {
                $sorting = array();
            }
            $sorting['updatedAt'] = 'desc';
        }

        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }

    /**
     * Find X recently added products.
     *
     * @param integer $limit
     *
     * @return ProductInterface[]
     */
    public function findLatest($limit = 10)
    {
        if (is_array($limit)){
            switch ($limit['block']) {
                case 'recommended':
                    $resault =  $this->findBy(array('isRecommended' => true), array('createdAt' => 'desc'), $limit['limit']);
                    break;
                case 'homepage':
                    $resault =  $this->findBy(array('showOnHomepage' => true), array('createdAt' => 'desc'), $limit['limit']);
                    break;
                default:
                    $resault = array();
                    break;
            }
            return $resault;
        }

        return $this->findBy(array(), array('createdAt' => 'desc'), $limit);
    }
}
