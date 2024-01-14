<?php

namespace App\Factory;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use DateTimeImmutable;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Actor>
 *
 * @method        Actor|Proxy                     create(array|callable $attributes = [])
 * @method static Actor|Proxy                     createOne(array $attributes = [])
 * @method static Actor|Proxy                     find(object|array|mixed $criteria)
 * @method static Actor|Proxy                     findOrCreate(array $attributes)
 * @method static Actor|Proxy                     first(string $sortedField = 'id')
 * @method static Actor|Proxy                     last(string $sortedField = 'id')
 * @method static Actor|Proxy                     random(array $attributes = [])
 * @method static Actor|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ActorRepository                 repository()
 * @method static Actor[]|Proxy[]                 all()
 * @method static Actor[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Actor[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Actor[]|Proxy[]                 findBy(array $attributes)
 * @method static Actor[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Actor[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ActorFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->name('female'),
            'bornAt' => DateTimeImmutable::createFromMutable(
                self::faker()->dateTimeBetween('-40 years', '-18 years')
            ),
            'gender' => self::faker()->randomElement(['female', 'male', 'diverse']),
            'profilepic' => self::faker()->randomElement([
                'fm1.jpg',
                'fm2.jpg',
                'fm3.jpg',
                'fm4.jpg',
                'fm5.jpg',
                'fm6.jpg',
                'fm7.jpg',
                'fm8.jpg',
                'fm9.jpg',
                'fm10.jpg',
                'fm11.jpg',
                'fm12.jpg'
            ])
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Actor $actor): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Actor::class;
    }
}
