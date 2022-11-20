<?php

declare(strict_types=1);

/*
 * This file is part of Contao Collapsible Sidebar.
 *
 * (c) Marko Cupic 2022 <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-collapsible-sidebar
 */

namespace Markocupic\ContaoCollapsibleSidebar\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;

/**
 * Use an insert tag to collapse the sidebar.
 *
 * Inside your TWIG template: {{ '{{collapsible_sidebar_toggle::sidebarID}}' }}
 * Inside your HTML5 template {{collapsible_sidebar_toggle::sidebarID}}
 */
#[AsHook(ReplaceInsertTagsListener::TYPE, priority: 100)]
class ReplaceInsertTagsListener
{
    public const TYPE = 'replaceInsertTags';
    public const TAG = 'collapsible_sidebar_toggle';

    public function __invoke(string $tag): false|string
    {
        $chunks = explode('::', $tag);

        if (self::TAG !== $chunks[0] || empty($chunks[1])) {
            return false;
        }

        $template = new FrontendTemplate(static::TAG);
        $template->aria_controls = $chunks[1];

        return $template->parse();
    }
}
