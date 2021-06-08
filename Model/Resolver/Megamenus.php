<?php
/**
 * Copyright © landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\MegamenuGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Megamenus implements ResolverInterface
{

    private $megamenuDataProvider;

    /**
     * @param DataProvider\Megamenus $lofBannerImagesRepository
     */
    public function __construct(
        DataProvider\Megamenus $megamenuDataProvider
    ) {
        $this->megamenuDataProvider = $megamenuDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $megamenusData = $this->megamenuDataProvider->getMegamenus(
            $args, 
            $context
        );
        return $megamenusData;
    }
}

