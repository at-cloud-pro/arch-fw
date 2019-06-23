<?php declare(strict_types=1);

namespace ArchFW\Renderers;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

/**
 * Represents a renderer
 *
 * @package ArchFW\Renderers
 */
class TwigRenderer implements RenderableInterface
{
    /** @var Environment */
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../templates');
        $this->twig = new Environment($loader, [
//            'cache' => '/path/to/compilation_cache',
        ]);

    }

    /**
     * @param string $templateName
     * @param array  $vars
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $templateName, array $vars = []): string
    {
        $template = $this->twig->load($templateName);
        return $template->render($vars);
    }
}
