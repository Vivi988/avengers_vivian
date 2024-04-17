<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class TraductionI18NController extends AbstractController
{
    #[Route(path: [
        'en' => '/en/trad-i18n',
        'fr' => '/fr/trad-i18n'
    ], name: 'app_traduction_i18_n')]
    public function index(TranslatorInterface $translator): Response
    {
        return $this->render('traduction_i18_n/index.html.twig', [
            'controller_name' => 'TraductionI18NController',
            "trad" => $translator->trans('texte.traduire'),
            "bonjour" => $translator->trans('dit.bonjour', ['prenom' => 'Gérard']),
            "nb_livres" => $translator->trans('nb_livres', ['nb' => '1']),
            "amis" => $translator->trans('amis', [
                'prenom' => 'Gérard',
                'genre' => 'masculin'
            ])
        ]);
    }
}
