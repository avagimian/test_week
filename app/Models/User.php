<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\User\Dto\UserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App/Models/User
 *
 * @property string $name;
 * @property string $email;
 * @property string $password;
 * @property bool $is_active;
 * @property string $role;
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function staticCreate(UserDto $dto): User
    {
        $user = new User();

        $user->setName($dto->name);
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);
        $user->setIsActive();
        $user->setRole();

        return $user;
    }

    public static function updateUser(UserDto $dto, User $user): User
    {
        $user->setName($dto->name);
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);
        $user->setIsActive();
        $user->setRole();

        return $user;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setIsActive(): void
    {
        $this->is_active = false;
    }

    public function setRole(): void
    {
        $this->role = 'user';
    }
}
