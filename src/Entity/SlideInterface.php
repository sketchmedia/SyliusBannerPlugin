<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface SlideInterface extends ResourceInterface
{
    public function getFile(): ?\SplFileInfo;

    public function hasFile(): bool;

    public function getPath(): ?string;
}
