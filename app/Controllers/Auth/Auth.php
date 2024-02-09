<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\Cms\Users\UsersModel;
use App\Models\HelperModel;

class Auth extends BaseController
{

    protected $userModel;
    protected $helperModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->helperModel = new HelperModel();
    }

    public function index()
    {
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Login'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutAuth,
            'section' => $this->dirSectionAuth
        ];
        return view('auth/body', $data);
    }

    public function authLogin()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // VALIDASI FORM
        if (!$this->validate($rules)) {
            // Redirect ke halaman sebelumnya bersama dengan input lama nya.
            return redirect()->back()->withInput();
        } else {

            // Get Data User By Email
            $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

            $token_data = $this->userModel::dataTokenByEmail($email);

            if (!$dataUsersByEmail) {
                $data = [
                    'email' => $email,
                    'activity' => 'Login',
                    'description' => 'Email not found',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);
                session()->setFlashdata("notif", $this->sessionMessage('error', "Email not found"));
                return redirect()->back()->withInput();
            } else {
                if ($dataUsersByEmail['is_active'] == 0) {
                    $data = [
                        'email' => $email,
                        'activity' => 'Login',
                        'description' => 'Email not active',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);
                    session()->setFlashdata("notif", $this->sessionMessage('error', "{$dataUsersByEmail['email']} not active"));
                    return redirect()->back()->withInput();
                } else {
                    if (password_verify($password, $dataUsersByEmail['password'])) {

                        if ($dataUsersByEmail['is_verified'] == 0) {

                            $data = [
                                'email' => $email,
                                'activity' => 'Login',
                                'description' => 'User login but not verified',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);

                            return redirect()->to('/verification?token=' . $token_data['token'] . '&email=' . $email);
                        } else {
                            // Buat Session
                            $sessUser = [
                                'email' => $dataUsersByEmail['email'],
                                'role' => $dataUsersByEmail['role'],
                                'nama_lengkap' => $dataUsersByEmail['nama_lengkap'],
                                'nama_depan' => $dataUsersByEmail['nama_depan'],
                                'nama_belakang' => $dataUsersByEmail['nama_belakang'],
                            ];

                            session()->set($sessUser);

                            $data = [
                                'email' => $email,
                                'activity' => 'Login',
                                'description' => 'User login',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);

                            return redirect()->to('/user/dashboard');
                        }
                    } else {
                        $data = [
                            'email' => $email,
                            'activity' => 'Login',
                            'description' => 'Wrong password',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);
                        session()->setFlashdata("notif", $this->sessionMessage('error', "Wrong password"));
                        return redirect()->back()->withInput();
                    }
                }
            }
        }
    }

    // AUTH GOOGLE
    public function authGoogle()
    {
        $provider = new \League\OAuth2\Client\Provider\Google($this->providers['google']);

        $code = $this->request->getVar('code');

        if (!isset($code)) {
            // Jika tidak ada kode otorisasi, alihkan ke halaman login Google
            $authUrl = $provider->getAuthorizationUrl();
            return redirect()->to($authUrl);
        } else {
            // Jika ada kode otorisasi, pertukarkan kode tersebut dengan token akses
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $code
            ]);

            // Get Data Google
            $user = $provider->getResourceOwner($token);

            // Get Data User By Email
            $dataUsersByEmail = $this->userModel::dataUsersByEmail($this->getOauthEmail($user));

            if (!$dataUsersByEmail) {
                // TO AUTH
                $data = [
                    'email' => $this->getOauthEmail($user),
                    'password' => password_hash('wellcare1234$#@!', PASSWORD_DEFAULT),
                    'role_id' => '2',
                    'is_verified' => 1,
                    'is_active' => 1,
                    'login_type' => 'google',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime(),
                    'is_agree' => 1,
                ];

                $throw_id = true;
                $table_name = 'auth_table';

                $auth_id = $this->helperModel::insertData($data, $throw_id, $table_name);

                // TO USER
                if ($auth_id) {
                    $data = [
                        'auth_id' => $auth_id,
                        'nama_lengkap' => $this->getOauthName($user),
                        'nama_depan' => $this->getOauthFirstName($user),
                        'nama_belakang' => $this->getOauthLastName($user),
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'user_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Register',
                        'description' => 'User register with Google',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);
                }
            } else {
                $icon = "error";
                if ($dataUsersByEmail['is_active'] == 0) {
                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Login',
                        'description' => 'User login with Google but the account not active',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage($icon, "{$dataUsersByEmail['email']} not active"));
                    return redirect()->back();
                } else {
                    // Buat Session
                    $sessUser = [
                        'email' => $this->getOauthEmail($user),
                        'role' => 'User',
                        'nama_lengkap' => $this->getOauthName($user),
                        'nama_depan' => $this->getOauthFirstName($user),
                        'nama_belakang' => $this->getOauthLastName($user),
                    ];

                    session()->set($sessUser);
                    if ($user) {

                        $data = [
                            'email' => $this->getOauthEmail($user),
                            'activity' => 'Login',
                            'description' => 'User login with Google',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);

                        return redirect()->to('/user/dashboard');
                    } else {
                        throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
                    }
                }
            }
        }
    }

    // Tambahkan fungsi callback untuk menangani tanggapan dari Google
    public function callbackGoogle()
    {
        $provider = new \League\OAuth2\Client\Provider\Google($this->providers['google']);

        $code = $this->request->getVar('code');

        // Jika ada kode otorisasi, pertukarkan kode tersebut dengan token akses
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);

        // Get Data Google
        $user = $provider->getResourceOwner($token);

        // Get Data User By Email
        $dataUsersByEmail = $this->userModel::dataUsersByEmail($this->getOauthEmail($user));

        if (!$dataUsersByEmail) {
            // TO AUTH
            $data = [
                'email' => $this->getOauthEmail($user),
                'password' => password_hash('wellcare1234$#@!', PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_verified' => 1,
                'is_active' => 1,
                'login_type' => 'google',
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_agree' => 1,
            ];

            $throw_id = true;
            $table_name = 'auth_table';

            $auth_id = $this->helperModel::insertData($data, $throw_id, $table_name);

            // TO USER
            if ($auth_id) {
                $data = [
                    'auth_id' => $auth_id,
                    'nama_lengkap' => $this->getOauthName($user),
                    'nama_depan' => $this->getOauthFirstName($user),
                    'nama_belakang' => $this->getOauthLastName($user),
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'user_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                $data = [
                    'email' => $this->getOauthEmail($user),
                    'activity' => 'Register',
                    'description' => 'User register with Google',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);
            }
        } else {
            $icon = "error";
            if ($dataUsersByEmail['is_active'] == 0) {
                $data = [
                    'email' => $this->getOauthEmail($user),
                    'activity' => 'Login',
                    'description' => 'User try to login with Google but the account not active',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage($icon, "{$dataUsersByEmail['email']} not active"));
                return redirect()->back();
            } else {
                // Buat Session
                $sessUser = [
                    'email' => $this->getOauthEmail($user),
                    'role' => 'User',
                    'nama_lengkap' => $this->getOauthName($user),
                    'nama_depan' => $this->getOauthFirstName($user),
                    'nama_belakang' => $this->getOauthLastName($user),
                ];

                session()->set($sessUser);
                if ($user) {

                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Login',
                        'description' => 'User login with Google',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    return redirect()->to('/user/dashboard');
                } else {
                    throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
                }
            }
        }
    }
    // END

    // AUTH FACEBOOK
    public function authFacebook()
    {
        $provider = new \League\OAuth2\Client\Provider\Facebook($this->providers['facebook']);

        $code = $this->request->getVar('code');

        if (!isset($code)) {
            // Jika tidak ada kode otorisasi, alihkan ke halaman login Google
            $authUrl = $provider->getAuthorizationUrl();
            return redirect()->to($authUrl);
        } else {
            // Jika ada kode otorisasi, pertukarkan kode tersebut dengan token akses
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $code
            ]);

            // Get Data Google
            $user = $provider->getResourceOwner($token);

            // Get Data User By Email
            $dataUsersByEmail = $this->userModel::dataUsersByEmail($this->getOauthEmail($user));

            if (!$dataUsersByEmail) {
                // TO AUTH
                $data = [
                    'email' => $this->getOauthEmail($user),
                    'password' => password_hash('wellcare1234$#@!', PASSWORD_DEFAULT),
                    'role_id' => '2',
                    'is_verified' => 1,
                    'is_active' => 1,
                    'login_type' => 'facebook',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime(),
                    'is_agree' => 1,
                ];

                $throw_id = true;
                $table_name = 'auth_table';

                $auth_id = $this->helperModel::insertData($data, $throw_id, $table_name);

                // TO USER
                if ($auth_id) {
                    $data = [
                        'auth_id' => $auth_id,
                        'nama_lengkap' => $this->getOauthName($user),
                        'nama_depan' => $this->getOauthFirstName($user),
                        'nama_belakang' => $this->getOauthLastName($user),
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'user_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Register',
                        'description' => 'User register with Facebook',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);
                }
            } else {
                $icon = "error";
                if ($dataUsersByEmail['is_active'] == 0) {

                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Login',
                        'description' => 'User try to login with Facebook, but the account not active',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage($icon, "{$dataUsersByEmail['email']} not active"));
                    return redirect()->back();
                } else {
                    // Buat Session
                    $sessUser = [
                        'email' => $this->getOauthEmail($user),
                        'role' => 'User',
                        'nama_lengkap' => $this->getOauthName($user),
                        'nama_depan' => $this->getOauthFirstName($user),
                        'nama_belakang' => $this->getOauthLastName($user),
                    ];

                    session()->set($sessUser);
                    if ($user) {
                        $data = [
                            'email' => $this->getOauthEmail($user),
                            'activity' => 'Login',
                            'description' => 'User login with Facebook',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);
                        return redirect()->to('/user/dashboard');
                    } else {
                        throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
                    }
                }
            }
        }
    }

    // Tambahkan fungsi callback untuk menangani tanggapan dari Google
    public function callbackFacebook()
    {
        $provider = new \League\OAuth2\Client\Provider\Facebook($this->providers['facebook']);

        $code = $this->request->getVar('code');

        // Jika ada kode otorisasi, pertukarkan kode tersebut dengan token akses
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);

        // Get Data Google
        $user = $provider->getResourceOwner($token);

        // Get Data User By Email
        $dataUsersByEmail = $this->userModel::dataUsersByEmail($this->getOauthEmail($user));

        if (!$dataUsersByEmail) {
            // TO AUTH
            $data = [
                'email' => $this->getOauthEmail($user),
                'password' => password_hash('wellcare1234$#@!', PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_verified' => 1,
                'is_active' => 1,
                'login_type' => 'facebook',
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_agree' => 1,
            ];

            $throw_id = true;
            $table_name = 'auth_table';

            $auth_id = $this->helperModel::insertData($data, $throw_id, $table_name);

            // TO USER
            if ($auth_id) {
                $data = [
                    'auth_id' => $auth_id,
                    'nama_lengkap' => $this->getOauthName($user),
                    'nama_depan' => $this->getOauthFirstName($user),
                    'nama_belakang' => $this->getOauthLastName($user),
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'user_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                $data = [
                    'email' => $this->getOauthEmail($user),
                    'activity' => 'Register',
                    'description' => 'User register with Facebook',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);
            }
        } else {
            $icon = "error";
            if ($dataUsersByEmail['is_active'] == 0) {

                $data = [
                    'email' => $this->getOauthEmail($user),
                    'activity' => 'Login',
                    'description' => 'User try to login with Facebook, but the account is not active',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage($icon, "{$dataUsersByEmail['email']} tidak aktif"));
                return redirect()->back();
            } else {
                // Buat Session
                $sessUser = [
                    'email' => $this->getOauthEmail($user),
                    'role' => 'User',
                    'nama_lengkap' => $this->getOauthName($user),
                    'nama_depan' => $this->getOauthFirstName($user),
                    'nama_belakang' => $this->getOauthLastName($user),
                ];

                session()->set($sessUser);
                if ($user) {

                    $data = [
                        'email' => $this->getOauthEmail($user),
                        'activity' => 'Login',
                        'description' => 'User login with Facebook',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    return redirect()->to('/user/dashboard');
                } else {
                    throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
                }
            }
        }
    }
    // END

    // Auth Register
    public function register()
    {
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Register'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutAuth,
            'section' => $this->dirSectionAuth
        ];

        return view('auth/register', $data);
    }

    public function authRegister()
    {
        $rules = [
            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'The First Name is required'
                ]
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'The Last Name is required'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[auth_table.email]',
                'errors' => [
                    'is_unique' => 'Email already exist'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).*$/]',
                'errors' => [
                    'min_length' => 'The Password length must least 8 character',
                    'regex_match' => 'The Password must first letter capital, number, and symbol (ex. $, !, @ etc)',
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ],
            'agree' => [
                'label' => 'Terms and Condition',
                'rules' => 'required'
            ]
        ];

        $first_name = $this->request->getVar('first_name');
        $last_name = $this->request->getVar('last_name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $agree = $this->request->getVar('agree');
        $csrf_token = $this->request->getVar('csrf_token_name');

        // VALIDASI FORM
        if (!$this->validate($rules)) {
            // Redirect ke halaman sebelumnya bersama dengan input lama nya.
            return redirect()->back()->withInput();
        } else {
            // TO AUTH
            $data = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_verified' => 0,
                'is_active' => 1,
                'login_type' => 'reguler',
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_agree' => $agree,
            ];

            $throw_id = true;
            $table_name = 'auth_table';

            $auth_id = $this->helperModel::insertData($data, $throw_id, $table_name);

            // TO USER
            if ($auth_id) {
                $data = [
                    'auth_id' => $auth_id,
                    'nama_lengkap' => $first_name . ' ' . $last_name,
                    'nama_depan' => $first_name,
                    'nama_belakang' => $last_name,
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'user_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'User register',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);
            }

            $data = [
                'otp' => $this->generateUniqueRandomNumbers(),
                'token' => $csrf_token,
                'email' => $email,
                'time_expired' => $this->dateTimeModify('+60 minutes'),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];

            $throw_id = false;
            $table_name = 'token_table';

            $insert_token = $this->helperModel::insertData($data, $throw_id, $table_name);

            $email_config = new \SendGrid\Mail\Mail();


            if ($insert_token) {

                $token = $this->userModel::dataTokenByEmail($email);

                $email_config->setFrom('avizer95@gmail.com', 'Well Care Development');
                $email_config->setSubject('Your OTP Code is ' . $token['otp']);
                $email_config->addTo($email);

                $data_email = [
                    'name' => $first_name,
                    'otp' => $token['otp'],
                    'token' => $token['token'],
                    'email' => $token['email'],
                ];

                $email_config->addContent(
                    "text/html",
                    view('auth/template_verify', $data_email)
                );
                $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            }

            if ($sendgrid->send($email_config)) {
                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'OTP has sent to email user',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);
                session()->setFlashdata("notif", $this->sessionMessage('info', "We sent otp code to {$token['email']}, please check it"));
                return redirect()->to('/verification?token=' . $csrf_token . '&email=' . $email);
            } else {
                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'Failed sent email otp when register',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage('error', "Failed send email, please resend it"));
                return redirect()->to('/verification?token=' . $csrf_token . '&email=' . $email);
            }
        }
    }

    public function requestOtp()
    {
        $token = $this->request->getVar('token');
        $email = $this->request->getVar('email');
        if ($email) {
            $token_data = $this->userModel::dataTokenByEmail($email);

            if ($token_data && $token == $token_data['token']) {
                $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
                $data = [
                    'title' => $this->setTitle('Verification'),
                    'metaDescription' => $this->setMetaDescription($description),
                    'layout' => $this->dirLayoutAuth,
                    'section' => $this->dirSectionAuth,
                    'email' => $email
                ];

                return view('auth/request-otp', $data);
            } else {

                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'Token or email invalid',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                throw new \CodeIgniter\Exceptions\PageNotFoundException("Token or email invalid");
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
        }
    }

    public function verifyOtp()
    {
        $code_1 = $this->request->getVar('code-1');
        $code_2 = $this->request->getVar('code-2');
        $code_3 = $this->request->getVar('code-3');
        $code_4 = $this->request->getVar('code-4');
        $email = $this->request->getVar('email');
        $csrf_token_name = $this->request->getVar('csrf_token_name');
        $otp = $code_1 . $code_2 . $code_3 . $code_4;
        if ($email) {
            $token_data = $this->userModel::dataTokenByEmail($email);
            if ($token_data) {
                if ($token_data['otp'] == $otp) {
                    if (strtotime($token_data['time_expired']) > strtotime($this->dateTime())) {
                        $data = [
                            'email' => $email,
                            'is_verified' => 1,
                        ];
                        $where = [
                            'email' => $email,
                        ];

                        $update = $this->helperModel::updateData($where, $data, 'auth_table');

                        if ($update) {
                            $where = 'email';
                            $table = 'token_table';
                            $hard_delete = true;

                            $data = [];

                            $delete = $this->helperModel::deleteData($where, $email, $data, $table, $hard_delete);
                            if ($delete) {
                                $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

                                // Buat Session
                                $sessUser = [
                                    'email' => $dataUsersByEmail['email'],
                                    'role' => $dataUsersByEmail['role'],
                                    'nama_lengkap' => $dataUsersByEmail['nama_lengkap'],
                                    'nama_depan' => $dataUsersByEmail['nama_depan'],
                                    'nama_belakang' => $dataUsersByEmail['nama_belakang'],
                                ];

                                session()->set($sessUser);

                                $data = [
                                    'email' => $email,
                                    'activity' => 'Register',
                                    'description' => 'Verify email user suceeded',
                                    'created_at' => $this->dateTime(),
                                    'updated_at' => $this->dateTime()
                                ];

                                $throw_id = false;
                                $table_name = 'log_auth_table';

                                $this->helperModel::insertData($data, $throw_id, $table_name);

                                session()->setFlashdata("notif", $this->sessionMessage('success', "Email is verified!"));
                                return redirect()->to('/user/dashboard');
                            } else {
                                $data = [
                                    'email' => $email,
                                    'activity' => 'Register',
                                    'description' => 'Failed to delete token',
                                    'created_at' => $this->dateTime(),
                                    'updated_at' => $this->dateTime()
                                ];

                                $throw_id = false;
                                $table_name = 'log_auth_table';

                                $this->helperModel::insertData($data, $throw_id, $table_name);

                                session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong"));
                                return redirect()->back();
                            }
                        } else {
                            $data = [
                                'email' => $email,
                                'activity' => 'Register',
                                'description' => 'Failed to update verified',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);

                            session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong"));
                            return redirect()->back();
                        }
                    } else {
                        $data = [
                            'otp' => $this->generateUniqueRandomNumbers(),
                            'token' => $csrf_token_name,
                            'time_expired' => $this->dateTimeModify('+60 minutes'),
                            'updated_at' => $this->dateTime()
                        ];
                        $where = [
                            'email' => $email,
                        ];

                        $update = $this->helperModel::updateData($where, $data, 'token_table');

                        $email_config = new \SendGrid\Mail\Mail();

                        if ($update) {
                            $token = $this->userModel::dataTokenByEmail($email);
                            $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

                            $email_config->setFrom('avizer95@gmail.com', 'Well Care Development');
                            $email_config->setSubject('Your OTP Code is ' . $token['otp']);
                            $email_config->addTo($email);
                            $data_email = [
                                'name' => $dataUsersByEmail['nama_depan'],
                                'otp' => $token['otp'],
                                'token' => $token['token'],
                                'email' => $token['email'],
                            ];

                            $email_config->addContent(
                                "text/html",
                                view('auth/template_verify', $data_email)
                            );
                            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                        }

                        if ($sendgrid->send($email_config)) {
                            $data = [
                                'email' => $email,
                                'activity' => 'Register',
                                'description' => 'OTP is expired',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);
                            session()->setFlashdata("notif", $this->sessionMessage('error', "OTP is expired, we resend it"));
                            return redirect()->back();
                        } else {
                            $data = [
                                'email' => $email,
                                'activity' => 'Register',
                                'description' => 'Failed sent email OTP when verify',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);

                            session()->setFlashdata("notif", $this->sessionMessage('error', "Something went wrong when send email"));
                            return redirect()->back();
                        }
                    }
                } else {
                    $data = [
                        'email' => $email,
                        'activity' => 'Register',
                        'description' => 'OTP Invalid',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage('error', "OTP invalid"));
                    return redirect()->back();
                }
            } else {
                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'Token invalid',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage('error', "Token invalid"));
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("notif", $this->sessionMessage('error', "Email invalid"));
            return redirect()->back();
        }
    }

    public function resendOtp($email)
    {
        $csrf_token_name = csrf_hash();
        if ($email) {
            $token_data = $this->userModel::dataTokenByEmail($email);
            if ($token_data) {
                $data = [
                    'otp' => $this->generateUniqueRandomNumbers(),
                    'token' => $csrf_token_name,
                    'time_expired' => $this->dateTimeModify('+60 minutes'),
                    'updated_at' => $this->dateTime()
                ];

                $where = [
                    'email' => $email,
                ];

                $update = $this->helperModel::updateData($where, $data, 'token_table');

                $email_config = new \SendGrid\Mail\Mail();

                if ($update) {
                    $token = $this->userModel::dataTokenByEmail($email);
                    $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

                    $email_config->setFrom('avizer95@gmail.com', 'Well Care Development');
                    $email_config->setSubject('Your OTP Code is ' . $token['otp']);
                    $email_config->addTo($email);

                    $data_email = [
                        'name' => $dataUsersByEmail['nama_depan'],
                        'otp' => $token['otp'],
                        'token' => $token['token'],
                        'email' => $token['email'],
                    ];

                    $email_config->addContent(
                        "text/html",
                        view('auth/template_verify', $data_email)
                    );
                    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                }

                if ($sendgrid->send($email_config)) {
                    $data = [
                        'email' => $email,
                        'activity' => 'Register',
                        'description' => 'OTP has been resend',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage('success', "OTP has been resend"));
                    return redirect()->back();
                } else {

                    $data = [
                        'email' => $email,
                        'activity' => 'Register',
                        'description' => 'Failed sent email when resend OTP',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage('error', "Something went wrong when send email"));
                    return redirect()->back();
                }
            } else {

                $data = [
                    'email' => $email,
                    'activity' => 'Register',
                    'description' => 'User has resend token, but the token is invalid',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage('error', "Token invalid"));
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("notif", $this->sessionMessage('error', "Email invalid"));
            return redirect()->back();
        }
    }

    public function forgotPassword()
    {
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Password Reset'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutAuth,
            'section' => $this->dirSectionAuth
        ];
        return view('auth/recovery_password', $data);
    }

    public function recoveryPassword()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[token_table.email]',
                'errors' => [
                    'required' => 'The Email is required',
                    'is_unique' => 'Email already exist'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $email = $this->request->getVar('email');
            $csrf_token_name = $this->request->getVar('csrf_token_name');
            $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

            if ($dataUsersByEmail) {
                if ($dataUsersByEmail['is_active'] == 1) {
                    $data = [
                        'email' => $email,
                        'otp' => $this->generateUniqueRandomNumbers(),
                        'token' => $csrf_token_name,
                        'time_expired' => $this->dateTimeModify('+60 minutes'),
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $insert = $this->helperModel::insertData($data, false, 'token_table');

                    $email_config = new \SendGrid\Mail\Mail();
                    if ($insert) {
                        $token = $this->userModel::dataTokenByEmail($email);

                        $email_config->setFrom('avizer95@gmail.com', 'Well Care Development');
                        $email_config->setSubject('Password Reset ' . $email);
                        $email_config->addTo($email);

                        $data_email = [
                            'name' => $dataUsersByEmail['nama_depan'],
                            'token' => $token['token'],
                            'email' => $token['email'],
                        ];

                        $email_config->addContent(
                            "text/html",
                            view('auth/template_reset_password', $data_email)
                        );
                        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                    }

                    if ($sendgrid->send($email_config)) {
                        $data = [
                            'email' => $email,
                            'activity' => 'Recovery Password',
                            'description' => 'Recovery link has been sent to email user',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);

                        session()->setFlashdata("notif", $this->sessionMessage('info', "Recovery link has been send to " . $email));
                        return redirect()->to("/login");
                    } else {
                        $data = [
                            'email' => $email,
                            'activity' => 'Recovery Password',
                            'description' => 'Failed sent email recovery password',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);

                        session()->setFlashdata("notif", $this->sessionMessage('error', "Something went wrong when send email"));
                        return redirect()->back();
                    }
                } else {
                    $data = [
                        'email' => $email,
                        'activity' => 'Recovery Password',
                        'description' => 'Email not active',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage('error', $email . " not active"));
                    return redirect()->back();
                }
            } else {
                $data = [
                    'email' => $email,
                    'activity' => 'Recovery Password',
                    'description' => 'Email not found',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                session()->setFlashdata("notif", $this->sessionMessage('error', "Email not found"));
                return redirect()->back();
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->request->getVar('email');
        $token_data = $this->userModel::dataTokenByEmail($email);
        if ($token_data) {
            if (strtotime($token_data['time_expired']) > strtotime($this->dateTime())) {
                $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
                $data = [
                    'title' => $this->setTitle('Your New Password'),
                    'metaDescription' => $this->setMetaDescription($description),
                    'layout' => $this->dirLayoutAuth,
                    'section' => $this->dirSectionAuth,
                    'email' => $email
                ];
                return view('auth/reset_password', $data);
            } else {

                $data = [
                    'email' => $email,
                    'activity' => 'Recovery Password',
                    'description' => 'Link Expired',
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];

                $throw_id = false;
                $table_name = 'log_auth_table';

                $this->helperModel::insertData($data, $throw_id, $table_name);

                $data = [
                    'otp' => $this->generateUniqueRandomNumbers(),
                    'token' => csrf_hash(),
                    'time_expired' => $this->dateTimeModify('+60 minutes'),
                    'updated_at' => $this->dateTime()
                ];

                $where = [
                    'email' => $email,
                ];

                $update = $this->helperModel::updateData($where, $data, 'token_table');

                $dataUsersByEmail = $this->userModel::dataUsersByEmail($email);

                $email_config = new \SendGrid\Mail\Mail();

                if ($update) {

                    $token = $this->userModel::dataTokenByEmail($email);

                    $email_config->setFrom('avizer95@gmail.com', 'Well Care Development');
                    $email_config->setSubject('Password Reset ' . $email);
                    $email_config->addTo($email);


                    $data_email = [
                        'name' => $dataUsersByEmail['nama_depan'],
                        'token' => $token['token'],
                        'email' => $token['email'],
                    ];

                    $email_config->addContent(
                        "text/html",
                        view('auth/template_reset_password', $data_email)
                    );
                    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                }

                if ($sendgrid->send($email_config)) {
                    $data = [
                        'email' => $email,
                        'activity' => 'Recovery Password',
                        'description' => 'Recovery link has been resend',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);
                } else {
                    $data = [
                        'email' => $email,
                        'activity' => 'Recovery Password',
                        'description' => 'Failed sent email when try to resend recovery link',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);
                }

                session()->setFlashdata("notif", $this->sessionMessage('info', "Link expired, we sent new link for you"));
                return redirect()->to('/login');
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page not found");
        }
    }

    public function newPassword($email)
    {
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).*$/]',
                'errors' => [
                    'min_length' => 'The Password length must least 8 character',
                    'regex_match' => 'The Password must first letter capital, number, and symbol (ex. $, !, @ etc)',
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $password = $this->request->getVar('password');

            $token_data = $this->userModel::dataTokenByEmail($email);

            if ($token_data) {
                if ($token_data['email'] == $email) {
                    $data = [
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'updated_at' => $this->dateTime()
                    ];
                    $where = [
                        'email' => $email,
                    ];

                    $update = $this->helperModel::updateData($where, $data, 'auth_table');

                    if ($update) {
                        $where = 'email';
                        $table = 'token_table';
                        $hard_delete = true;

                        $data = [];

                        $delete = $this->helperModel::deleteData($where, $email, $data, $table, $hard_delete);

                        if ($delete) {
                            session()->setFlashdata("notif", $this->sessionMessage('success', "Password recovered"));
                            return redirect()->to('/login');
                        } else {
                            $data = [
                                'email' => $email,
                                'activity' => 'Recovery Password',
                                'description' => 'Failed to delete token',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];

                            $throw_id = false;
                            $table_name = 'log_auth_table';

                            $this->helperModel::insertData($data, $throw_id, $table_name);

                            session()->setFlashdata("notif", $this->sessionMessage('error', "Something went wrong"));
                            return redirect()->to('/login');
                        }
                    } else {
                        $data = [
                            'email' => $email,
                            'activity' => 'Recovery Password',
                            'description' => 'Failed to update password',
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $throw_id = false;
                        $table_name = 'log_auth_table';

                        $this->helperModel::insertData($data, $throw_id, $table_name);

                        session()->setFlashdata("notif", $this->sessionMessage('error', "Something went wrong, please try again"));
                        return redirect()->back();
                    }
                } else {

                    $data = [
                        'email' => $email,
                        'activity' => 'Recovery Password',
                        'description' => 'Email not found',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];

                    $throw_id = false;
                    $table_name = 'log_auth_table';

                    $this->helperModel::insertData($data, $throw_id, $table_name);

                    session()->setFlashdata("notif", $this->sessionMessage('error', "Email not found"));
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata("notif", $this->sessionMessage('error', "Email not exist or to much request"));
                return redirect()->to('/login');
            }
        }
    }
    // END

    // Auth Logout
    public function logOut()
    {

        $data = [
            'email' => session()->get('email'),
            'activity' => 'Logout',
            'description' => 'User Logout',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ];

        $throw_id = false;
        $table_name = 'log_auth_table';

        $this->helperModel::insertData($data, $throw_id, $table_name);

        session()->destroy();

        return redirect()->to('/login');
    }
}
