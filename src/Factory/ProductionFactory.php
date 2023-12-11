<?php

namespace App\Factory;

use App\Entity\Production;
use App\Repository\ProductionRepository;
use DateTimeImmutable;
use Symfony\Component\Uid\Ulid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use function Symfony\Component\String\s;

/**
 * @extends ModelFactory<Production>
 *
 * @method        Production|Proxy                     create(array|callable $attributes = [])
 * @method static Production|Proxy                     createOne(array $attributes = [])
 * @method static Production|Proxy                     find(object|array|mixed $criteria)
 * @method static Production|Proxy                     findOrCreate(array $attributes)
 * @method static Production|Proxy                     first(string $sortedField = 'id')
 * @method static Production|Proxy                     last(string $sortedField = 'id')
 * @method static Production|Proxy                     random(array $attributes = [])
 * @method static Production|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ProductionRepository|RepositoryProxy repository()
 * @method static Production[]|Proxy[]                 all()
 * @method static Production[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Production[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Production[]|Proxy[]                 findBy(array $attributes)
 * @method static Production[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Production[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ProductionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'beginAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-10 years', '-12 days')),
            'status' => self::faker()->text(20),
            'description' => self::faker()->words(35, true) // erstellt einen Textblock
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Production $production): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Production::class;
    }
}
