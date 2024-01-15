<?php

namespace App\Factory;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Participant>
 *
 * @method        Participant|Proxy                     create(array|callable $attributes = [])
 * @method static Participant|Proxy                     createOne(array $attributes = [])
 * @method static Participant|Proxy                     find(object|array|mixed $criteria)
 * @method static Participant|Proxy                     findOrCreate(array $attributes)
 * @method static Participant|Proxy                     first(string $sortedField = 'id')
 * @method static Participant|Proxy                     last(string $sortedField = 'id')
 * @method static Participant|Proxy                     random(array $attributes = [])
 * @method static Participant|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ParticipantRepository|RepositoryProxy repository()
 * @method static Participant[]|Proxy[]                 all()
 * @method static Participant[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Participant[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Participant[]|Proxy[]                 findBy(array $attributes)
 * @method static Participant[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Participant[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Participant> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Participant> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Participant> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Participant> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Participant> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Participant> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Participant> random(array $attributes = [])
 * @phpstan-method static Proxy<Participant> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Participant> repository()

 */
final class ParticipantFactory extends ModelFactory
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
            'bornAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'firstName' => self::faker()->firstName('female'),
            'idNumber' => self::faker()->numerify('####-#####-#######'),
            'idType' => self::faker()->randomElement(['id-card', 'passport']),
            'name' => self::faker()->lastName(),
            'updateAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Participant $participant): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Participant::class;
    }
}
