<style>
    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }
</style>

<?= $this->view("zay_shop/header", $data); ?>
<div class="login-page">
    <p><?php check_message() ?></p>
    <div class="form">
        <!-- <form action="<?= ROOT ?>AdminController/dashboard" class="login-form" method="POST"> -->
        <!-- <form action="AuthController/login" class="login-form" method="POST"> -->
        <form class="login-form" method="POST">
            <input type="text" name="username" placeholder="username" required />
            <input type="password" name="password" placeholder="password" required />
            <button>login</button>
            <p class="message">Not registered? <a href="<?= ROOT ?>AuthController/register">Create an account</a></p>
        </form>
    </div>
</div>
<?= $this->view("zay_shop/footer", $data); ?>