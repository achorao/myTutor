<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use CodeIgniter\Controller;
use DateTime;
use DateInterval;

class User extends BaseController
{

    #Functions for the practices

    protected $helpers = ['url', 'form'];
    protected $session;

    public function __construct()
    {
        $session = session();
        helper(['form', 'url']);
    }

    public function authenticate($email, $password)
    {
        #method to check that a user exists in the database

        $user = $this->where('email', $email)->first();
        if ($user && password_verify($password, $user->password))
            return $user;
        return FALSE;
    }

    #LOGIN

    public function getLogin()
    {
        $data = [];
        echo view("templates/header", $data);
        echo view('user_view/login', $data);
        echo view("templates/footer", $data);
    }
    public function getLogout()
    {
        session()->destroy();
        $session = session();
        $session->set([
            'user_id' => '',
            'username' => '',
            'email' => '',
            'phone' => 0,
            'isLoggedIn' => false,
            'role' => 'none'
        ]);
        return redirect()->to('/user/login');

    }

    public function postLogin()
    {
        // Check if the form was submitted
        if ($this->request->getMethod() === 'post') {
            // Get the form input data
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            // Create a new instance of the UserModel
            $userModel = new UserModel();

            // Check if the user exists

            $user = $userModel->where('email', $email)->first();
            if ($user && password_verify($password, $user->password)) {
                // Store user data in session
                $session = session();
                $session->set([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'isLoggedIn' => true,
                    'role' => $user->role
                ]);

                $role = $session->get('role');
                $data['users'] = $userModel->findAll();
                $data['content'] = view('user_view/list', $data);
                $data['username'] = $session->get('username');
                $data['email'] = $session->get('email');
                $data['phone'] = $session->get('phone');
                $data['role'] = $session->get('role');
                #show the page
                #if it is an admin, it shows the user list

                if ($role == "admin") {
                    echo ('/user/list');
                }
                #if it is a tutor, it calls the show tutor page function
                else if ($role == "tutor") {
                    return redirect()->to('/user/tutor_profile');
                }

                #if it is a student, it calls the show student page function
                else {
                    return redirect()->to('/');
                }

            } else {
                // Redirect to login page with an error message
                return view('/user_view/unauthorized');
            }
        }
    }
    public function getStudent_profile()
    {
        $classModel = new \App\Models\ClassModel();
        $session = session();
        $data['username'] = $session->get('username');
        $data['email'] = $session->get('email');
        $data['phone'] = $session->get('phone');
        $data['role'] = $session->get('role');
        //we get the id of the user from the session and 
        //get the classes that the user is enrolled in from the class model
        $id = $session->get('user_id');
        $data['id'] = $session->get('user_id');
        $classes = $classModel->where('student_id', $id)->findAll();
        $data['classes'] = $classes;
        echo view("templates/header", $data);
        echo view('student/profile', $data);
        echo view("templates/footer", $data);
    }

    public function postDeleteclass()
    {
        $classModel = new \App\Models\ClassModel();
        $id = $this->request->getPost('class_id');
        $classModel->delete($id);
        return redirect()->to('/user/student_profile');
    }

    public function getTutor_profile()
    {

        $subjectModel = new \App\Models\SubjectModel();
        $classModel = new \App\Models\ClassModel();
        $subjects = $subjectModel->findAll();
        $session = session();
        $id = $session->get('user_id');
        $data['username'] = $session->get('username');
        $data['email'] = $session->get('email');
        $data['phone'] = $session->get('phone');
        $data['role'] = $session->get('role');
        $data['subjects'] = $subjects;

        $classes = $classModel->where('tutor_id', $id)->findAll();
        $data['classes'] = $classes;
        echo view("templates/header", $data);
        echo view('tutor/profile', $data);
        echo view("templates/footer", $data);
    }


    public function getCalender($tutor_id, $subject_id)
    {
        $classModel = new \App\Models\classModel();
        $userModel = new \App\Models\UserModel();
        $session = session();

        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            // Redirect to the login page if the user is not logged in
            $data['message'] = "You must be logged in to schedule a class.";
            return view('errors/html/error_404', $data);
        }

        $classes = $classModel->where('tutor_id', $tutor_id)->where('subject_id', $subject_id)->findAll();
        $tutor = $userModel->find($tutor_id);
        $data = [
            'tutor' => $tutor,
            'classes' => $classes
        ];

        echo view('templates/header');
        echo view('/user_view/calender', $data);
        echo view('templates/footer');

    }


    public function postAdd_class()
    {
        $session = session();
        $classModel = new \App\Models\ClassModel();
        $userModel = new \App\Models\UserModel();
        $subjectModel = new \App\Models\SubjectModel();
        $tutor_id = $session->get('user_id');
        $subject = $this->request->getPost('subject');
        $start_time = $this->request->getPost('start_time');
        $end_time = $this->request->getPost('end_time');
        $date = $this->request->getPost('date');

        $start_dateTime = $date . ' ' . $start_time;
        $end_dateTime = $date . ' ' . $end_time;
        $new_class = [
            'subject_id' => $subject,
            'tutor_id' => $tutor_id,
            'start_time' => $start_dateTime,
            'end_time' => $end_dateTime,
            'occupied' => '0'
        ];
        $classModel->insert($new_class);

        redirect()->to('/user/tutor_profile');
    }
    #delete a user
    public function postDelete($id)
    {
        $classModel = new \App\Models\ClassModel();
        $userModel = new \App\Models\UserModel();

        $classes = $classModel->where('tutor_id', $id)->findAll();
        foreach ($classes as $class) {
            $classModel->delete($class->id);
        }

        $userDeleted = $userModel->delete($id);
        if (!$userDeleted) {
            // Handle delete failure
        }

        $data['users'] = $userModel->findAll();
        $data['content'] = view('user_view/list', $data);
        echo view("templates/header", $data);
        echo view('user_view/list', $data);
        echo view("templates/footer", $data);

        return $this->response->setJSON(['success' => true, 'users' => $data['users']]);
    }
    public function postReserveclass()
    {
        $session = session();
        $classModel = new \App\Models\ClassModel();
        $userModel = new \App\Models\UserModel();
        $class_id = $this->request->getPost('class_id');
        $student_id = $session->get('user_id');
        $class = $classModel->find($class_id);
        $class->occupied = '1';
        $class->student_id = $student_id;
        $classModel->save($class);
        $data['classes'] = $classModel->findAll();

        $this->response->setJSON(['success' => true, 'classes' => $data['classes']]);
        // go to the student profile page
        return redirect()->to('/user/student_profile');

    }
    #edit a user
    public function getEditUser($id)
    {
        // Display the user edit form
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            // Handle the error
        }
        $data['target_user'] = $user;
        $data['content'] = view('user_view/edit', $data);
        echo view('templates/header', $data);
        echo view('user_view/edit', $data);
        echo view('templates/footer', $data);



    }

    public function postEdit()
    {


        // Load the user model
        $userModel = new \App\Models\UserModel();
        $id = $this->request->getPost('id');
        // Get the user data
        $user = $userModel->find($id);

        if (!$user) {
            // Handle user not found error
        }

        // Check if the form was submitted
        if ($this->request->getMethod() === 'post') {

            // Validate input data
            $rules = [
                'username' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'role' => 'required'
            ];

            if (!$this->validate($rules)) {
                // Display the validation errors
                $data['validation'] = $this->validator;
            } else {
                // Update the user record in the database
                $userModel->update($id, [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'role' => $this->request->getPost('role')
                ]);
                $user = $userModel->find($id);
                // update the session data
                $session = session();
                $session->set('username', $user->username);
                $session->set('email', $user->email);
                $session->set('role', $user->role);

                // Redirect to the user list page
                if ($user->role == 'tutor') {
                    return redirect()->to('/user/tutor_profile');
                }
                if ($user->role == 'student') {
                    return redirect()->to('/user/student_profile');
                } else {
                    return redirect()->to('/user/list');
                }
            }
        }


    }

    #REGISTER

    public function getRegister($errors = null)
    {
        echo view("templates/header");
        echo view('user_view/register', ['errors' => $errors]);
        echo view("templates/footer");
    }

    public function postRegister()
    {
        // Check if the form was submitted
        if ($this->request->getMethod() === 'post') {
            // Get the form input data
            $role = $this->request->getPost('role');
            if ($role == '') {
                $role = 'student';
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => $role,
            ];

            // Set validation rules for the form fields
            $validationRules = [
                'username' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'role' => 'required',
            ];

            // Set validation messages for the form fields
            $validationMessages = [
                'username' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username should have at least 3 characters',
                ],
                'email' => [
                    'required' => 'Email address is required',
                    'valid_email' => 'Please enter a valid email address',
                ],
                'password' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password should have at least 6 characters',
                ],
                'role' => [
                    'required' => 'User role is required',
                ],
            ];

            // Run the validation and display errors if there are any
            $validation = \Config\Services::validation();
            $validation->setRules($validationRules, $validationMessages);
            if (!$validation->run($data)) {
                $errors = $validation->getErrors();
                return $this->getRegister($errors);
            }
            // Check if the user already exists
            $userModel = new UserModel();
            $existingUser = $userModel->where('username', $data['username'])
                ->orWhere('email', $data['email'])
                ->first();
            if ($existingUser) {
                // Redirect back to the form with an error message
                $errors = [];
                $errors['username'] = 'Username or email already exists';
                return $this->getRegister($errors);
            }

            // Hash the password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // Create a new instance of the UserModel
            $userModel = new UserModel();

            // Insert the data into the users table
            if ($userModel->insert($data)) {
                // Redirect to a success page or show a success message
                return redirect()->to('/');
            } else {
                // Redirect to an error page or show an error message
                return view('/errors/html/error_404');
            }
        }
    }


    #PAGES

    public function getUser_ok()
    {
        echo view("templates/header");
        echo view('user_view/user_ok');
        echo view("templates/footer");
    }

    public function getlist()
    {
        #if not admin redirect to home
        $session = session();
        if ($session->get('role') != 'admin') {
            return redirect()->to('/');
        }

        #get the model data
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user_view/list', $data);

        #show the page

        #echo view('templates/main', $data);

        echo view("templates/header", $data);
        echo view('user_view/list', $data);
        echo view("templates/footer", $data);

    }


}