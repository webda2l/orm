<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Tests\OrmFunctionalTestCase;
use Exception;

class Ticket2481Test extends OrmFunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->_schemaTool->createSchema([
            $this->_em->getClassMetadata(Ticket2481Product::class),
        ]);

        $this->_conn = $this->_em->getConnection();
    }

    public function testEmptyInsert(): void
    {
        $test = new Ticket2481Product();
        $this->_em->persist($test);
        $this->_em->flush();

        self::assertGreaterThan(0, $test->id);
    }
}

/**
 * @Entity
 * @Table(name="ticket_2481_products")
 */
class Ticket2481Product
{
  /**
   * @var int
   * @Id @Column(type="integer")
   * @GeneratedValue(strategy="AUTO")
   */
    public $id;
}
