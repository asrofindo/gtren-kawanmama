<?php namespace Myth\Auth\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use App\Models\CategoryModel;

class AuthController extends Controller
{
	protected $auth;

	/**
	 * @var AuthConfig
	 */
	protected $config;

	/**
	 * @var Session
	 */
	protected $session;

	protected $helpers = ['auth','profile'];
	protected $data;
	public function __construct()
	{
		$this->user = new UserModel();

		$this->category = new CategoryModel();
		$this->data['category']    = $this->category->findAll();
		// Most services in this controller require
		// the session to be started - so fire it up!
		$this->session = service('session');

		$this->config = config('Auth');
		$this->auth = service('authentication');
	}

	//--------------------------------------------------------------------
	// Login/out
	//--------------------------------------------------------------------

	/**
	 * Displays the login form, or redirects
	 * the user to their destination/home if
	 * they are already logged in.
	 */
	public function login()
	{
		// No need to show a login form if the user
		// is already logged in.
		if ($this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
		$data =$this->category;
		return $this->_render($this->config->views['login'], ['config' => $this->config]);
	}

	/**
	 * Attempts to verify the user's credentials
	 * through a POST request.
	 */
	public function attemptLogin()
	{
		$rules = [
			'login'	=> ['rules' =>'required', 'errors' => ['required' => " Username atau Email harus diisi"]],
			'password' =>  ['rules' =>'required', 'errors' => ['required' => " Password harus diisi"]],
		];
		if ($this->config->validFields == ['email'])
		{
			$rules['login'] .= '|valid_email';
		}

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$login = $this->request->getPost('login');
		$password = $this->request->getPost('password');
		$remember = (bool)$this->request->getPost('remember');

		// Determine credential type
		$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		// Try to log them in...
		if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember))
		{
			return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
		}

		// Is the user being forced to reset their password?
		if ($this->auth->user()->force_pass_reset === true)
		{
			return redirect()->to(route_to('reset-password') .'?token='. $this->auth->user()->reset_hash)->withCookies();
		}

		$redirectURL = session('redirect_url') ?? site_url('/');
		unset($_SESSION['redirect_url']);

		return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
	}

	/**
	 * Log the user out.
	 */
	public function logout()
	{
		if ($this->auth->check())
		{
			$this->auth->logout();
		}

		return redirect()->to(site_url('/'));
	}

	//--------------------------------------------------------------------
	// Register
	//--------------------------------------------------------------------

	/**
	 * Displays the user registration page.
	 */
	public function register()
	{
        // check if already logged in.
		if ($this->auth->check())
		{
			return redirect()->back();
		}

        // Check if registration is allowed
		if (! $this->config->allowRegistration)
		{
			return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
		}

		return $this->_render($this->config->views['register'], ['config' => $this->config]);
	}

	/**
	 * Attempt to register a new user.
	 */
	public function attemptRegister()
	{
		// Check if registration is allowed
		if (! $this->config->allowRegistration)
		{
			return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
		}

		$users = model(UserModel::class);

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = [
			'username'  	=> ['rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]', 'errors' => ['required' => "Nama Pengguna harus diisi"]],
			'email'			=> ['rules' =>'required|valid_email|is_unique[users.email]', 'errors' => ['required' => "Email harus diisi"]],
			'password'	 	=> ['rules' =>'required|strong_password', 'errors' => ['required' => " Password harus diisi"]],
			'pass_confirm' 	=> ['rules' =>'required|matches[password]', 'errors' => ['required' => " Ulangi Password harus diisi", "matches" => "Password Tidak Sama"]],
		];

		$this->request;

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// Save the user
		if (empty($this->request->getPost('parent'))) {
			$allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
		}else{
			$allowedPostFields = array_merge(['password','parent'], $this->config->validFields, $this->config->personalFields);
			helper('wawoo');
				$user1 = $this->user1->where('id',$this->request->getPost('parent'))->first();
				wawoo($user1->phone,base_url()."\n\n".$user1->greeting." ".$user1->fullname.",\nSelamat Anda *Mendapatkan Affiliate Baru*\nSilahkan Cek Di : ".base_url('/jaringan'));
					if ($user1!=null && $user1->parent != null) {
						$user = $this->user->where('id',$user1->parent)->first();
						wawoo($user->phone,base_url()."\n\n".$user->greeting." ".$user->fullname.",\nAffiliate Anda ( ".$user1->fullname." / ".$user1->phone." ) *Mendapatkan Prospek Baru*.\nSilahkan Dibimbing");
					}
		}
		
		$user = new User($this->request->getPost($allowedPostFields));

		$this->config->requireActivation == null ? $user->activate() : $user->generateActivateHash();

		if ($this->request->getPost('role') !== null) {
            $users = $users->withGroup($this->request->getPost('role'));
        } else {
            $users = $users->withGroup('user');
        }

		// Ensure default group gets assigned if set
        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

		if (! $users->save($user))
		{
			return redirect()->back()->withInput()->with('errors', $users->errors());
		}
		
		if ($this->config->requireActivation !== null)
		{
			$activator = service('activator');
			$sent = $activator->send($user);

			if (! $sent)
			{
				return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
			}

			// Success!
			return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
		}

		// Success!
		return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
	}

	//--------------------------------------------------------------------
	// Forgot Password
	//--------------------------------------------------------------------

	/**
	 * Displays the forgot password form.
	 */
	public function forgotPassword()
	{
		if ($this->config->activeResetter === null)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		return $this->_render($this->config->views['forgot'], ['config' => $this->config]);
	}

	/**
	 * Attempts to find a user account with that password
	 * and send password reset instructions to them.
	 */
	public function attemptForgot()
	{
		if ($this->config->activeResetter === null)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$users = model(UserModel::class);

		$user = $users->where('email', $this->request->getPost('email'))->first();

		if (is_null($user))
		{
			return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
		}

		// Save the reset hash /
		$user->generateResetHash();
		$users->save($user);

		$resetter = service('resetter');
		$sent = $resetter->send($user);

		if (! $sent)
		{
			return redirect()->back()->withInput()->with('error', $resetter->error() ?? lang('Auth.unknownError'));
		}

		return redirect()->route('reset-password')->with('message', lang('Auth.forgotEmailSent'));
	}

	/**
	 * Displays the Reset Password form.
	 */
	public function resetPassword()
	{
		if ($this->config->activeResetter === null)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$token = $this->request->getGet('token');

		return $this->_render($this->config->views['reset'], [
			'config' => $this->config,
			'token'  => $token,
		]);
	}

	/**
	 * Verifies the code with the email and saves the new password,
	 * if they all pass validation.
	 *
	 * @return mixed
	 */
	public function attemptReset()
	{
		if ($this->config->activeResetter === null)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$users = model(UserModel::class);

		// First things first - log the reset attempt.
		$users->logResetAttempt(
			$this->request->getPost('email'),
			$this->request->getPost('token'),
			$this->request->getIPAddress(),
			(string)$this->request->getUserAgent()
		);

		$rules = [
			'token'		=> 'required',
			'email'		=> 'required|valid_email',
			'password'	 => 'required|strong_password',
			'pass_confirm' => 'required|matches[password]',
		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$user = $users->where('email', $this->request->getPost('email'))
					  ->where('reset_hash', $this->request->getPost('token'))
					  ->first();

		if (is_null($user))
		{
			return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
		}

        // Reset token still valid?
        if (! empty($user->reset_expires) && time() > $user->reset_expires->getTimestamp())
        {
            return redirect()->back()->withInput()->with('error', lang('Auth.resetTokenExpired'));
        }

		// Success! Save the new password, and cleanup the reset hash.
		$user->password 		= $this->request->getPost('password');
		$user->reset_hash 		= null;
		$user->reset_at 		= date('Y-m-d H:i:s');
		$user->reset_expires    = null;
        $user->force_pass_reset = false;
		$users->save($user);

		return redirect()->route('login')->with('message', lang('Auth.resetSuccess'));
	}

	/**
	 * Activate account.
	 *
	 * @return mixed
	 */
	public function activateAccount()
	{
		$users = model(UserModel::class);

		// First things first - log the activation attempt.
		$users->logActivationAttempt(
			$this->request->getGet('token'),
			$this->request->getIPAddress(),
			(string) $this->request->getUserAgent()
		);

		$throttler = service('throttler');

		// if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
        // {
		// 	return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
        // }

		$user = $users->where('activate_hash', $this->request->getGet('token'))
					  ->where('active', 0)
					  ->first();

		if (is_null($user))
		{
			return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
		}

		$user->activate();

		$users->save($user);

		return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
	}

	/**
	 * Resend activation account.
	 *
	 * @return mixed
	 */
	public function resendActivateAccount()
	{
		if ($this->config->requireActivation === null)
		{
			return redirect()->route('login');
		}

		$throttler = service('throttler');

		if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
		{
			return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
		}

		$login = urldecode($this->request->getGet('login'));
		$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		$users = model(UserModel::class);

		$user = $users->where($type, $login)
					  ->where('active', 0)
					  ->first();

		if (is_null($user))
		{
			return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
		}

		$activator = service('activator');
		$sent = $activator->send($user);

		if (! $sent)
		{
			return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
		}

		// Success!
		return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));

	}

	protected function _render(string $view, array $data = [])
	{
		return view($view, $data);
	}
}
