<?php

namespace App\Factory;

use App\Entity\ContractBlocks;
use App\Repository\ContractBlocksRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ContractBlocks>
 *
 * @method        ContractBlocks|Proxy                     create(array|callable $attributes = [])
 * @method static ContractBlocks|Proxy                     createOne(array $attributes = [])
 * @method static ContractBlocks|Proxy                     find(object|array|mixed $criteria)
 * @method static ContractBlocks|Proxy                     findOrCreate(array $attributes)
 * @method static ContractBlocks|Proxy                     first(string $sortedField = 'id')
 * @method static ContractBlocks|Proxy                     last(string $sortedField = 'id')
 * @method static ContractBlocks|Proxy                     random(array $attributes = [])
 * @method static ContractBlocks|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ContractBlocksRepository|RepositoryProxy repository()
 * @method static ContractBlocks[]|Proxy[]                 all()
 * @method static ContractBlocks[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ContractBlocks[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ContractBlocks[]|Proxy[]                 findBy(array $attributes)
 * @method static ContractBlocks[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ContractBlocks[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<ContractBlocks> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<ContractBlocks> createOne(array $attributes = [])
 * @phpstan-method static Proxy<ContractBlocks> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<ContractBlocks> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<ContractBlocks> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<ContractBlocks> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<ContractBlocks> random(array $attributes = [])
 * @phpstan-method static Proxy<ContractBlocks> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<ContractBlocks> repository()
 * @phpstan-method static list<Proxy<ContractBlocks>> all()

 */
final class ContractBlocksFactory extends ModelFactory
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
            'locale' => 'de_DE',
            'text' => self::faker()->realTextBetween(150, 255),
            'title' => self::faker()->text(25),
            'description' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ContractBlocks $contractBlocks): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ContractBlocks::class;
    }
}
