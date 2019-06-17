<?php
namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use \Modules\Core\Traits\SharedModel;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_apps';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'resource_name', 'icon', 'sort', 'parent_id', 'frontend_path', 'li_color', 'displayed_in_menu', 'menu_type'];

   /**
    * Authorized apps limitation
    *
    * @var string
    */
    public static $authorizedAppsIds = null;

    /**
     * Get children
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * recursive, loads all descendants
     */
    public function childrenRecursive()
    {
       return $this->children()->with('childrenRecursive');
    }

    /**
     * Get menu children
     */
    public function menuChildren()
    {
        $authorizedAppIds = self::$authorizedAppsIds;

        return $this->hasMany(self::class, 'parent_id', 'id')
                    ->where('displayed_in_menu', true)
                    ->when(is_array($authorizedAppIds),  function($query) use ($authorizedAppIds) {
                        return $query->whereIn('id', $authorizedAppIds);
                    })
                    ->orderBy('sort', 'ASC');
    }

    /**
     * recursive, loads all descendants for menu
     */
    public function menuChildrenRecursive()
    {
        $authorizedAppIds = self::$authorizedAppsIds;
       
        return $this->menuChildren()
                    ->with(['menuChildrenRecursive' => function($query) use ($authorizedAppIds) {
                        $query->where('displayed_in_menu', true)
                            ->when(is_array($authorizedAppIds),  function($query) use ($authorizedAppIds) {
                                return $query->whereIn('id', $authorizedAppIds);
                            })
                            ->orderBy('sort', 'ASC');
                    }]);
    }

    /**
     * Get parent
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * all ascendants
    */
    public function parentRecursive()
    {
       return $this->parent()->with('parentRecursive');
    }

    /**
     * Get Parents Apps only
     * Boolean $excludeTop exclude top app or not
     * @return collection parent apps
     */
    public static function parents($excludeTop = false)
    {
        $apps = self::where('resource_name', '=', 'Modules');

        if ($excludeTop) {
            $parentAppId = self::where('resource_name', 'Modules')->first()->id;
            $apps = self::where('parent_id', '=', $parentAppId);
        }

        return $apps;
    }

    /**
     * Get Parents Apps only for menu
     * Boolean $excludeTop exclude top app or not
     * @return collection parent apps
     */
    public static function parentsFormMenu($parentResourceName = 'Modules')
    {
        $parentAppId = self::where('resource_name', $parentResourceName)->select('id')->first()->id;

        $authorizedAppIds = self::$authorizedAppsIds;

        $apps = self::where('parent_id', '=', $parentAppId)
                    ->where('displayed_in_menu', true)
                    ->when(is_array($authorizedAppIds),  function($query) use ($authorizedAppIds) {
                        return $query->whereIn('id', $authorizedAppIds);
                    })
                    ->orderBy('sort', 'ASC');

        return $apps;
    }

    public static function setAuthorizedApps($value) {
        self::$authorizedAppsIds = $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($app) {
            $app->children()->delete();
        });
    }
}
