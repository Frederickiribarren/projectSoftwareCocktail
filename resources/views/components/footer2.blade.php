<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    :root {
        --primary-color: #1a1a1a;
        --secondary-color: #ffffff;
        --accent-color: #ffd700;
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
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        align-items: start;
    }

    .footer-section {
        display: flex;
        flex-direction: column;
    }
    .footer-section:not(:first-child) {
        margin-top: 84px; 
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
        margin-top: 0;
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
        background-image: url({{ asset('img/logoST1.png') }});
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        border-radius: 16px;
        border: 2px solid var(--accent-color);
        margin-bottom: 20px;
        box-shadow: var(--shadow-subtle);
    }

        /* Mejorar espaciado entre elementos */
    .footer-section p {
        margin-bottom: 16px; 
    }

    .contact-info p {
        margin-bottom: 16px; 
    }

    .footer-section ul li {
        margin-bottom: 8px; 
    }

    .footer-section ul li a {
        padding: 10px 0; 
    }

    @media (max-width: 1024px) {
        .footer-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        padding: 0 20px;
    }
    .footer-section:not(:first-child) {
        margin-top: 0; /* Resetear margen en móvil */
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

        
    }

    @media (max-width: 480px) {
        .footer-container {
        grid-template-columns: 1fr;
        gap: 24px;
        padding: 0 16px;
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
        </div>

        <!-- Sección Enlaces -->
        <div class="footer-section">
            <h3>Enlaces de Interés</h3>
            <ul>
                <li><a href="">Recetas de Cócteles</a></li>
                <li><a href="">Biblioteca de Bar</a></li>
                <li><a href="">Política de Privacidad</a></li>
                <li><a href="">Términos y Condiciones</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} INFINITY INFUSIONS. Todos los derechos reservados. | Diseñado para proyecto de instituto </p>
        <p>El consumo de alcohol puede ser perjudicial para la salud. Disfruta con responsabilidad.</p>
    </div>
</footer>