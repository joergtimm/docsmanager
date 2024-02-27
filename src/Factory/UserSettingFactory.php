<?php

namespace App\Factory;

use App\Entity\UserSetting;
use App\Repository\UserSettingRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UserSetting>
 *
 * @method        UserSetting|Proxy                     create(array|callable $attributes = [])
 * @method static UserSetting|Proxy                     createOne(array $attributes = [])
 * @method static UserSetting|Proxy                     find(object|array|mixed $criteria)
 * @method static UserSetting|Proxy                     findOrCreate(array $attributes)
 * @method static UserSetting|Proxy                     first(string $sortedField = 'id')
 * @method static UserSetting|Proxy                     last(string $sortedField = 'id')
 * @method static UserSetting|Proxy                     random(array $attributes = [])
 * @method static UserSetting|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserSettingRepository|RepositoryProxy repository()
 * @method static UserSetting[]|Proxy[]                 all()
 * @method static UserSetting[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static UserSetting[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static UserSetting[]|Proxy[]                 findBy(array $attributes)
 * @method static UserSetting[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static UserSetting[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<UserSetting> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<UserSetting> createOne(array $attributes = [])
 * @phpstan-method static Proxy<UserSetting> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<UserSetting> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<UserSetting> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<UserSetting> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<UserSetting> random(array $attributes = [])
 * @phpstan-method static Proxy<UserSetting> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<UserSetting> repository()
 * @phpstan-method static list<Proxy<UserSetting>> all()

 */
final class UserSettingFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
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
            'user' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(UserSetting $userSetting): void {})
        ;
    }

    protected static function getClass(): string
    {
        return UserSetting::class;
    }
}
