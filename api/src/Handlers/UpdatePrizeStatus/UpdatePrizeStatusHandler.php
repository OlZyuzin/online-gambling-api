<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use OlZyuzin\Handlers\Dto\UpdatePrizeStatusDto;
use OlZyuzin\Models\Prize\Prize;
use OlZyuzin\Models\Prize\PrizeThing;
use OlZyuzin\Models\Prize\PrizeType;
use OlZyuzin\Repositories\Interfaces\PrizeRepositoryInterface;

class UpdatePrizeStatusHandler
{
    private array $handlers;

    public function __construct(
        private PrizeRepositoryInterface $prizeRepository,
        UpdatePrizeThingStatusHandler $updatePrizeThingStatusHandler,
        UpdatePrizeMoneyStatusHandler $updatePrizeMoneyStatusHandler,
    )
    {
        $this->handlers = [
            PrizeType::Thing() => $updatePrizeThingStatusHandler,
            PrizeType::Money() => $updatePrizeMoneyStatusHandler,
        ];
    }

    public function handle(
        int                $prizeId,
        UpdatePrizeStatusDto $dto,
    ): Prize {
        /** @var PrizeThing $prize */
        $prize = $this->prizeRepository->findPrize($prizeId);

        $handler = $this->getHandler($prize->getType());

        $handler->handle(
            $prize,
            $dto->status,
        );

        return $prize;
    }

    /**
     * TODO think of way to return some concrete interface type like UpdatePrizeStatusInterface
     *      at the moment it can't be done because of Liskof principle gets violated
     * @see \OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface
     */
    private function getHandler(PrizeType $type): mixed
    {
        return $this->handlers[$type()];
    }


}