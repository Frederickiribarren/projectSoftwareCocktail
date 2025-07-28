<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
    body {
       display: flex;
       justify-content: center;
       align-items: center;
       min-height: 100vh;
       background: url({{ asset('img/HERO.png') }}) no-repeat center center fixed;
    }

    .login-container {
        width: 420px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        color: white;
        border-radius: 10px;
        padding: 30px 40px
    }

    .login-container h2 {
        font-size: 36px;
        text-align: center;
    }

    .login-container .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;

    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: #fff;
    }

    .input-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .input-box .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 20px;
    }

    .remember-forgot label input {
        accent-color: #fff;
        margin-right: 3px;
    }

     .remember-forgot a {
        color: #fff;
        text-decoration: none;
    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }

    .login-container .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
        margin-top: 15px;
    }

    .login-container .register-link {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;
    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }


</style>

<link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="">
        <div class="input-box">
            <input type="text" id="text" name="text" placeholder="Usuario" required>
            <i class='bx  bxs-user'  ></i> 
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <i class='bx  bxs-lock'  ></i> 
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" id="remember" name="remember">Recuerdame</label>
            <a href="">¿Olvidaste tu contraseña?</a>
        </div>
        <button class="btn" type="submit">Login</button>
        <div class="register-link">
            <p>¿No tienes una cuenta? <a href="">Regístrate aquí</a></p>
        </div>
    </form>
</div>