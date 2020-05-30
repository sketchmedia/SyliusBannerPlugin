<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Repository;

use Sylius\Component\Channel\Model\ChannelInterface;

interface BannerRepositoryInterface
{
    public function findBannerForChannel(string $banner, ChannelInterface $channel);
}
