<?php
namespace App\Models\Repositories;

use App\Files\FileSystem;
use App\Models\User;
use App\Models\Volunteer;

/**
 * User: sasik
 * Date: 3/4/16
 * Time: 2:54 PM
 */
class VolunteerRepository
{

    /**
     * @var FileSystem
     */
    private $filesystem;
    /**
     * VolunteerRepository constructor.
     * @param FileSystem $fileSystem
     */
    public function __construct(FileSystem $fileSystem)
    {
        $this->filesystem = $fileSystem;
    }


    /**
     * создает пользователя и присоединяет волонтерка к нему
     * @param array $attributes
     * @return Volunteer
     */
    public function create(array $attributes)
    {
        $user = User::create($attributes);
        $volunteer = Volunteer::create($attributes);
        $volunteer
            ->user()
            ->associate($user);
        $volunteer->image = $this->filesystem->getFilenameFromPost($attributes);
        $volunteer->save();

        return $volunteer;
    }

    public function getValidationRules($volunteerUserId = null)
    {

        $rules = Volunteer::$rules;
        $rules = array_merge($rules, User::$rules);

        if ($volunteerUserId) {
            $rules['telephone'] = 'required|min:10|max:10|unique:users,telephone,' . $volunteerUserId;
            $rules['password'] = 'min:6';
        } else {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }

    /**
     * @param Volunteer $volunteer
     * @return Volunteer
     */
    public function prepareToEditForm(Volunteer $volunteer)
    {
        $volunteer->lastname = $volunteer->user->lastname;
        $volunteer->middlename = $volunteer->user->middlename;
        $volunteer->firstname = $volunteer->user->firstname;

        return $volunteer;
    }

    /**
     * @param Volunteer $volunteer
     * @param array $attributes
     * @return Volunteer
     */
    public function update(Volunteer $volunteer, array $attributes)
    {
        dd($attributes);
        $volunteer->update($attributes);
        if (array_key_exists('image', $attributes) && !empty($attributes['image'])) {
            $volunteer->image = $attributes['image'];
        } else {
            $volunteer->image = $this->filesystem->getFilenameFromPost($attributes);
        }

        $volunteer->save();

        if (array_key_exists('password', $attributes)) {
            if (empty($attributes['password'])) {
                unset($attributes['password']);
            }
        }

        $volunteer->user->update($attributes);

        return $volunteer;
    }

    private function getImageName($attributes)
    {

    }

    public function getVolunteersForSelectbox()
    {
        return Volunteer::all()->pluck('name', 'id');
    }
}
