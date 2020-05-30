<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface BannerInterface extends ResourceInterface, CodeAwareInterface
{
    public function getId();

    public function getChannels(): Collection;

    public function getSlides(): ?Collection;
}
