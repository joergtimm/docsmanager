<?php

namespace App\Factory;

use App\Entity\Documents;
use App\Repository\DocumentsRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Documents>
 *
 * @method        Documents|Proxy                     create(array|callable $attributes = [])
 * @method static Documents|Proxy                     createOne(array $attributes = [])
 * @method static Documents|Proxy                     find(object|array|mixed $criteria)
 * @method static Documents|Proxy                     findOrCreate(array $attributes)
 * @method static Documents|Proxy                     first(string $sortedField = 'id')
 * @method static Documents|Proxy                     last(string $sortedField = 'id')
 * @method static Documents|Proxy                     random(array $attributes = [])
 * @method static Documents|Proxy                     randomOrCreate(array $attributes = [])
 * @method static DocumentsRepository|RepositoryProxy repository()
 * @method static Documents[]|Proxy[]                 all()
 * @method static Documents[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Documents[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Documents[]|Proxy[]                 findBy(array $attributes)
 * @method static Documents[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Documents[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Documents> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Documents> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Documents> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Documents> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Documents> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Documents> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Documents> random(array $attributes = [])
 * @phpstan-method static Proxy<Documents> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Documents> repository()
 * @phpstan-method static list<Proxy<Documents>> all()

 */
final class DocumentsFactory extends ModelFactory
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
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'type' => self::faker()->randomElement([
                'id_shot',
                'id_card_front',
                'id_card_back',
                'contract',
            ]),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Documents $documents): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Documents::class;
    }
}
