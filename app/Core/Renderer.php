<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views/');
        $this->twig = new Environment($loader);
    }

    public function render(TwigView $twigView): string
    {
        return $this->twig->render($twigView->getPath() . '.twig', $twigView->getData());
    }
}