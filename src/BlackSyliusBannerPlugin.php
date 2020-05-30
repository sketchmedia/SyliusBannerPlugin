<?php

declare(strict_types=1);

namespace Black\SyliusBannerPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Black\SyliusBannerPlugin\Compiler\ImagePass;

final class BlackSyliusBannerPlugin extends Bundle
{
    use SyliusPluginTrait;
}
