<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Hhcom\CreativeContaoBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\CalendarBundle\ContaoCalendarBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Hhcom\CreativeContaoBundle\CreativeContaoBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(CreativeContaoBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ContaoFaqBundle::class,
                    ContaoNewsBundle::class,
                    ContaoNewsletterBundle::class,
                    ContaoCalendarBundle::class,
                    ContaoCommentsBundle::class
                    ]),
        ];
    }
}
