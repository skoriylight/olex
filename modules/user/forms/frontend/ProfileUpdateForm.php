<?php

namespace app\modules\user\forms\frontend;

use app\modules\user\models\User;
use app\modules\user\Module;
use yii\base\Model;
use yii\db\ActiveQuery;

class ProfileUpdateForm extends Model
{
    public $email;
    public $full_name;
    public $phone;
    public $city;
    public $shipping_city;
    public $shipping_type_id;
    public $shipping_dep;
    public $recipient_full_name;
    public $recipient_phone;
    public $recipient_city;



    /**
     * @var User
     */
    private $_user;

    /**
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        $this->full_name = $user->full_name;
        $this->phone = $user->phone;
        $this->city = $user->city;
        $this->shipping_city = $user->shipping_city;
        $this->recipient_full_name = $user->recipient_full_name;
        $this->recipient_phone = $user->recipient_phone;
        $this->recipient_city = $user->recipient_city;
        $this->shipping_type_id = $user->shipping_type_id;
        $this->shipping_dep = $user->shipping_dep;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Module::t('module', 'ERROR_EMAIL_EXISTS'),
                'filter' => function (ActiveQuery $query) {
                        $query->andWhere(['<>', 'id', $this->_user->id]);
                    },
            ],
            [['email', 'full_name', 'phone', 'city', 'shipping_city',
                'recipient_full_name', 'recipient_phone', 'recipient_city' ], 'string', 'max' => 255],
            [['shipping_type_id', 'shipping_dep'], 'integer']
        ];
    }

    /**
     * @return bool
     */
    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->full_name = $this->full_name;
            $user->phone = $this->phone;
            $user->city = $this->city;
            $user->shipping_city = $this->shipping_city;
            $user->recipient_full_name = $this->recipient_full_name;
            $user->recipient_phone = $this->recipient_phone;
            $user->recipient_city = $this->recipient_city;
            $user->shipping_type_id = $this->shipping_type_id;
            $user->shipping_dep = $this->shipping_dep;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
} 