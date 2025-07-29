<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    :root {
        --primary-color: #1a1a1a;
        --secondary-color: #ffffff;
        --accent-color: #ffd700;
        --accent-hover: #f0c400;
        --text-primary: #ffffff;
        --text-secondary: #cccccc;
        --text-muted: #999999;
        --background-dark: #0d0d0d;
        --background-card: rgba(255, 255, 255, 0.03);
        --border-color: rgba(255, 255, 255, 0.08);
        --shadow-subtle: 0 2px 10px rgba(0, 0, 0, 0.1);
        --shadow-elevated: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .footer {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-dark) 100%);
        color: var(--text-primary);
        padding: 60px 0 30px;
        margin-top: auto;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        position: relative;
        overflow: hidden;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 32px;
    }

    .footer-section h3 {
        color: var(--text-primary);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-section h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 32px;
        height: 2px;
        background: var(--accent-color);
        border-radius: 2px;
    }

    .footer-section p,
    .footer-section li {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 12px;
        font-weight: 400;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        padding: 8px 0;
        font-weight: 400;
        position: relative;
    }

    .footer-section ul li a::before {
        content: '';
        width: 0;
        height: 1px;
        background: var(--accent-color);
        position: absolute;
        bottom: 4px;
        left: 0;
        transition: width 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: var(--text-primary);
        transform: translateX(4px);
    }

    .footer-section ul li a:hover::before {
        width: 100%;
    }

    .contact-info {
        margin-bottom: 20px;
    }

    .contact-info p {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }

    .contact-info i {
        color: var(--accent-color);
        margin-right: 12px;
        width: 20px;
        font-size: 16px;
    }

    .social-links {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .social-links a {
        width: 44px;
        height: 44px;
        background: var(--background-card);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        border: 1px solid var(--border-color);
        font-size: 18px;
    }

    .social-links a:hover {
        background: var(--accent-color);
        color: var(--text-primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-elevated);
        border-color: var(--accent-color);
    }

    .footer-bottom {
        margin-top: 48px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
        text-align: center;
        color: var(--text-muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .footer-logo {
        width: 64px;
        height: 64px;
        background-image: url({{ asset('img/logo2.png') }});
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        border-radius: 16px;
        border: 2px solid var(--accent-color);
        margin-bottom: 20px;
        box-shadow: var(--shadow-subtle);
    }

    .newsletter {
        background: var(--background-card);
        padding: 24px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .newsletter:hover {
        border-color: var(--accent-color);
        box-shadow: var(--shadow-subtle);
    }

    .newsletter input {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.02);
        color: var(--text-primary);
        margin-bottom: 16px;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .newsletter input:focus {
        border-color: var(--accent-color);
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    }

    .newsletter input::placeholder {
        color: var(--text-muted);
        font-weight: 400;
    }

    .newsletter button {
        width: 100%;
        padding: 14px 20px;
        background: var(--accent-color);
        color: var(--text-primary);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .newsletter button:hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
        box-shadow: var(--shadow-elevated);
    }

    .newsletter button:active {
        transform: translateY(0);
    }

    @media (max-width: 1024px) {
        .footer-container {
            gap: 24px;
            grid-template-columns: repeat(4, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .footer {
            padding: 40px 0 20px;
        }
        
        .footer-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            padding: 0 20px;
        }
        
        .social-links {
            justify-content: center;
        }

        .footer-section h3 {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .newsletter {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .footer-container {
            grid-template-columns: 1fr;
            padding: 0 16px;
        }

        .newsletter input,
        .newsletter button {
            padding: 12px 16px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
</style>


<footer class="footer">
    <div class="footer-container">
        <!-- Sección Acerca de -->
        <div class="footer-section">
            <div class="footer-logo"></div>
            <h3>INFINITY INFUSIONS</h3>
            <p>Tu destino definitivo para descubrir, aprender y crear los mejores cócteles. Desde recetas clásicas hasta creaciones modernas.</p>
            <div class="social-links">
                <a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a>
                <a href="#" title="Instagram"><i class='bx bxl-instagram'></i></a>
                <a href="#" title="Twitter"><i class='bx bxl-twitter'></i></a>
                <a href="#" title="YouTube"><i class='bx bxl-youtube'></i></a>
            </div>
        </div>

        <!-- Sección Contacto -->
        <div class="footer-section">
            <h3>Contacto</h3>
            <div class="contact-info">
                <p><i class='bx bx-map'></i>Av. Cocktail Master #123, Santiago, Chile</p>
                <p><i class='bx bx-phone'></i>Mesa Central: (+56) 2 2697 2121</p>
                <p><i class='bx bx-envelope'></i>info@cocktailmaster.cl</p>
            </div>
            
            <h3 style="margin-top: 25px;">Atención</h3>
            <p>Lunes a Viernes de 09:00 a 18:00 hrs.</p>
            <p>Sábados de 10:00 a 14:00 hrs.</p>
        </div>

        <!-- Sección Enlaces -->
        <div class="footer-section">
            <h3>Enlaces de Interés</h3>
            <ul>
                <li><a href="">Recetas de Cócteles</a></li>
                <li><a href="">Biblioteca de Bar</a></li>
                <li><a href="">Utensilios Profesionales</a></li>
                <li><a href="">Ingredientes Premium</a></li>
                <li><a href="">Política de Privacidad</a></li>
                <li><a href="">Términos y Condiciones</a></li>
            </ul>
        </div>

        <!-- Sección Newsletter -->
        <div class="footer-section">
            <h3>Newsletter</h3>
            <div class="newsletter">
                <p>Suscríbete para recibir las mejores recetas y tips de mixología directamente en tu correo.</p>
                <form action="#" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Tu correo electrónico" required>
                    <button type="submit">Suscribirse</button>
                </form>
            </div>
            
            <h3 style="margin-top: 25px;">Síguenos</h3>
            <p>Mantente al día con nuestras últimas creaciones y eventos especiales en nuestras redes sociales.</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} INFINITY INFUSIONS. Todos los derechos reservados. | Diseñado para proyecto de instituto </p>
        <p>El consumo de alcohol puede ser perjudicial para la salud. Disfruta con responsabilidad.</p>
    </div>
</footer>