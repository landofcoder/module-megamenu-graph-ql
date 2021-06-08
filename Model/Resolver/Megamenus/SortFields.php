<?php
/**
 * Copyright © landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\MegamenuGraphQl\Model\Resolver\Megamenus;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;

/**
 * Retrieves the sort fields data
 */
class SortFields implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $sortFieldsOptions = [
            ['label' => "menu_id", 'value' => "menu_id"],
            ['label' => "creation_time", 'value' => "creation_time"],
            ['label' => "update_time", 'value' => "update_time"],
            ['label' => "status", 'value' => "status"],
            ['label' => "name", 'value' => "name"]
        ];
        
        $data = [
            'default' => "menu_id",
            'options' => $sortFieldsOptions,
        ];

        return $data;
    }
}
