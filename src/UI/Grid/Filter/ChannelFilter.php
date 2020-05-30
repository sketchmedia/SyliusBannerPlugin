<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;

class ChannelFilter implements FilterInterface
{
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if ($data['channel'] === '') {
            return;
        }

        $dataSource->restrict($dataSource->getExpressionBuilder()->equals('o.channel.code', $data['channel']));
    }
}
