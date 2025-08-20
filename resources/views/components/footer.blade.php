<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<footer class="footer">
    <div class="footer-container">
        <!-- Sección Acerca de - siempre visible -->
        <div class="footer-section">
            <div class="footer-logo"></div>
            <h3 class="footer-brand-title">COCKTAIL WORLD</h3>
            <p>Tu destino definitivo para descubrir, aprender y crear los mejores cócteles. Desde recetas clásicas hasta creaciones modernas.</p>
            <div class="social-links">
                <a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a>
                <a href="#" title="Instagram"><i class='bx bxl-instagram'></i></a>
                <a href="#" title="Twitter"><i class='bx bxl-twitter'></i></a>
                <a href="#" title="YouTube"><i class='bx bxl-youtube'></i></a>
            </div>
        </div>

        <!-- Sección Contacto - solo en pagina principal -->
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
       

        <!-- Sección Enlaces - siempre sera visible -->
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

        <!-- Sección Newsletter - solo pagina principal -->
        @if(Request::routeIs('inicio') || Request::routeIs('/'))
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
        @endif
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} COCKTAIL WORLD. Todos los derechos reservados. | Diseñado para proyecto de instituto </p>
        <p>El consumo de alcohol puede ser perjudicial para la salud. Disfruta con responsabilidad.</p>
    </div>
</footer>