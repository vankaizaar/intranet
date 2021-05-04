<?php

declare(strict_types=1);

namespace App;

use Exception;
use Orchid\Screen\AsSource;
use Orchid\Access\UserAccess;
use Orchid\Filters\Filterable;
use Orchid\Access\UserInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;
use Illuminate\Notifications\Notifiable;
use Orchid\Platform\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Orchid\Platform\Notifications\DashboardNotification;
use Faker\Factory as Faker;
use Orchid\Attachment\Attachable;

class User extends Authenticatable implements UserInterface
{
    use Attachable, Notifiable, UserAccess, AsSource, Filterable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'projects',
        'position_id',
        'department_id',
        'avatar',
        'password',
        'last_login',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'permissions'       => 'array',
        'projects'       => 'array',
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'telephone',
        'title',
        'permissions',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'telephone',
        'title',
        'last_login',
        'updated_at',
        'created_at',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Display name.
     *
     * @return string
     */
    public function getNameTitle() : string
    {
        return ucwords($this->name);
    }

    /**
     * Display sub.
     *
     * @return string
     * @throws Exception
     */
    public function getSubTitle() : string
    {
        return $this->position->name;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @throws Exception
     */
    public static function createAdmin(string $name, string $email, string $password)
    {
        if (static::where('email', $email)->exists()) {
            throw new Exception('This user exists in the system.');
        }

        $permissions = collect();

        Dashboard::getPermission()
            ->collapse()
            ->each(function ($item) use ($permissions) {
                $permissions->put($item['slug'], true);
            });

        $faker = Faker::create();
        $randomDepartment = Department::all()->random()->id;
        $randomPosition = Position::all()->random()->id;
        $randomProject = Project::all()->random()->id;
        $user = static::create([
            'name'        => $name,
            'email'       => $email,
            'password'    => Hash::make($password),
            'permissions' => $permissions,
            'avatar'=> "https://www.gravatar.com/avatar/f9879d71855b5ff21e4963273a886bfc?s=200",
            'telephone' => $faker->e164PhoneNumber,
            'position_id' => $randomPosition,
            'department_id' => $randomDepartment,
            'projects' => [$randomProject],
        ]);

        $user->notify(new DashboardNotification([
            'title'   => "Welcome {$name}",
            'message' => 'You are an administrator in the system.',
            'action'  => '',
            'type'    => DashboardNotification::INFO,
        ]));
    }

     /**
     *@throws Exception
     *
     * @return string
     */
    public function getAvatar() : string
    {
        return $this->avatar;
    }

    /**
     * @return Collection
     */
    public function getStatusPermission() : Collection
    {
        $permissions = $this->permissions ?? [];

        return Dashboard::getPermission()
            ->sort()
            ->transform(function ($group) use ($permissions) {
                return collect($group)->sortBy('description')
                    ->map(function ($value) use ($permissions) {
                        $slug = $value['slug'];
                        $value['active'] = array_key_exists($slug, $permissions) && (bool) $permissions[$slug];

                        return $value;
                    });
            });
    }

    /**
     * Get the department of the user
     */
    public function department(){
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position of the user
     */
    public function position(){
        return $this->belongsTo(Position::class);
    }

    /**
     * Get media uploaded by user
     */
    public function media(){
        return $this->hasMany(Media::class);
    }

    /**
     * Get profile
     */
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    /**
     * Get bookings
     */
    public function roomBooking(){
        return $this->hasMany(RoomBooking::class);
    }
}
