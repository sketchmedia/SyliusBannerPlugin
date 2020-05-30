<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;

class Banner implements BannerInterface
{
    private $id;

    private $code;

    private $name;

    private $channels;

    private $slides;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
        $this->slides = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function getSlides(): Collection
    {
        return $this->slides;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    public function addSlide(SlideInterface $slide): void
    {
        $this->slides->add($slide);
        $slide->setBanner($this);
    }

    public function removeSlide(SlideInterface $slide): void
    {
        if ($this->hasSlide($slide)) {
            $this->slides->removeElement($slide);
            $slide->setBanner(null);
        }
    }

    public function hasSlide(SlideInterface $slide): bool
    {
        return $this->slides->contains($slide);
    }

    public function hasSlides(): bool
    {
        return false === $this->slides->isEmpty();
    }
}
