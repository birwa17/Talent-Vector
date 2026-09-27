<?php
session_start();
require 'config.php'; 

function render($template, $data = []) {
    extract($data);
    include "$template.php";
}

function index() {
    render('index');
}

function login() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid credentials!";
        }
    }
    render('login');
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

function signup() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $password]);
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    render('signup');
}

function forgot_password() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->execute([$new_password, $email]);
        header("Location: login.php");
        exit();
    }
    render('forgot_password');
}

function contact() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $stmt = $pdo->prepare("INSERT INTO contact_messages (username, email, subject, message) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $subject, $message]);
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    render('contact');
}

function screen_resumes() {
    render('resume_screening');
}

$uri = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');

switch ($uri) {
    case '':
    case 'index.php':
        index();
        break;
    case 'login':
    case 'login.php':
        login();
        break;
    case 'logout':
    case 'logout.php':
        logout();
        break;
    case 'signup':
    case 'signup.php':
        signup();
        break;
    case 'forgot_password':
    case 'forgot_password.php':
        forgot_password();
        break;
    case 'pdf2text':
    case 'pdf2text.php':
        render('pdf2text');
        break;
    case 'resume_templates':
    case 'resume_templates.php':
        render('resume_templates');
        break;
    case 'how_to_make_resume':
    case 'how_to_make_resume.html':
        render('how_to_make_resume');
        break;
    case 'quiz_question':
    case 'quiz_question.php':
        render('quiz_question');
        break;
    case 'resume_screening':
    case 'resume_screening.php':
        screen_resumes();
        break;
    case 'resume_selection':
    case 'resume_selection.php':
        render('resume_selection');
        break;
    case 'resume_form':
    case 'resume_form.php':
        render('resume_form');
        break;
    case 'final_resume':
    case 'final_resume.php':
        render('final_resume');
        break;
    case 'submit_resume':
        case 'submit_resume.php':
            render('submit_resume');
            break;
    case 'preview_resume':
    case 'preview_resume.php':
        render('preview_resume');
        break;
    case 'contact':
    case 'contact.php':
        contact();
        break;
    case 'faq':
    case 'faq.php':
        render('faq');
        break;
    case 'submit_faq':
    case 'submit_faq.php':
        render('submit_faq');
        break;
    case 'website_func':
    case 'website_func.html':
        render('website_func');
        break;
    default:
        http_response_code(404);
        echo "Page not found.";
        break;
}
?>
