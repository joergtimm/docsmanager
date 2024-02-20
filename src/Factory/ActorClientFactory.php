<?php

namespace App\Factory;

use App\Entity\ActorClient;
use App\Repository\ActorClientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ActorClient>
 *
 * @method        ActorClient|Proxy                     create(array|callable $attributes = [])
 * @method static ActorClient|Proxy                     createOne(array $attributes = [])
 * @method static ActorClient|Proxy                     find(object|array|mixed $criteria)
 * @method static ActorClient|Proxy                     findOrCreate(array $attributes)
 * @method static ActorClient|Proxy                     first(string $sortedField = 'id')
 * @method static ActorClient|Proxy                     last(string $sortedField = 'id')
 * @method static ActorClient|Proxy                     random(array $attributes = [])
 * @method static ActorClient|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ActorClientRepository|RepositoryProxy repository()
 * @method static ActorClient[]|Proxy[]                 all()
 * @method static ActorClient[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ActorClient[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ActorClient[]|Proxy[]                 findBy(array $attributes)
 * @method static ActorClient[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ActorClient[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<ActorClient> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<ActorClient> createOne(array $attributes = [])
 * @phpstan-method static Proxy<ActorClient> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<ActorClient> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<ActorClient> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<ActorClient> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<ActorClient> random(array $attributes = [])
 * @phpstan-method static Proxy<ActorClient> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<ActorClient> repository()
 * @phpstan-method static list<Proxy<ActorClient>> all()

 */
final class ActorClientFactory extends ModelFactory
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

     */
    protected function getDefaults(): array
    {
        return [
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ActorClient $actorClient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ActorClient::class;
    }
}
