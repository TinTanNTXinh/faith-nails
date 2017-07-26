<?php

namespace App\Http\Controllers\Api;

use App\Common\Helpers\HttpStatusCodeHelper;
use App\Services\ItemServiceInterface;
use Illuminate\Http\Request;
use App\Common\Interfaces\ICrud;
use App\Http\Controllers\Controller;
use Route;

class ItemController extends Controller implements ICrud
{
    private $table_name;
    protected $itemService;

    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
        $this->table_name = 'item';
    }

    public function getReadAll()
    {
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, HttpStatusCodeHelper::$ok);
    }

    public function getReadOne()
    {
        $id  = Route::current()->parameter('id');
        $one = $this->readOne($id);
        return response()->json($one, HttpStatusCodeHelper::$ok);
    }

    public function postCreateOne(Request $request)
    {
        $data = $request->input($this->table_name);
        $validate_data = $this->createOne($data);
        if (!$validate_data['status'])
            return response()->json(['errors' => $validate_data['errors']], HttpStatusCodeHelper::$unprocessableEntity);

        $arr_datas = $this->readAll();
        return response()->json($arr_datas, HttpStatusCodeHelper::$created);
    }

    public function putUpdateOne(Request $request)
    {

        $data      = $request->input($this->table_name);

        $validate_data = $this->updateOne($data);
        if (!$validate_data['status'])
            return response()->json(['errors' => $validate_data['errors']], HttpStatusCodeHelper::$unprocessableEntity);

        $arr_datas = $this->readAll();
        return response()->json($arr_datas, HttpStatusCodeHelper::$ok);
    }

    public function patchDeactivateOne(Request $request)
    {
        $id = $request->input('id');

        $validate_data = $this->deactivateOne($id);
        if (!$validate_data['status'])
            return response()->json(['errors' => $validate_data['errors']], HttpStatusCodeHelper::$unprocessableEntity);

        $arr_datas = $this->readAll();
        return response()->json($arr_datas, HttpStatusCodeHelper::$ok);
    }

    public function deleteDeleteOne(Request $request)
    {
        // TODO: Implement deleteDeleteOne() method.
    }

    public function getSearchOne()
    {
        // TODO: Implement getSearchOne() method.
    }

    /** ===== LOGIC METHOD ===== */
    public function readAll()
    {
        return $this->itemService->readAll();
    }

    public function readOne($id)
    {
        return $this->itemService->readOne($id);
    }

    public function createOne($data)
    {
        return $this->itemService->createOne($data);
    }

    public function updateOne($data)
    {
        return $this->itemService->updateOne($data);

    }

    public function deactivateOne($id)
    {
       return $this->itemService->deactivateOne($id);
    }

    public function deleteOne($id)
    {
       return $this->itemService->deleteOne($id);
    }

    public function searchOne($filter)
    {
        return $this->itemService->searchOne($filter);
    }


}
