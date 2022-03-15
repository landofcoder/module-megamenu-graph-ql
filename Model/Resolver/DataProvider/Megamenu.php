<?php
/**
 * Copyright © landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\MegamenuGraphQl\Model\Resolver\DataProvider;

use Ves\Megamenu\Api\GetMenuByAliasInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;

class Megamenu
{
    /**
     * @var GetMenuByAliasInterface
     */
    private $repository;

    /**
     * @param GetMenuByAliasInterface $repository
     */
    public function __construct(
        GetMenuByAliasInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * get megamenu by alias
     * @param string $alias
     * @param string|int|null $storeId = null
     * @param int $customerGroupId = 0
     * @param bool $isMobile = false
     * @return \Ves\Megamenu\Api\Data\MenuFrontendInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMegamenu($alias, $storeId = null, $customerGroupId = 0, $isMobile = false)
    {
        $megamenu = $this->repository->execute($alias, $storeId, $customerGroupId, $isMobile);
        if (!$megamenu) {
            throw new GraphQlInputException(__('Megamenu with alias %! is not exists.', $alias));
        }
        return $megamenu;
    }
}

