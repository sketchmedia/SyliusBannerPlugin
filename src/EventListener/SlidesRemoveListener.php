<?php
/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the Sylius LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Black\SyliusBannerPlugin\EventListener;

use Black\SyliusBannerPlugin\Entity\SlideInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Sylius\Component\Core\Model\ImageInterface;
use Black\SyliusBannerPlugin\Uploader\SlideUploaderInterface;

final class SlidesRemoveListener
{
    private $slideUploader;

    private $cacheManager;

    private $filterManager;

    private $imagesToDelete = [];

    public function __construct(
        SlideUploaderInterface $slideUploader,
        CacheManager $cacheManager,
        FilterManager $filterManager
    ) {
        $this->slideUploader = $slideUploader;
        $this->cacheManager = $cacheManager;
        $this->filterManager = $filterManager;
    }

    public function onFlush(OnFlushEventArgs $event): void
    {
        foreach ($event->getEntityManager()->getUnitOfWork()->getScheduledEntityDeletions() as $entityDeletion) {
            if (false === $entityDeletion instanceof SlideInterface) {
                continue;
            }

            $path = $entityDeletion->getPath();

            if (null === $path) {
                continue;
            }

            if (false === in_array($path, $this->imagesToDelete, true)) {
                $this->imagesToDelete[] = $path;
            }
        }
    }

    public function postFlush(PostFlushEventArgs $event): void
    {
        foreach ($this->imagesToDelete as $key => $imagePath) {
            $this->slideUploader->remove($imagePath);
            $this->cacheManager->remove($imagePath, array_keys($this->filterManager->getFilterConfiguration()->all()));
            unset($this->imagesToDelete[$key]);
        }
    }
}
