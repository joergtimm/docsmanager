<?php

namespace App\Factory;

use App\Entity\VideoActors;
use App\Repository\VideoActorsRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<VideoActors>
 *
 * @method        VideoActors|Proxy                     create(array|callable $attributes = [])
 * @method static VideoActors|Proxy                     createOne(array $attributes = [])
 * @method static VideoActors|Proxy                     find(object|array|mixed $criteria)
 * @method static VideoActors|Proxy                     findOrCreate(array $attributes)
 * @method static VideoActors|Proxy                     first(string $sortedField = 'id')
 * @method static VideoActors|Proxy                     last(string $sortedField = 'id')
 * @method static VideoActors|Proxy                     random(array $attributes = [])
 * @method static VideoActors|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VideoActorsRepository|RepositoryProxy repository()
 * @method static VideoActors[]|Proxy[]                 all()
 * @method static VideoActors[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static VideoActors[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static VideoActors[]|Proxy[]                 findBy(array $attributes)
 * @method static VideoActors[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VideoActors[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<VideoActors> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<VideoActors> createOne(array $attributes = [])
 * @phpstan-method static Proxy<VideoActors> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<VideoActors> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<VideoActors> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<VideoActors> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<VideoActors> random(array $attributes = [])
 * @phpstan-method static Proxy<VideoActors> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<VideoActors> repository()
 * @phpstan-method static list<Proxy<VideoActors>> all()
 */
final class VideoActorsFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
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
            // ->afterInstantiate(function(VideoActors $videoActors): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VideoActors::class;
    }
}
