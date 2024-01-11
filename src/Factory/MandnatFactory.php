<?php

namespace App\Factory;

use App\Entity\Mandnat;
use App\Repository\MandnatRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Mandnat>
 *
 * @method        Mandnat|Proxy                     create(array|callable $attributes = [])
 * @method static Mandnat|Proxy                     createOne(array $attributes = [])
 * @method static Mandnat|Proxy                     find(object|array|mixed $criteria)
 * @method static Mandnat|Proxy                     findOrCreate(array $attributes)
 * @method static Mandnat|Proxy                     first(string $sortedField = 'id')
 * @method static Mandnat|Proxy                     last(string $sortedField = 'id')
 * @method static Mandnat|Proxy                     random(array $attributes = [])
 * @method static Mandnat|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MandnatRepository|RepositoryProxy repository()
 * @method static Mandnat[]|Proxy[]                 all()
 * @method static Mandnat[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Mandnat[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Mandnat[]|Proxy[]                 findBy(array $attributes)
 * @method static Mandnat[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Mandnat[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Mandnat> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Mandnat> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Mandnat> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Mandnat> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Mandnat> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Mandnat> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Mandnat> random(array $attributes = [])
 * @phpstan-method static Proxy<Mandnat> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Mandnat> repository()
 * @phpstan-method static list<Proxy<Mandnat>> all()

 */
final class MandnatFactory extends ModelFactory
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
            'conId' => strval(self::faker()->numberBetween(25414785, 95847123)),
            'name' => self::faker()->name(),
            'status' => self::faker()->randomElement(['beantragt', 'arbeit', 'sandbox', 'prod' ]),
            'customNr' => strval(self::faker()->numberBetween(14254, 95412)),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function (Mandnat $mandnat): void {
             })
        ;
    }

    protected static function getClass(): string
    {
        return Mandnat::class;
    }
}
