
# **The Alchemist's Folio: Documentación de Arquitectura y Especificaciones del Sistema**


## **1.0 Contexto del Proyecto y Visión Estratégica**


### **1.1 Análisis del Ecosistema Digital para Mixología**

El mercado de aplicaciones para coctelería está consolidado, con actores clave como Cocktail Flow <sup>1</sup>, Mixel, My Cocktail Bar <sup>3</sup> y Cocktail Party <sup>4</sup> estableciendo las expectativas de los usuarios. Un análisis competitivo revela que funcionalidades como la gestión de un inventario personal ("My Bar" o "Cabinet"), la sugerencia de recetas basadas en dicho inventario, la búsqueda por filtros (categoría, tipo, color) y la capacidad de marcar favoritos son ahora características estándar.<sup>1</sup>

La existencia casi universal de la función "¿qué puedo hacer con lo que tengo?" la convierte en un requisito de entrada, no en un diferenciador competitivo. Las críticas y quejas de los usuarios en estas plataformas no se centran en la ausencia de esta funcionalidad, sino en su implementación deficiente. Las debilidades recurrentes, que representan nuestras oportunidades estratégicas, incluyen: bases de datos de ingrediengenera

La estrategia central de "The Alchemist's Folio" es la creación de un ecosistema de datos superior y un "foso de datos" (Data Moat) que sea difícil de replicar. Este foso se construirá sobre dos pilares: una base de datos inicial robusta, poblada mediante la API de TheCocktailDB <sup>11</sup>, y un potente motor de Contenido Generado por el Usuario (UGC). El UGC será el verdadero diferenciador, abarcando recetas escaneadas mediante Reconocimiento Óptico de Caracteres (OCR) <sup>13</sup>, recetas introducidas manualmente, notas de cata personalizadas <sup>4</sup> y variaciones sobre recetas existentes.<sup>3</sup>

Este enfoque genera un círculo virtuoso de contenido. La integración inicial con TheCocktailDB <sup>11</sup> proporciona una masa crítica de recetas, haciendo que la aplicación sea útil desde el primer día. La función de OCR <sup>18</sup> actúa como un potente gancho de inversión emocional y de tiempo para el usuario; al digitalizar una receta familiar manuscrita, el usuario ancla su contenido personal y valioso a nuestra plataforma. Este contenido único, si el usuario decide compartirlo, enriquece la base de datos global, lo que a su vez mejora la calidad y la diversidad de las sugerencias para todos los demás usuarios. Mejores sugerencias atraen a más usuarios, quienes aportan más contenido, cerrando un ciclo que aumenta exponencialmente el valor de la plataforma y la barrera de entrada para la competencia.

Nuestras funcionalidades clave se centrarán en resolver las deficiencias del mercado:

- **Inventario Inteligente:** A diferencia de la competencia que trata los ingredientes de forma genérica (ej. "Gin") <sup>5</sup>, nuestro sistema permitirá una granularidad sin precedentes. Los usuarios podrán especificar "Hendrick's Gin" o "Tanqueray No. 10", lo que alimentará un motor de perfiles de sabor y sugerencias de sustitución inteligentes.
- **Funcionalidades Únicas Potenciadas por IA:** El "Laboratorio" para la generación de recetas mediante IA, el "Modo Viaje" para sugerencias contextuales con ingredientes limitados, y el filtro avanzado por "ingredientes faltantes" <sup>3</sup> se posicionarán como características de alto valor que van más allá de un simple recetario digital.

### **1.3 Arquitectura Tecnológica de Referencia**

La plataforma se construirá sobre una pila tecnológica moderna, robusta y escalable, seleccionada para optimizar el desarrollo y la mantenibilidad dentro del ecosistema Laravel.

- **Framework de Backend:** Laravel (PHP). Se elige por su ecosistema maduro, que incluye el ORM Eloquent para una interacción fluida con la base de datos, un sistema de colas integrado para gestionar tareas asíncronas como el procesamiento OCR, y un patrón de diseño MVC (Modelo-Vista-Controlador) que promueve un código limpio y organizado. <sup>7</sup>
- **Base de Datos:** Se recomienda MySQL 8+ o PostgreSQL. Ambas opciones ofrecen un rendimiento excelente, fiabilidad probada y soporte nativo para tipos de datos JSON, lo cual será útil para almacenar metadatos flexibles como los perfiles de sabor.
- **Arquitectura de Frontend (Monolítica con TALL Stack):** En lugar de una arquitectura desacoplada, se adoptará un enfoque monolítico utilizando Laravel en su máxima expresión. Las vistas se renderizarán directamente desde el servidor utilizando el motor de plantillas **Blade**. Para añadir interactividad y una experiencia de usuario reactiva sin la complejidad de un framework de JavaScript completo, se utilizará la pila **TALL**: Tailwind CSS, Alpine.js, Laravel y Livewire. <sup>9</sup>
  - **Livewire** permitirá crear componentes dinámicos utilizando PHP y Blade, minimizando la necesidad de escribir JavaScript. <sup>29</sup>
  - **Alpine.js** se utilizará para interacciones ligeras del lado del cliente que no requieran una comunicación con el servidor, como mostrar/ocultar modales o menús desplegables. <sup>31</sup>
- **Servicios Externos Clave:**
  - **API de Recetas:** TheCocktailDB.<sup>11</sup> Se utilizará para la población inicial de la base de datos de recetas e ingredientes.
  - **API de OCR:** OCR.space. Se integrará a través del paquete de Laravel cdsmths/laravel-ocr-space.<sup>20</sup> Se prefiere esta API sobre una solución autoalojada como Tesseract <sup>18</sup> para el MVP, ya que elimina la complejidad de gestionar dependencias a nivel de servidor y ofrece una integración más sencilla.
  - **API de IA Generativa:** OpenAI (GPT-4o, GPT-3.5-Turbo). Se integrará utilizando el paquete openai-php/laravel <sup>33</sup> para potenciar el "Laboratorio de Recetas" y el procesamiento de texto no estructurado.

## **2.0 Definición y Alcance del Producto**


### **2.1 Delimitación del Sistema para el Producto Mínimo Viable (MVP)**

El MVP se centrará en entregar el núcleo de la propuesta de valor de forma rápida y eficiente, permitiendo validar las hipótesis clave con usuarios reales.

- **RF-MVP-01: Autenticación y Gestión de Usuarios:** Registro estándar (email/contraseña), inicio de sesión y un perfil de usuario básico.
- **RF-MVP-02: Gestión de Inventario (Básica):** Funcionalidad para que los usuarios seleccionen los ingredientes que poseen de una lista maestra y los añadan a su "bar".
- **RF-MVP-03: Población Inicial de Datos:** Un script de importación para poblar las tablas de recetas e ingredientes de la aplicación utilizando la API de TheCocktailDB.<sup>12</sup>
- **RF-MVP-04: Recetario Básico:** Visualización de las recetas importadas, con capacidad de búsqueda por nombre e ingrediente.
- **RF-MVP-05: Motor de Sugerencias (Nivel 1):** Implementación de dos filtros esenciales:
  - Mostrar recetas que se pueden preparar con el 100% de los ingredientes del inventario del usuario.
  - Mostrar recetas a las que les falta un único ingrediente, una característica muy valorada en apps como My Cocktail Bar y Cocktail Party.<sup>3</sup>
- **RF-MVP-06: Registro de Recetas (Manual):** Un formulario completo que permite a los usuarios introducir sus propias recetas.
- **RF-MVP-07: Registro de Recetas (OCR - Nivel 1):** Implementación del flujo de escaneo básico, inspirado en aplicaciones como CookBook.<sup>15</sup> El usuario subirá una imagen, el sistema la procesará con OCR.space <sup>21</sup> y presentará el texto extraído en un formulario de edición para que el usuario lo revise, corrija y estructure manualmente.

### **2.2 Hoja de Ruta de Evolución (Post-MVP)**

Tras el lanzamiento del MVP, el producto evolucionará en fases planificadas para introducir progresivamente las funcionalidades avanzadas.

- **Fase 2 (Inventario Inteligente y OCR con IA):** Desarrollo de la granularidad de los ingredientes (marcas, tipos), perfiles de sabor y el motor de sustitución inteligente. Se mejorará el flujo de OCR utilizando la API de GPT para analizar el texto extraído y estructurarlo automáticamente en formato JSON, reduciendo la necesidad de corrección manual. <sup>37</sup>
- **Fase 3 (Funcionalidades Avanzadas):** Implementación completa de las características diferenciadoras: el "Laboratorio" de generación de recetas con IA y el "Modo Viaje" con perfiles de inventario virtuales.
- **Fase 4 (Comunidad y Social):** Introducción de funcionalidades para compartir recetas, seguir a otros usuarios, calificar recetas <sup>1</sup> y crear "libros de cócteles" públicos, inspirados en las colecciones de Cocktail Flow.<sup>1</sup>
- **Fase 5 (Monetización):** Implementación de un modelo de suscripción freemium. El modelo de Cocktail Flow, con suscripciones mensuales y anuales <sup>1</sup>, servirá como referencia para desbloquear características premium como OCR ilimitado o análisis avanzados.

### **2.3 Dependencias Críticas y Puntos de Integración**

El éxito del proyecto depende de la correcta integración con servicios de terceros y de decisiones arquitectónicas clave.

- **TheCocktailDB API:** Es fundamental adquirir la clave de API Premium ($10 de por vida).<sup>25</sup> Esta clave da acceso a endpoints cruciales que no están en la versión gratuita, como el filtro por múltiples ingredientes (
  filter.php?i=Dry\_Vermouth,Gin,Anis), que es vital para el rendimiento y la lógica del motor de sugerencias.
- **OCR.space API:** Se requiere una clave de API, aunque el plan gratuito será suficiente para el desarrollo y las pruebas iniciales.<sup>21</sup> El proceso de OCR debe diseñarse para ser asíncrono utilizando el sistema de colas de Laravel. Esto es crítico para la experiencia del usuario, ya que evita que la interfaz se bloquee mientras se procesa la imagen, una operación que puede tardar varios segundos.
- **OpenAI API:** Se necesitará una clave de API de OpenAI. La integración se realizará a través del paquete openai-php/laravel <sup>33</sup>, que simplifica las llamadas a la API y la gestión de credenciales. Las llamadas a la API de GPT también deben ser asíncronas para no afectar la experiencia del usuario.
- **Procesamiento de Datos Externos:** La API de TheCocktailDB presenta una deuda técnica inherente en su estructura de respuesta; los ingredientes y medidas se devuelven en campos no normalizados como strIngredient1, strMeasure1, strIngredient2, etc..<sup>26</sup> Un enfoque ingenuo de almacenar los datos tal como se reciben crearía una estructura de base de datos inflexible y prácticamente imposible de consultar de manera eficiente. La estrategia correcta, y obligatoria desde el inicio, es implementar un proceso de Ingesta, Transformación y Carga (ETL). Este proceso, encapsulado en un servicio de importación, analizará la respuesta de la API, identificará cada par de ingrediente/medida y los insertará de forma normalizada en las tablas relacionales del sistema (
  recipes, ingredients, recipe\_ingredients). Aunque requiere un mayor esfuerzo inicial, este enfoque es la única forma de garantizar la viabilidad y el rendimiento a largo plazo del motor de búsqueda y sugerencias.

## **3.0 Roles de Usuario y Matriz de Acceso**

Se definen tres roles de usuario principales, cada uno con necesidades y casos de uso distintos.

### **3.1 Perfil: El Bartender Profesional**

- **Necesidades:** Este usuario valora la eficiencia, la precisión y el acceso rápido a su repertorio personal y profesional. Necesita herramientas para la creatividad, como la creación y modificación de recetas sobre la marcha, y la capacidad de gestionar inventarios para diferentes contextos (ej. el bar principal, un bar de eventos especiales).
- **Funciones Clave:** El "Laboratorio" será su herramienta principal para la innovación. La función de OCR le permitirá digitalizar rápidamente ideas o otras fuentes. La capacidad de añadir notas técnicas y privadas a las recetas <sup>4</sup> es crucial para registrar detalles de preparación o variaciones.

### **3.2 Perfil: El Aficionado / Entusiasta del Hogar**

- **Necesidades:** Este usuario busca descubrir nuevas recetas, aprender técnicas de coctelería y, sobre todo, maximizar el uso del inventario limitado que tiene en casa. La planificación de compras para probar nuevos cócteles es también una necesidad clave, como lo demuestran las solicitudes de los usuarios de una función de "lista de la compra" en aplicaciones competidoras.<sup>5</sup>
- **Funciones Clave:** El motor de sugerencias y el filtro por "ingredientes faltantes" serán las herramientas más utilizadas. Las guías de ingredientes y los perfiles de sabor (post-MVP) le ayudarán en su proceso de aprendizaje.

### **3.3 Perfil: Administrador del Sistema**

- **Necesidades:** El administrador es responsable de la integridad y calidad de los datos maestros de la plataforma. Esto incluye la gestión de la lista canónica de ingredientes, la curación de las recetas base y la moderación del contenido público generado por los usuarios.
- **Funciones Clave:** Acceso a un panel de administración con operaciones CRUD (Crear, Leer, Actualizar, Borrar) sobre las tablas maestras de ingredientes y recetas, así como herramientas para la gestión de usuarios y sus permisos.

### **3.4 Matriz de Permisos por Rol**

La siguiente tabla define los permisos de acceso para cada rol. Esta matriz es un documento fundamental para el desarrollo, ya que traduce los perfiles de usuario en reglas de negocio concretas que se implementarán en el backend (utilizando Gates y Policies de Laravel). Formalizar estos permisos desde el principio previene ambigüedades y asegura una lógica de autorización coherente y segura.

|Funcionalidad|Bartender Profesional|Aficionado / Entusiasta|Administrador|
| :- | :- | :- | :- |
|Crear Receta (Manual/OCR)|Sí|Sí|Sí|
|Editar Receta Propia|Sí|Sí|Sí|
|Editar Receta de Otro Usuario|No|No|Sí|
|Marcar Receta como Pública|Sí|Sí|Sí|
|Ver "Laboratorio"|Sí|Sí|Sí|
|Gestionar Inventario Personal|Sí|Sí|N/A|
|Crear Múltiples Inventarios (Premium)|Sí|No|N/A|
|Ver Notas Privadas de Otros|No|No|No|
|Añadir Notas a Recetas|Sí|Sí|Sí|
|Acceder al Panel de Administración|No|No|Sí|
|Gestionar Ingredientes Maestros|No|No|Sí|
|Gestionar Recetas Base del Sistema|No|No|Sí|

## **4.0 Especificación de Interfaces del Sistema**


### **4.1 Interfaces de Usuario (UI/UX)**

El diseño de la interfaz se inspirará en la estética limpia, visualmente atractiva y de alta calidad fotográfica elogiada en aplicaciones como Cocktail Flow y Cocktail Party.<sup>1</sup> La experiencia de usuario será fluida e intuitiva, construida con componentes Blade y potenciada con Livewire y Alpine.js.

El flujo de escaneo OCR, un componente crítico, se diseñará siguiendo las mejores prácticas de aplicaciones especializadas como CookBook <sup>15</sup> y OrganizEat.<sup>17</sup> El proceso para el usuario será el siguiente:

1. El usuario pulsa el botón "Añadir Receta" y selecciona la opción "Escanear desde Foto".
1. Se muestra un componente Livewire que permite subir un archivo de imagen.
1. El usuario toma o selecciona una foto. Se le presenta una vista previa con herramientas para recortar y ajustar la imagen (usando Alpine.js para la interactividad).
1. Tras confirmar, el componente Livewire sube la imagen al servidor y muestra un indicador de carga no bloqueante mientras la imagen se procesa en segundo plano.
1. Una vez completado el proceso, el componente Livewire se actualiza para mostrar la pantalla de "Revisión y Corrección". Esta pantalla mostrará, por un lado, el texto extraído por el OCR y, por otro, los campos estructurados del formulario de receta (nombre, ingredientes, instrucciones). El usuario podrá entonces corregir y asignar fácilmente el texto a los campos correspondientes.

### **4.2 Arquitectura de Controladores y Rutas**

Al ser una aplicación monolítica de Laravel, la lógica de enrutamiento y control seguirá las convenciones del framework.

- **Rutas:** Definidas en routes/web.php. Se utilizarán rutas estándar para las operaciones CRUD y las vistas principales (ej. Route::get('/recipes',)).
- **Controladores:** Se mantendrán "delgados" (skinny controllers). Su responsabilidad principal será orquestar la respuesta a una petición, delegando la lógica de negocio a clases de servicio y la lógica de base de datos a los modelos Eloquent. <sup>16</sup>
- **Componentes Livewire:** Para las secciones altamente interactivas (como el inventario "Mi Bar" o el motor de sugerencias), se utilizarán componentes Livewire. Cada componente encapsulará su propia vista Blade, lógica de backend (propiedades y métodos públicos) y se comunicará con el servidor vía AJAX de forma transparente para el desarrollador. <sup>29</sup>

### **4.3 Interfaces Externas (Integraciones)**

La interacción con servicios externos se encapsulará en clases de servicio dedicadas para promover un código limpio y mantenible (principio de responsabilidad única).

- **Wrapper de TheCocktailDB:** Se creará una clase CocktailDBService. Sus responsabilidades serán:
  - Realizar las llamadas HTTP a la API de TheCocktailDB.<sup>12</sup>
  - Gestionar la clave de API, utilizando la clave del entorno (.env).
  - Implementar una capa de caché (usando Redis o el sistema de caché de archivos de Laravel) para las peticiones a la API.
  - Realizar la transformación de la respuesta no normalizada de la API <sup>26</sup> en colecciones de objetos PHP o arrays estructurados.
- **Wrapper de OCR.space:** Se creará una clase OcrSpaceService, que internamente utilizará el paquete cdsmths/laravel-ocr-space.<sup>21</sup>
  - Esta clase expondrá un método simple, como processImage(string $imagePath): OcrJob.
  - Toda la lógica de la llamada a la API, el manejo de la clave y el análisis de la respuesta JSON <sup>20</sup> estarán completamente encapsulados dentro de este servicio.
- **Wrapper de OpenAI:** Se creará una clase OpenAIService que utilizará el facade OpenAI proporcionado por el paquete openai-php/laravel. <sup>33</sup>
  - Expondrá métodos de alto nivel como generateRecipe(array $parameters) y structureText(string $text).
  - Encapsulará la construcción de los "prompts" y la configuración de los parámetros de la API (modelo, temperatura, etc.), aislando al resto de la aplicación de los detalles de la interacción con GPT.

## **5.0 Requerimientos Detallados del Sistema**


### **5.1 Requerimientos Funcionales (RF)**

- **RF-01: Gestión de Cuentas de Usuario:** El sistema debe permitir a los usuarios registrarse, iniciar sesión, cerrar sesión y recuperar su contraseña a través de un enlace enviado por correo electrónico.
- **RF-02: Gestión de Inventario:** El usuario debe poder navegar o buscar en una lista maestra de ingredientes y marcar aquellos que posee. La interfaz debe permitir añadir y quitar ingredientes de su inventario de forma rápida.
- **RF-03: Registro de Recetas:**
  - **RF-03a (Manual):** El sistema debe proporcionar un formulario detallado para que los usuarios creen sus propias recetas. Los campos incluirán nombre, descripción, lista de ingredientes con cantidades y unidades, instrucciones paso a paso, tipo de vaso recomendado, guarnición e imagen.
  - **RF-03b (OCR con Asistencia de IA):** El sistema debe aceptar la carga de una imagen (formatos JPG, PNG). Utilizará la API de OCR.space para extraer el texto.<sup>21</sup> Opcionalmente (Post-MVP), el texto extraído se enviará a la API de OpenAI para ser analizado y estructurado en formato JSON, pre-llenando el formulario de receta con mayor precisión. <sup>37</sup>
- **RF-04: Motor de Sugerencias:**
  - **RF-04a (Sugerencia Exacta):** El sistema debe mostrar una lista de todas las recetas para las cuales el usuario posee el 100% de los ingredientes requeridos.
  - **RF-04b (Sugerencia "Casi allí"):** El sistema debe mostrar una lista separada de recetas para las cuales al usuario le falta un único ingrediente. Esta es una característica clave para incentivar la compra y ampliar el repertorio del usuario.<sup>3</sup>
  - **RF-04c (Modo Viaje):** El sistema debe permitir al usuario activar un "Modo Viaje". En este modo, las sugerencias se basarán en un perfil de inventario virtual predefinido.
- **RF-05: Laboratorio de Recetas con IA:** El sistema debe proporcionar una interfaz de experimentación ("Laboratorio") donde el usuario pueda especificar parámetros (ej. licor base, perfil de sabor, tipo de cóctel) y solicitar a la API de OpenAI que genere una receta nueva y original. El sistema deberá mostrar la receta generada para que el usuario pueda guardarla en su colección. <sup>39</sup>

### **5.2 Análisis Comparativo de Soluciones OCR**

La elección del motor de OCR es una decisión arquitectónica crítica. La siguiente tabla compara la solución autoalojada (Tesseract) con la solución basada en API (OCR.space) para justificar la elección de esta última para el MVP.

|Criterio|Tesseract (vía alimranahmed/laraocr <sup>18</sup>)|OCR.space API (vía cdsmths/laravel-ocr-space <sup>20</sup>)|Justificación de la Elección|
| :- | :- | :- | :- |
|**Coste**|Gratuito (software de código abierto).|Modelo Freemium. Plan gratuito con límites, planes de pago para mayor volumen.<sup>21</sup>|Para el volumen del MVP, el plan gratuito de OCR.space es suficiente y no introduce costes operativos.|
|**Precisión**|Buena para texto impreso. Menos fiable con escritura a mano o imágenes de baja calidad.|Alta precisión, especialmente con sus motores avanzados (Engine2). Mejor rendimiento en una variedad de condiciones de imagen.<sup>21</sup>|La mayor precisión de la API reduce la fricción para el usuario, que tendrá que hacer menos correcciones manuales.|
|**Complejidad de Implementación**|Alta. Requiere instalación y configuración de binarios en el servidor. La gestión de dependencias puede ser problemática. <sup>18</sup>|Baja. Se integra a través de un paquete de Composer y una clave de API. No hay dependencias a nivel de servidor.<sup>21</sup>|La simplicidad de la API acelera drásticamente el desarrollo del MVP.|
|**Requisitos del Servidor**|Requiere acceso a la línea de comandos del servidor para instalar el motor Tesseract y sus paquetes de idiomas.<sup>18</sup>|Ninguno, más allá de la capacidad de realizar peticiones HTTP cURL, estándar en cualquier entorno PHP.|Elimina una dependencia crítica del entorno de despliegue, facilitando el uso de plataformas de hosting compartido o PaaS.|
|**Mantenimiento**|El equipo de desarrollo es responsable de actualizar Tesseract y gestionar cualquier problema de compatibilidad.|Cero. El mantenimiento y la mejora del motor de OCR son responsabilidad del proveedor del servicio.|**Elección para el MVP: OCR.space.** Se elige por su baja complejidad, nulos requisitos de servidor y mayor precisión, lo que permite un desarrollo más rápido y una mejor experiencia de usuario inicial.|
|**Escalabilidad**|La escalabilidad depende de la capacidad del servidor. Puede requerir múltiples workers y servidores potentes.|Altamente escalable. La carga de procesamiento es manejada por la infraestructura del proveedor.||

### **5.3 Requerimientos No Funcionales (RNF)**

- **RNF-01 (Rendimiento):** Las consultas clave, como las del motor de sugerencias, deben ejecutarse en menos de 500 milisegundos. El tiempo de carga de cualquier página de la aplicación no debe superar los 2 segundos en una conexión de banda ancha estándar.
- **RNF-02 (Seguridad):** Se implementarán todas las mejores prácticas de seguridad. Las contraseñas se almacenarán hasheadas con bcrypt. La aplicación estará protegida contra ataques comunes como Cross-Site Scripting (XSS), Cross-Site Request Forgery (CSRF) e inyección SQL, aprovechando las protecciones nativas de Laravel.
- **RNF-03 (Escalabilidad):** La arquitectura debe diseñarse para ser horizontalmente escalable. El uso de colas para tareas pesadas (procesamiento OCR, llamadas a API de IA, envío de correos) es fundamental para desacoplar componentes y permitir que el sistema maneje picos de carga sin degradar el rendimiento para el usuario.
- **RNF-04 (Mantenibilidad):** El código fuente deberá adherirse a los estándares de codificación PSR-12. Se requerirá una cobertura de pruebas adecuada (pruebas unitarias y de integración) utilizando PHPUnit para garantizar la estabilidad y facilitar futuras modificaciones.

## **6.0 Modelado de Procesos de Negocio Clave**


### **6.1 Flujo de Proceso: Desde la Fotografía a la Receta Digitalizada (Proceso OCR)**

Este proceso describe el viaje asíncrono de una imagen de receta hasta convertirse en datos estructurados.

1. El Usuario pulsa "Escanear Receta" en la vista Blade.
1. Un Componente Livewire maneja la subida del archivo de imagen.
1. El método del componente Livewire recibe la petición, la valida y almacena la imagen en una ubicación temporal.
1. El componente despacha un nuevo Job (ej. ProcessOcrImage) a la Cola de Tareas (gestionada por Redis o la base de datos). Este Job contiene la ruta a la imagen almacenada.
1. El componente Livewire muestra al usuario un indicador de que la receta se está "procesando".
1. En el servidor, un Worker de Laravel toma el Job para su procesamiento.
1. El Job invoca al OcrSpaceService, pasándole la ruta de la imagen.
1. El OcrSpaceService se comunica con la API externa de OCR.space, enviando la imagen para su análisis.<sup>21</sup>
1. La API de OCR.space procesa la imagen y devuelve el texto extraído en formato JSON.<sup>20</sup>
1. El Job recibe la respuesta JSON, la analiza, y almacena el resultado crudo en la base de datos (en la tabla ocr\_jobs).
1. (Post-MVP) El Job puede opcionalmente enviar el texto crudo al OpenAIService con un prompt para estructurarlo.
1. Una vez completado, el Job emite un evento (ej. OcrProcessingComplete).
1. El Componente Livewire escucha este evento, recupera los datos procesados y actualiza su estado, mostrando al usuario la pantalla de "Revisión y Corrección" con los campos pre-llenados.

### **6.2 Flujo de Proceso: Generación de Sugerencias de Cócteles**

Este proceso describe cómo el sistema genera las listas "Puedes Hacer" y "Necesitas 1 Ingrediente" dentro de un componente Livewire.

1. El Usuario navega a la sección de "Sugerencias", que es renderizada por un Componente Livewire.
1. El método render() del componente invoca un SuggestionService.
1. El SuggestionService primero recupera el inventario activo del usuario de la base de datos: SELECT ingredient\_id FROM inventories WHERE user\_id =? AND in\_stock = true.
1. A continuación, el servicio ejecuta la consulta SQL principal, que está optimizada para calcular los ingredientes faltantes para todas las recetas de una sola vez. Una implementación eficiente para MySQL o PostgreSQL sería:
   SQL
   SELECT 
   `    `r.id, 
   `    `r.name,
   `    `r.image\_url,
   `    `COUNT(ri.ingredient\_id) AS total\_ingredients,
   `    `SUM(CASE WHEN i.ingredient\_id IS NOT NULL THEN 1 ELSE 0 END) AS user\_has\_count,
   `    `(COUNT(ri.ingredient\_id) - SUM(CASE WHEN i.ingredient\_id IS NOT NULL THEN 1 ELSE 0 END)) AS missing\_count
   FROM recipes r
   JOIN recipe\_ingredients ri ON r.id = ri.recipe\_id
   LEFT JOIN inventories i ON ri.ingredient\_id = i.ingredient\_id AND i.user\_id =?
   GROUP BY r.id, r.name, r.image\_url
   HAVING missing\_count <= 1
   ORDER BY missing\_count ASC, r.name ASC;
1. El servicio devuelve los resultados al componente Livewire.
1. El método render() del componente pasa los resultados a su vista Blade.
1. La Vista Blade renderiza dos listas separadas en la interfaz de usuario: una para las recetas con missing\_count = 0 ("Puedes Hacer Ahora") y otra para las recetas con missing\_count = 1 ("Necesitas 1 Ingrediente").

## **7.0 Componentes Innovadores y Estrategias de Crecimiento**


### **7.1 Arquitectura del "Modo Viaje"**

El "Modo Viaje" se implementará como una funcionalidad que permite al usuario obtener sugerencias de cócteles realistas cuando viaja. En lugar de ser un simple filtro, se diseñará como un sistema de "Perfiles de Inventario Virtuales".

- Se creará una tabla virtual\_inventory\_profiles en la base de datos.
- Esta tabla contendrá perfiles predefinidos como "Bar de Hotel Básico", "Bar de Playa Tropical" o "Bar de Speakeasy Clásico".
- Cada perfil estará asociado a una lista de ingredientes en una tabla pivote virtual\_inventory\_ingredients.
- Cuando un usuario activa el "Modo Viaje" y selecciona un perfil, el SuggestionService utilizará los ingredientes de ese perfil virtual como base para la consulta, en lugar del inventario personal del usuario.

### **7.2 Generación de Recetas con IA en el "Laboratorio"**

El "Laboratorio de Recetas" será la característica más innovadora, utilizando la API de OpenAI para generar cócteles.

- **Interfaz de Usuario:** Un formulario (componente Livewire) permitirá al usuario introducir parámetros como:
  - Licor base (ej. Gin, Ron, Whisky).
  - Perfil de sabor deseado (ej. Cítrico, Amargo, Dulce, Herbal).
  - Tipo de cóctel (ej. Sour, Highball, Tiki).
  - Ingredientes específicos a incluir o excluir.
- **Interacción con la IA:**
  - Al enviar el formulario, se llamará a un método en el OpenAIService.
  - Este servicio construirá un "prompt" detallado para la API de GPT. El prompt instruirá al modelo para que actúe como un mixólogo experto y cree una receta original basada en los parámetros, solicitando la respuesta en un formato JSON estructurado y predecible. <sup>37</sup>
  - Ejemplo de prompt: "Eres un mixólogo de clase mundial. Crea una receta de cóctel original de estilo 'Tiki' que use 'Gin' como licor base y tenga un perfil de sabor 'Cítrico'. La receta debe incluir ingredientes, cantidades en onzas y mililitros, instrucciones paso a paso, y el tipo de vaso recomendado. Devuelve el resultado como un objeto JSON con las claves 'name', 'ingredients', 'instructions', y 'glass'."
  - La respuesta JSON de la API se analizará y se mostrará al usuario en un formato legible. Si al usuario le gusta la receta, podrá guardarla en su colección personal con un solo clic.

### **7.3 Potencial de Monetización y Comunidad**

El modelo de negocio más viable y probado en este sector es el de suscripción freemium.<sup>1</sup> Se propondrá una estructura de dos niveles:

- **Nivel Gratuito:** Acceso a todas las funcionalidades básicas, incluyendo la gestión de un inventario, el motor de sugerencias, la creación manual de recetas y un límite mensual de escaneos OCR y generaciones de recetas con IA.
- **Nivel Premium (ej. $4.99/mes o $49.99/año):** Este nivel desbloqueará el valor completo de la plataforma. Incluirá usos ilimitados de OCR y del Laboratorio de IA, acceso completo al "Inventario Inteligente" con perfiles de sabor y sugerencias de sustitución, el "Modo Viaje", la capacidad de crear y gestionar múltiples inventarios, y el acceso a colecciones de recetas exclusivas.

## **8.0 Modelo Detallado de la Base de Datos**


### **8.1 Diagrama Entidad-Relación (DER)**

Se desarrollará un diagrama Entidad-Relación visual para representar las relaciones entre las tablas definidas a continuación. Este diagrama servirá como referencia visual clave para el equipo de desarrollo.

### **8.2 Diccionario de Datos**

A continuación se detalla la estructura de cada tabla principal en la base de datos.

- **users**: Almacena la información de las cuentas de usuario.
  - id (PK, BigInt, Unsigned)
  - name (String)
  - email (String, Unique)
  - password (String, Hashed)
  - role (Enum: 'admin', 'professional', 'hobbyist'): Se utiliza un ENUM para simplificar la gestión de roles en la fase inicial.
  - created\_at, updated\_at (Timestamps)
- **ingredients**: La tabla maestra canónica de todos los ingredientes posibles.
  - id (PK, BigInt, Unsigned)
  - name (String, Unique): Nombre del ingrediente (ej. "Hendrick's Gin").
  - description (Text, Nullable)
  - is\_alcoholic (Boolean)
  - parent\_ingredient\_id (FK a ingredients.id, Nullable): Clave para el inventario inteligente. Permite agrupar variantes bajo un ingrediente genérico (ej. "Hendrick's Gin" tiene como padre a "Gin").
  - flavor\_profile\_tags (JSON, Nullable): Almacena etiquetas de sabor para el motor de sustitución (ej. ["juniper", "citrus", "floral"]).
  - source\_api\_id (String, Nullable, Index): Almacena el ID del ingrediente de TheCocktailDB para evitar duplicados durante la sincronización.<sup>11</sup>
- **recipes**: Almacena todas las recetas, tanto las del sistema como las de los usuarios.
  - id (PK, BigInt, Unsigned)
  - name (String)
  - instructions (Text)
  - glass\_type (String, Nullable)
  - garnish (String, Nullable)
  - image\_url (String, Nullable)
  - user\_id (FK a users.id, Nullable): Es NULL para las recetas base del sistema y apunta al usuario para el UGC.
  - source (Enum: 'system', 'user\_manual', 'user\_ocr', 'user\_ai\_generated'): Indica el origen de la receta.
  - is\_private (Boolean, Default: true): Controla la visibilidad de las recetas de los usuarios.
  - source\_api\_id (String, Nullable, Index): Almacena el ID del cóctel de TheCocktailDB.<sup>11</sup>
- **recipe\_ingredients** (Tabla Pivote): Relaciona recetas con ingredientes y especifica la cantidad.
  - id (PK)
  - recipe\_id (FK a recipes.id, On-Delete: Cascade)
  - ingredient\_id (FK a ingredients.id, On-Delete: Restrict): Se restringe el borrado para no dejar recetas huérfanas.
  - amount (Decimal)
  - unit (String): ej. 'ml', 'oz', 'dash', 'leaf'.
- **inventories**: Representa el "bar" de cada usuario, indicando qué ingredientes posee.
  - id (PK)
  - user\_id (FK a users.id)
  - ingredient\_id (FK a ingredients.id)
  - in\_stock (Boolean, Default: true)
  - quantity\_ml (Integer, Nullable): Para un seguimiento de inventario más preciso (Post-MVP).
  - *Constraint: Unique(user\_id, ingredient\_id)*
- **user\_favorites**: Tabla pivote para marcar recetas favoritas.
  - user\_id (FK a users.id)
  - recipe\_id (FK a recipes.id)
  - *Constraint: Primary Key(user\_id, recipe\_id)*
- **user\_recipe\_notes**: Almacena las notas personales que un usuario añade a una receta.
  - id (PK)
  - user\_id (FK a users.id)
  - recipe\_id (FK a recipes.id)
  - note (Text)
  - created\_at, updated\_at
- **ocr\_jobs**: Tabla para gestionar el estado de los trabajos de escaneo asíncrono.
  - id (UUID, PK): Se usa UUID para que el ID sea ingenerable por terceros.
  - user\_id (FK a users.id)
  - status (Enum: 'pending', 'processing', 'completed', 'failed')
  - original\_image\_path (String)
  - raw\_result (JSON, Nullable): Almacena la respuesta completa de la API de OCR.
  - error\_message (Text, Nullable): Para depuración en caso de fallo.
  - created\_at, updated\_at

### **8.3 Ejemplos de Migraciones en Laravel**

A continuación se muestran ejemplos de cómo se verían los ficheros de migración de Laravel para algunas de las tablas clave, ilustrando la implementación práctica del modelo.

**Migración de la tabla recipes:**

PHP


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
`    `public function up(): void
`    `{
`        `Schema::create('recipes', function (Blueprint $table) {
`            `$table->id();
`            `$table->string('name');
`            `$table->text('instructions');
`            `$table->string('glass\_type')->nullable();
`            `$table->string('garnish')->nullable();
`            `$table->string('image\_url')->nullable();
`            `$table->foreignId('user\_id')->nullable()->constrained()->onDelete('set null');
`            `$table->enum('source', ['system', 'user\_manual', 'user\_ocr', 'user\_ai\_generated']);
`            `$table->boolean('is\_private')->default(true);
`            `$table->string('source\_api\_id')->nullable()->index();
`            `$table->timestamps();
`        `});
`    `}
};

**Migración de la tabla recipe\_ingredients (Pivote):**

PHP


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
`    `public function up(): void
`    `{
`        `Schema::create('recipe\_ingredients', function (Blueprint $table) {
`            `$table->id();
`            `$table->foreignId('recipe\_id')->constrained()->onDelete('cascade');
`            `$table->foreignId('ingredient\_id')->constrained()->onDelete('restrict');
`            `$table->decimal('amount', 8, 2);
`            `$table->string('unit');
`            `$table->timestamps();
`        `});
`    `}
};

**Migración de la tabla inventories:**

PHP


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
`    `public function up(): void
`    `{
`        `Schema::create('inventories', function (Blueprint $table) {
`            `$table->id();
`            `$table->foreignId('user\_id')->constrained()->onDelete('cascade');
`            `$table->foreignId('ingredient\_id')->constrained()->onDelete('cascade');
`            `$table->boolean('in\_stock')->default(true);
`            `$table->unsignedInteger('quantity\_ml')->nullable();
`            `$table->timestamps();

`            `$table->unique(['user\_id', 'ingredient\_id']);
`        `});
`    `}
};
#### **Obras citadas**
1. How to use the Recipe Scanner - CookBook FAQ, fecha de acceso: julio 17, 2025, <https://help.cookbookmanager.com/hc/en-gb/articles/360002691375>
1. alimranahmed/LaraOCR: Laravel Optical Character Reader(OCR) package using ocr engines(Tesseract) - GitHub, fecha de acceso: julio 17, 2025, <https://github.com/alimranahmed/LaraOCR>
1. Cocktail Flow - Drink Recipes - APK Download for Android | Aptoide, fecha de acceso: julio 17, 2025, <https://cocktail-flow.en.aptoide.com/app>
1. A Laravel package for interaction with the https://ocr.space API - GitHub, fecha de acceso: julio 17, 2025, <https://github.com/cdsmths/laravel-ocr-space>
1. Cocktail Flow - Drink Recipes on the App Store, fecha de acceso: julio 17, 2025, <https://apps.apple.com/vn/app/cocktail-flow-drink-recipes/id486811622>
1. Cocktail Database API Documentation | API Specifications & Integration Guide, fecha de acceso: julio 17, 2025, <https://allthingsdev.co/apimarketplace/documentation/%20Cocktail%20Database%20API/662f7c663ca85f9ecc6d714b>
1. What are your Laravel best practices? - Reddit, fecha de acceso: julio 17, 2025, <https://www.reddit.com/r/laravel/comments/f34t86/what_are_your_laravel_best_practices/>
1. Building MVC Applications in PHP Laravel: Part 1 - CODE Magazine, fecha de acceso: julio 17, 2025, <https://www.codemag.com/Article/2205071/Building-MVC-Applications-in-PHP-Laravel-Part-1>
1. Tall stack, fecha de acceso: julio 17, 2025, <https://tallstack.dev/>
1. A TALL (Tailwind CSS, Alpine.js, Laravel and Livewire) Preset for Laravel - GitHub, fecha de acceso: julio 17, 2025, <https://github.com/laravel-frontend-presets/tall>
1. TheCocktailDB.com - Free Cocktail API, fecha de acceso: julio 17, 2025, <https://www.thecocktaildb.com/>
1. Free Cocktail API - TheCocktailDB.com, fecha de acceso: julio 17, 2025, <https://www.thecocktaildb.com/api.php>
1. OCR PDF's and images with the OCR.Space API from Laravel - Laravel News, fecha de acceso: julio 17, 2025, <https://laravel-news.com/package/cdsmths-laravel-ocr-space>
1. Effective Strategies for Optimizing Code Efficiency with MVC Architecture in Laravel Framework - MoldStud, fecha de acceso: julio 17, 2025, <https://moldstud.com/articles/p-effective-strategies-for-optimizing-code-efficiency-with-mvc-architecture-in-laravel-framework>
1. Understanding the Laravel MVC Architecture - Everything You Need to know 2025 - Pixlogix, fecha de acceso: julio 17, 2025, <https://www.pixlogix.com/laravel-mvc-architecture/>
1. GitHub - alexeymezenin/laravel-best-practices, fecha de acceso: julio 17, 2025, <https://github.com/alexeymezenin/laravel-best-practices>
1. Developing Software using the TALL and VILT Stacks | Curotec, fecha de acceso: julio 17, 2025, <https://www.curotec.com/insights/comparing-the-features-of-tall-and-vilt-stacks/>
1. Cocktail Flow - Drink Recipes on the App Store - Apple, fecha de acceso: julio 17, 2025, <https://apps.apple.com/us/app/cocktail-flow-drink-recipes/id486811622>
1. Cocktail Flow - CodeProject, fecha de acceso: julio 17, 2025, <https://www.codeproject.com/Articles/472072/Cocktail-Flow>
1. Mixit Cocktails: drink recipes - App Store, fecha de acceso: julio 17, 2025, <https://apps.apple.com/us/app/mixit-cocktails-drink-recipes/id1548476411>
1. My Cocktail Bar - Apps on Google Play, fecha de acceso: julio 17, 2025, <https://play.google.com/store/apps/details?id=com.mybarapp.free>
1. Cocktail Party app, fecha de acceso: julio 17, 2025, <https://cocktailpartyapp.com/>
1. Cocktail Flow v2 is here with 300 new cocktails and new features : r/androidapps - Reddit, fecha de acceso: julio 17, 2025, <https://www.reddit.com/r/androidapps/comments/a883z7/cocktail_flow_v2_is_here_with_300_new_cocktails/>
1. 7 Simple Ways to Digitize Old Family Recipes - OrganizEat, fecha de acceso: julio 17, 2025, <https://home.organizeat.com/blog/simple-ways-to-digitize-old-family-recipes/>
1. TheCocktailDB API — Free Public API | Public APIs Directory, fecha de acceso: julio 17, 2025, <https://publicapis.io/the-cocktail-db-api>
1. Laravel SpaceOCR: Parse Images and Multi-page PDFs in Laravel - Laravel News, fecha de acceso: julio 17, 2025, <https://laravel-news.com/laravel-spaceocr>
1. TALL Stack: Building Modern Web Applications with Laravel | by John O | Medium, fecha de acceso: julio 17, 2025, <https://medium.com/@jorniks/tall-stack-building-modern-web-applications-with-laravel-f66d7b5580f3>
1. I'm building an app with a TALL stack now (Tailwind, Alpine.js, Laravel, and Liv... | Hacker News, fecha de acceso: julio 17, 2025, <https://news.ycombinator.com/item?id=24925693>
1. Compare Alpine.js vs. Livewire in 2025, fecha de acceso: julio 17, 2025, <https://slashdot.org/software/comparison/Alpine.js-vs-Livewire/>
1. What are the pros and cons of Livewire? : r/laravel - Reddit, fecha de acceso: julio 17, 2025, <https://www.reddit.com/r/laravel/comments/1h48jp5/what_are_the_pros_and_cons_of_livewire/>
1. Alpine - Laravel Livewire, fecha de acceso: julio 17, 2025, <https://livewire.laravel.com/docs/alpine>
1. AlpineJS | Laravel Livewire, fecha de acceso: julio 17, 2025, <https://laravel-livewire.com/docs/2.x/alpine-js>
1. ️ OpenAI PHP for Laravel is a supercharged PHP API client that allows you to interact with OpenAI API - GitHub, fecha de acceso: julio 17, 2025, <https://github.com/openai-php/laravel>
1. Integrating ChatGPT API with Laravel 11 Web Development, Software, and App Blog, fecha de acceso: julio 17, 2025, <https://200oksolutions.com/blog/integrating-chatgpt-api-with-laravel-11/>
1. OpenAI PHP for Laravel is a supercharged PHP API client that allows you to interact with the Open AI API - Laravel News, fecha de acceso: julio 17, 2025, <https://laravel-news.com/package/openai-php-laravel>
1. Laravel OpenAI Package: A Comprehensive Guide - Redberry International, fecha de acceso: julio 17, 2025, <https://redberry.international/laravel-openai-package-overview/>
1. How can I use OpenAI to extract structured data from unstructured text? - Milvus, fecha de acceso: julio 17, 2025, <https://milvus.io/ai-quick-reference/how-can-i-use-openai-to-extract-structured-data-from-unstructured-text>
1. Using ChatGPT To Parse Unstructured Text - The Data School Down Under, fecha de acceso: julio 17, 2025, <https://www.thedataschool.com.au/daniel-lawson/using-chatgpt-to-parse-unstructured-text/>
1. How To Integrate ChatGPT API to Laravel | by Muhammad Fikri - Medium, fecha de acceso: julio 17, 2025, <https://vkri.medium.com/how-to-integrate-chatgpt-api-to-laravel-b730844fb083>
1. How to Integrate GPT into Your Laravel App in 2024 - Slashdev.io, fecha de acceso: julio 17, 2025, <https://slashdev.io/-how-to-integrate-gpt-into-your-laravel-app-in-2024>
1. maltekuhr/laravel-gpt: LaravelGPT: Streamlined integration of OpenAI's ChatGPT (GPT-3.5, GPT-4) into Laravel applications for advanced AI-powered text generation and analysis. - GitHub, fecha de acceso: julio 17, 2025, <https://github.com/maltekuhr/laravel-gpt>
1. Is there any better approach to get a Json from gpt? - API - OpenAI Developer Community, fecha de acceso: julio 17, 2025, <https://community.openai.com/t/is-there-any-better-approach-to-get-a-json-from-gpt/698337>
