<?php

namespace App\Factory;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Video>
 *
 * @method        Video|Proxy                     create(array|callable $attributes = [])
 * @method static Video|Proxy                     createOne(array $attributes = [])
 * @method static Video|Proxy                     find(object|array|mixed $criteria)
 * @method static Video|Proxy                     findOrCreate(array $attributes)
 * @method static Video|Proxy                     first(string $sortedField = 'id')
 * @method static Video|Proxy                     last(string $sortedField = 'id')
 * @method static Video|Proxy                     random(array $attributes = [])
 * @method static Video|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VideoRepository|RepositoryProxy repository()
 * @method static Video[]|Proxy[]                 all()
 * @method static Video[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Video[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Video[]|Proxy[]                 findBy(array $attributes)
 * @method static Video[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Video[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Video> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Video> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Video> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Video> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Video> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Video> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Video> random(array $attributes = [])
 * @phpstan-method static Proxy<Video> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Video> repository()
 * @phpstan-method static list<Proxy<Video>> all()

 */
final class VideoFactory extends ModelFactory
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
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'isverrifyted' => self::faker()->boolean(),
            'title' => self::faker()->text(255),

        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Video $video): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Video::class;
    }
}
