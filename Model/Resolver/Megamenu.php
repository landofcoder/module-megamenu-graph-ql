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
use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
use Magento\Customer\Api\Data\CustomerInterface;

class Megamenu implements ResolverInterface
{

    /**
     * @var DataProvider\Megamenu
     */
    private $dataProvider;

    /**
     * @var GetCustomer
     */
    private $getCustomer;

    /**
     * @param DataProvider\Megamenu $dataProvider
     * @param GetCustomer $getCustomer
     */
    public function __construct(
        DataProvider\Megamenu $dataProvider,
        GetCustomer $getCustomer
    ) {
        $this->dataProvider = $dataProvider;
        $this->getCustomer = $getCustomer;
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
        $store = $context->getExtensionAttributes()->getStore();
        $customerGroupId = 0;
        if ($context->getExtensionAttributes()->getIsCustomer()) {
            /** @var CustomerInterface */
            $customer = $this->getCustomer->execute($context);
            $customerGroupId = $customer->getGroupId();
        }
        $isMobile = isset($args["isMobile"]) && $args["isMobile"] ? true: false;
        return $this->dataProvider->getMegamenu($args["alias"], $store->getCode(), (int)$customerGroupId, $isMobile);
    }

    /**
     * @param array $args
     *
     * @throws GraphQlInputException
     */
    public function validateArgs($args)
    {
        if (!isset($args['alias']) || (isset($args['alias']) && empty($args['alias']))) {
            throw new GraphQlInputException(__('Required parameter "alias" is missing'));
        }
    }
}

