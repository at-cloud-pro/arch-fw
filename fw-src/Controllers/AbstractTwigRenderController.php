<?php declare(strict_types=1);

namespace ArchFW\Controllers;

use ArchFW\Renderers\RenderableInterface;

abstract class AbstractTwigRenderController extends AbstractRenderController
{
    /** @var RenderableInterface */
    private $renderer;

    public function setRenderer(RenderableInterface $renderer): self
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * @param string $templateName
     * @param array  $vars
     * @return string
     */
    public function render(string $templateName, array $vars = []): string
    {
        header('Content-Type text/html');
        return $this->renderer->render($templateName, $vars);
    }
}
