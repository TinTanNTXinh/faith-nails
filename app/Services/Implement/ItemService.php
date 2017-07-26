<?php

namespace App\Services\Implement;

use App\Repositories\CategoryRepositoryInterface;
use App\Services\AuthServiceInterface;
use App\Services\ItemServiceInterface;
use App\Repositories\ItemRepositoryInterface;
use App\Common\Helpers\DateTimeHelper;
use App\Common\Helpers\FilterHelper;
use DB;
use League\Flysystem\Exception;

class ItemService implements ItemServiceInterface
{
    private $user;
    private $table_name, $table_names;

    protected $authService, $itemRepo, $categoryRepo;

    public function __construct(AuthServiceInterface $authService
        , ItemRepositoryInterface $itemRepo
        , CategoryRepositoryInterface $categoryRepo)
    {
        $this->authService = $authService;
        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;

        $jwt_data = $this->authService->getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = $this->authService->getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $this->table_name = 'item';
        $this->table_names = 'items';
    }

    public function readAll()
    {
        $all = $this->itemRepo->findAllActiveSkeleton();
        $categories = $this->categoryRepo->findAllActive();
        return [
            $this->table_names => $all,
            'categories' => $categories
        ];
    }

    public function readOne($id)
    {
        $one = $this->itemRepo->findOneActiveSkeleton($id);

        return [
            $this->table_name => $one
        ];
    }

    public function createOne($data)
    {
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return $validates;

        $result = [
            'status' => false,
            'errors' => []
        ];

        try {
            DB::beginTransaction();
            $i_one = [
                'code' => $this->itemRepo->generateCode('item'),
                'category_id' => $data['category']['id'],
                'name' => $data['name'],
                'product_code' => $data['product_code'],
                'sku' => $data['sku'],
                'price' => $data['price'],
                'commission' => $data['commission'],
                'note' => $data['note'],
                'active' => true
            ];

            $one = $this->itemRepo->createOne($i_one);

            if (!$one) {
                DB::rollback();
                return $result;
            }

            DB::commit();
            $result['status'] = true;
            return $result;
        } catch (Exception $ex) {
            DB::rollBack();
            return $result;
        }
    }

    public function updateOne($data)
    {
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return $validates;

        $result = [
            'status' => false,
            'errors' => []
        ];

        try {
            DB::beginTransaction();

            // Validate
            $validate_data = $this->validateUpdateOne($data['id']);
            if (!$validate_data['status']) {
                return $validate_data;
            }
            $one = $this->itemRepo->findOneActive($data['id']);

            $i_one = [
                'category_id' => $data['category']['id'],
                'name' => $data['name'],
                'product_code' => $data['product_code'],
                'sku' => $data['sku'],
                'price' => $data['price'],
                'commission' => $data['commission'],
                'note' => $data['note'],
                'active' => true
            ];

            $one = $this->itemRepo->updateOne($one->id, $i_one);

            if (!$one) {
                DB::rollback();
                return $result;
            }

            DB::commit();
            $result['status'] = true;
            return $result;
        } catch (Exception $ex) {
            DB::rollBack();
            return $result;
        }
    }

    public function deactivateOne($id)
    {
        $result = [
            'status' => false,
            'errors' => []
        ];

        try {
            DB::beginTransaction();

            // Validate
            $validate_data = $this->validateDeactivateOne($id);
            if (!$validate_data['status']) {
                return $validate_data;
            }

            $one = $this->itemRepo->deactivateOne($id);

            if (!$one) {
                DB::rollback();
                return $result;
            }

            DB::commit();
            $result['status'] = true;
            return $result;
        } catch (Exception $ex) {
            DB::rollBack();
            return $result;
        }
    }

    public function deleteOne($id)
    {
        $result = [
            'status' => false,
            'errors' => []
        ];

        try {
            DB::beginTransaction();

            // Validate
            $validate_data = $this->validateDeleteOne($id);
            if (!$validate_data['status']) {
                return $validate_data;
            }

            $one = $this->itemRepo->destroyOne($id);

            if (!$one) {
                DB::rollback();
                return $result;
            }

            DB::commit();
            $result['status'] = true;
            return $result;
        } catch (Exception $ex) {
            DB::rollBack();
            return $result;
        }
    }

    public function searchOne($filter)
    {
        $from_date = $filter['from_date'];
        $to_date = $filter['to_date'];
        $range = $filter['range'];
        $item_id = $filter['item_id'];

        $filtered = $this->itemRepo->findAllActiveSkeleton();

        $filtered = FilterHelper::filterByFromDateToDate($filtered, 'created_at', $from_date, $to_date);

        $filtered = FilterHelper::filterByRangeDate($filtered, 'created_at', $range);

        if ($item_id != 0)
            $filtered = $filtered->where('id', $item_id);

        return [
            $this->table_names => $filtered->values()
        ];
    }

    /** ===== VALIDATE BASIC ===== */
    public function validateInput($data)
    {
        if (!$this->validateEmpty($data))
            return ['status' => false, 'errors' => 'Dữ liệu không hợp lệ.'];

        $msgs = $this->validateLogic($data);
        return $msgs;
    }

    public function validateEmpty($data)
    {
//        if (!$data['name']) return false;
        return true;
    }

    public function validateLogic($data)
    {
        $msg_error = [];

//        $skip_id = isset($data['id']) ? [$data['id']] : [];
//
//        if ($data['code'] && $this->userRepo->existsValue('code', $data['code'], $skip_id))
//            array_push($msg_error, 'Mã đã tồn tại.');

//        if ($this->userRepo->existsValue('name', $data['name'], $skip_id))
//            array_push($msg_error, 'Tên đã tồn tại.');

        return [
            'status' => count($msg_error) > 0 ? false : true,
            'errors' => $msg_error
        ];
    }

    /** ===== VALIDATE ADVANCED ===== */
    public function validateUpdateOne($id)
    {
        return $this->validateDeactivateOne($id);
    }

    public function validateDeactivateOne($id)
    {
        $msg_error = [];

        return [
            'status' => count($msg_error) > 0 ? false : true,
            'errors' => $msg_error
        ];
    }

    public function validateDeleteOne($id)
    {
        return $this->validateDeactivateOne($id);
    }

    /** ===== MY FUNCTION ===== */

}