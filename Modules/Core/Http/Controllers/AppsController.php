<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Core\Transformers\App as AppTransformer;
use Modules\Core\Entities\App;

class AppsController extends UserBaseController
{

    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $apps = App::parents()->with('childrenRecursive')->get();
            return new AppTransformer($apps);
        } else {
            return view('core::apps.index');
        }
    }

    /**
    * @api {post} /core/apps Create New app
    * @apiName createApp
    * @apiApp Core
    *
    * @param {String} name app name in arabic
    * @param {String} resource_name app resource_name Ex: Controller@action
    * @param {String} icon icon for app
    * @param {Integer} app sorting number
    *
    * @apiSuccess (Success 200) {JsonObject} apps app information
    * @apiError (Unprocessable Entity 422) ValidationError
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'resource_name' => 'required|unique:core_apps',
            'sort' => 'required|numeric',
            'frontend_path' => 'required',
            'icon' => 'required',
            'parent_id' => 'required'
        ]);
      
        $app = App::create($request->all());
        $app->log('create_app', $app);
        return new AppTransformer($app);
    }
    
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('core::show');
    }

    /**
    * @api {put} /core/apps/:id update app informations
    * @apiName updateApp
    * @apiApp Core
    *
    * @apiParam {String} name app name in arabic
    * @apiParam {Integer} id app id
    * @apiParam {String} resource_name app resource_name Ex: Controller@action
    * @apiParam {String} icon icon for app
    * @apiParam {Integer} app sorting number
    *
    * @apiSuccess (Success 200) {JsonObject} apps app information
    * @apiError (NotFound 404) NotFound if app id not found
    * @apiError (Unprocessable Entity 422) ValidationError
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'resource_name' => 'required|unique:core_apps,resource_name,'.$id,
            'sort' => 'required',
            'frontend_path' => 'required',
            'icon' => 'required',
            'parent_id' => 'required'
        ]);
        
        $app = App::findOrFail($id);
        $app->update($request->except('parent_id'));
        $app->log('update_app', $app);
        return new AppTransformer($app);
    }

    /**
    * @api {delete} /core/apps/:id delete app informations
    * @apiName deleteApp
    * @apiApp Core
    *
    * @apiParam {Integer} id app id
    *
    * @apiSuccess (Success 200) {JsonObject} apps app information
    * @apiError (NotFound 404) NotFound if app id not found
    * @apiError (Unprocessable Entity 422) ValidationError
    */
    public function destroy($id)
    {
        $app = App::findOrFail($id);
        
        //Ensure that more than one root to de
        if (!$app->is_main_root && ($app->children()->count() == 0)) {
            $app->delete();
            $app->log('delete_app', $app);
            return response(null, 204);
        }
        else {
            $data = ['errors' => ['message' => [app('translator')->get('messages.can_not_delete_core_app')]]];
            return response()->json($data, 422);
        }
    }
    
}
