<?php

namespace Sylius\Bundle\PromotionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromoController extends Controller
{
    /**
     * @param  Request $request
     * @return Response
     */
    public function promoBlockAction(Request $request)
    {
        $promos = $this->get('sylius.repository.promotion')->findAll();

        return $this->render('SyliusWebBundle:Frontend/Homepage:promotions_block.html.twig', array(
            'promos' => $promos,
        ));
    }
}
