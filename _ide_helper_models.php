<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Field
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string|null $description Mô tả
 * @property int $is_read
 * @property int $is_create
 * @property int $is_update
 * @property int $is_delete
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string|null $updated_date Ngày cập nhật
 * @property int $active Kích hoạt
 * @property int $role_id Quyền
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereIsCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereIsUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Field whereUpdatedDate($value)
 */
	class Field extends \Eloquent {}
}

namespace App{
/**
 * App\GroupRole
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string|null $description Mô tả
 * @property string $icon_name icon cho aside
 * @property int $index vị trí thứ tự
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereIconName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupRole whereUpdatedAt($value)
 */
	class GroupRole extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $street_address_line_1
 * @property string $street_address_line_2
 * @property string $street_address_line_3
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $birthday
 * @property string $note
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereStreetAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereStreetAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereStreetAddressLine3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereZip($value)
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\Position
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string|null $description Mô tả
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereUpdatedAt($value)
 */
	class Position extends \Eloquent {}
}

namespace App{
/**
 * App\Appointment
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Appointment whereUpdatedAt($value)
 */
	class Appointment extends \Eloquent {}
}

namespace App{
/**
 * App\File
 *
 * @property int $id
 * @property string $code Mã
 * @property string|null $name Tên
 * @property string $extension Phần mở rộng
 * @property string $mime_type MIME Type
 * @property string $path Đường dẫn
 * @property int $size Dung lượng
 * @property string $table_name Tên bảng
 * @property int $table_id Mã bảng
 * @property string|null $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string|null $updated_date Ngày cập nhật
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereUpdatedDate($value)
 */
	class File extends \Eloquent {}
}

namespace App{
/**
 * App\Unit
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string|null $description Mô tả
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereUpdatedAt($value)
 */
	class Unit extends \Eloquent {}
}

namespace App{
/**
 * App\Employee
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereUpdatedAt($value)
 */
	class Employee extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property int $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\UserPosition
 *
 * @property int $id
 * @property int $user_id Nguời dùng
 * @property int $position_id Nguời dùng
 * @property int $created_by Người tạo
 * @property int $updated_by Người cập nhật
 * @property string $created_date Ngày tạo
 * @property string|null $updated_date Ngày cập nhật
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereUpdatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPosition whereUserId($value)
 */
	class UserPosition extends \Eloquent {}
}

namespace App{
/**
 * App\Item
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string|null $description Mô tả
 * @property string $router_link router link cho angular
 * @property string $icon_name icon cho aside
 * @property int $index vị trí thứ tự
 * @property int $active Kích hoạt
 * @property int $group_role_id Nhóm quyền
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereGroupRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereIconName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereRouterLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\UserRole
 *
 * @property int $id
 * @property int $user_id Nguời dùng
 * @property int $role_id Quyền
 * @property int $created_by Người tạo
 * @property int $updated_by Người cập nhật
 * @property string $created_date Ngày tạo
 * @property string|null $updated_date Ngày cập nhật
 * @property int $active Kích hoạt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereUpdatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRole whereUserId($value)
 */
	class UserRole extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $code Mã
 * @property string $fullname Họ tên
 * @property string|null $username Tài khoản
 * @property string|null $password Mật khẩu
 * @property string|null $address Địa chỉ
 * @property string|null $phone Điện thoại
 * @property string|null $birthday Ngày sinh
 * @property string $sex Giới tính
 * @property string|null $email Email
 * @property string|null $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string|null $updated_date Ngày cập nhật
 * @property int $active Kích hoạt
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

