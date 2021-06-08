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

class Megamenu implements ResolverInterface
{

    private $dataProvider;

    /**
     * @param DataProvider\Megamenu $dataProvider
     */
    public function __construct(
        DataProvider\Megamenu $dataProvider
    ) {
        $this->dataProvider = $dataProvider;
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
        $this->validateArgs($args);
        $alias = $args["alias"];
        $storeId = isset($args["storeId"])?$args["storeId"]:null;
        $megamenuData = $this->dataProvider->getMegamenu($alias, $storeId);
        return $megamenuData;
    }

    /**
     * @param array $args
     *
     * @throws GraphQlInputException
     */
    public function validateArgs($args)
    {
        if (!isset($args['alias']) || (isset($args['alias']) && !$args['alias'])) {
            throw new GraphQlInputException(__('Required parameter "alias" is missing'));
        }
    }
}

