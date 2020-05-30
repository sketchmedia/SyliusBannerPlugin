<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Repository;

use App\Entity\Channel\Channel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Parameter;
use Sylius\Component\Channel\Model\ChannelInterface;

final class BannerRepository implements BannerRepositoryInterface
{
    private $manager;

    private $class;

    public function __construct(ManagerRegistry $registry, string $class)
    {
        $this->manager = $registry->getManagerForClass($class);
        $this->class = $class;
    }

    public function findBannerForChannel(string $code, ChannelInterface $channel)
    {
        $query = $this->manager->createQuery(<<<DQL
            SELECT banner
            FROM {$this->class} banner
            LEFT JOIN banner.channels channel
            WHERE banner.code = :code AND channel.id = :channel
        DQL
        );

        $query->setParameters(new ArrayCollection([
            new Parameter('code', $code),
            new Parameter('channel', $channel->getId())
        ]));

        return $query->getOneOrNullResult();
    }
}
