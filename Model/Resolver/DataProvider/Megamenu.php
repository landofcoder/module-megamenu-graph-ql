<?php
/**
 * Copyright © landofcoder.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\MegamenuGraphQl\Model\Resolver\DataProvider;

use Ves\Megamenu\Api\MenuRepositoryInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;

class Megamenu
{

    private $repository;

    /**
     * @param MenuRepositoryInterface $repository
     */
    public function __construct(
        MenuRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * get megamenu by id
     * @param int $id
     * @param int|null $storeId
     * @return \Ves\Megamenu\Api\Data\MenuInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMegamenu($id, $storeId = null)
    {
        $megamenu = $this->repository->getByAlias($id, $storeId);
        if (!$megamenu) {
            throw new GraphQlInputException(__('Megamenu Id does not match any records.'));
        }
        return $megamenu;
    }
}

