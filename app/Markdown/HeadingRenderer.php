<?php

namespace App\Markdown;

use Illuminate\Support\Str;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\HeadingRenderer as BaseHeadingRenderer;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;

class HeadingRenderer extends BaseHeadingRenderer
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $element = parent::render($block, $htmlRenderer, $inTightList);

        $id = Str::slug($element->getContents());

        $element->setAttribute('id', $id);
        
        $element->setContents(
            $element->getContents() .
            new HtmlElement('a', ['href' => "#{$id}", 'class' => 'anchor-link'])
        );

        return $element;
    }
}
