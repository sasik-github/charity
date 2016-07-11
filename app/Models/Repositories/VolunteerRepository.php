<?php
namespace App\Models\Repositories;

use App\Containers\GrantPointsContainer;
use App\Events\GrantPointsEvent;
use App\Exceptions\VolunteerException;
use App\Files\FileSystem;
use App\Models\Event;
use App\Models\Helpers\LevelUpChecker;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Builder;

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

    public function getVolunteersForSelectbox()
    {
        return Volunteer::all()->pluck('name', 'id');
    }

    /**
     * @param $volunteerIDs array массив Id
     * @param Event $event
     * @return GrantPointsContainer
     * @throws VolunteerException
     */
    public function grantPointsToVolunteers($volunteerIDs, Event $event)
    {
        $volunteers = $event->volunteers()->find($volunteerIDs);

        $grantPointsContainer = new GrantPointsContainer();

        if ($volunteers == null) {
            throw new VolunteerException('Not found any volunteers for event id=' . $event->id);
        }

        foreach ($volunteers as $volunteer) {
            /**
             * @var $volunteer Volunteer
             */
            $levelUpChecker = new LevelUpChecker($volunteer);
            $volunteer->visitEvent($event);
            $volunteer->save();
            $grantPointsContainer->grantPoints();
            \Event::fire(new GrantPointsEvent($volunteer, $event));

            if ($levelUpChecker->isLevelUped()) {
                $levelUpChecker->sendPushAboutNewLevel($volunteer);
                $grantPointsContainer->lvlUp();
            }
        }

        return $grantPointsContainer;
    }

    /**
     * @param $query Builder
     * @param $searchWord string
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function searchByFIO(Builder $query, $searchWord)
    {
        $searchWord = '%' . $searchWord . '%';
        $query->whereHas('user', function(Builder $subQuery) use ($searchWord) {
            $subQuery->where(function($groupQuery) use ($searchWord) {
                $groupQuery
                    ->orWhere('firstname', 'like', $searchWord)
                    ->orWhere('middlename', 'like', $searchWord)
                    ->orWhere('lastname', 'like', $searchWord);
            })
            ;
        });

        return $query;
    }
}
