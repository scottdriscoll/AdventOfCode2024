<?php

namespace App\Controller;

use App\Solutions\SolutionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    /**
     * @param array<string, SolutionInterface> $solutions
     */
    #[Route('/', name: 'app_default')]
    public function index(
        #[TaggedIterator(SolutionInterface::class)]
        iterable $solutions
    ): Response
    {
        return $this->render('default/index.html.twig', [
            'solutions' => $solutions,
        ]);
    }
}
