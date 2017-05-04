<?php

namespace OpenLoyalty\Domain\Seller\Command;

use OpenLoyalty\Domain\Seller\Event\SellerWasDeactivated;
use OpenLoyalty\Domain\Seller\Event\SellerWasRegistered;
use OpenLoyalty\Domain\Seller\PosId;
use OpenLoyalty\Domain\Seller\SellerId;

/**
 * Class DeactivateSellerTest.
 */
class DeactivateSellerTest extends SellerCommandHandlerTest
{
    /**
     * @test
     */
    public function it_deactivates_seller()
    {
        $sellerId = new SellerId('00000000-0000-0000-0000-000000000000');
        $data = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'open@loyalty.com',
            'phone' => '123456789',
            'posId' => new PosId('00000000-0000-0000-0000-000000000000'),
            'createdAt' => new \DateTime(),
        ];
        $this->scenario
            ->withAggregateId($sellerId)
            ->given([new SellerWasRegistered($sellerId, $data)])
            ->when(new DeactivateSeller($sellerId))
            ->then(array(
                new SellerWasDeactivated($sellerId)
            ));
    }
}
