<?php

namespace App\Services\Implement;

use App\Repositories\CustomerRepositoryInterface;
use App\Services\AuthServiceInterface;
use App\Services\CustomerServiceInterface;
use App\Common\Helpers\DateTimeHelper;
use App\Common\Helpers\FilterHelper;
use DB;
use League\Flysystem\Exception;

class CustomerService implements CustomerServiceInterface
{
    private $user;
    private $table_name;
    private $table_names;

    protected $authService, $customerRepo;

    public function __construct(AuthServiceInterface $authService
        , CustomerRepositoryInterface $customerRepo)
    {
        $this->authService  = $authService;
        $this->customerRepo = $customerRepo;

        $jwt_data = $this->authService->getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = $this->authService->getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $this->table_name  = 'customer';
        $this->table_names = 'customers';
    }

    public function readAll()
    {
        $all = $this->customerRepo->findAllActiveSkeleton();

        return [
            $this->table_names => $all
        ];
    }

    public function readOne($id)
    {
        $one = $this->customerRepo->findOneActiveSkeleton($id);

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
                'code'                  => $this->customerRepo->generateCode('CUSTOMER'),
                'first_name'            => $data['first_name'],
                'last_name'             => $data['last_name'],
                'phone'                 => $data['phone'],
                'company'               => $data['company'],
                'email'                 => $data['email'],
                'street_address_line_1' => $data['street_address_line_1'],
                'street_address_line_2' => $data['street_address_line_2'],
                'street_address_line_3' => $data['street_address_line_3'],
                'city'                  => $data['city'],
                'state'                 => $data['state'],
                'zip'                   => $data['zip'],
                'birthday'              => DateTimeHelper::toStringDateTimeFrameNgForDB($data['birthday']),
                'note'                  => $data['note'],
                'active'                => true
            ];

            $one = $this->customerRepo->createOne($i_one);

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

            $one = $this->customerRepo->findOneActive($data['id']);

            $i_one = [
                'first_name'            => $data['first_name'],
                'last_name'             => $data['last_name'],
                'phone'                 => $data['phone'],
                'company'               => $data['company'],
                'email'                 => $data['email'],
                'street_address_line_1' => $data['street_address_line_1'],
                'street_address_line_2' => $data['street_address_line_2'],
                'street_address_line_3' => $data['street_address_line_3'],
                'city'                  => $data['city'],
                'state'                 => $data['state'],
                'zip'                   => $data['zip'],
                'birthday'              => DateTimeHelper::toStringDateTimeFrameNgForDB($data['birthday']),
                'note'                  => $data['note'],
                'active'                => true
            ];

            $one = $this->customerRepo->updateOne($one->id, $i_one);

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

            $one = $this->customerRepo->deactivateOne($id);

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

            $one = $this->customerRepo->destroyOne($id);

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
        $from_date   = $filter['from_date'];
        $to_date     = $filter['to_date'];
        $range       = $filter['range'];
        $position_id = $filter['position_id'];

        $filtered = $this->customerRepo->findAllActiveSkeleton();

        $filtered = FilterHelper::filterByFromDateToDate($filtered, 'created_at', $from_date, $to_date);

        $filtered = FilterHelper::filterByRangeDate($filtered, 'created_at', $range);
        if ($position_id != 0)
            $filtered = $filtered->where('id', $position_id);
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