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

namespace Markocupic\ContaoCollapsibleSidebar\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\StringUtil;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class CollapsibleSidebarController extends AbstractFrontendModuleController
{
    public const TYPE = 'collapsible_sidebar';

    protected ContaoFramework $framework;
    protected ?string $cssID;

    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response
    {
        $stringUtil = $this->framework->getAdapter(StringUtil::class);

        // Add a CSS ID if none is set.
        $cssID = $stringUtil->deserialize($model->cssID, true);
        $cssID[0] = empty($cssID[0]) && $cssID[0] ? 'collapsibleSidebar_'.$model->id : $cssID[0];
        $this->cssID = $cssID[0];

        $model->cssID = serialize($cssID);

        return parent::__invoke($request, $model, $section, $classes);
    }

    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        $template->css_id = $this->cssID;

        return $template->getResponse();
    }
}
