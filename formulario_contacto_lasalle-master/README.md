# Formulario de Contacto - Universidad La Salle

## Estructura del proyecto

```
formulario_contacto_lasalle/
├── index.html          → Página principal
├── contacto.php        → Formulario de contacto (con seguridad CSRF)
├── css/
│   ├── style.css       → Estilos principales y diseño responsive
│   └── admin.css       → Estilos del panel administrativo
├── js/
│   └── validacion.js   → Validación y envío del formulario
└── php/
├── config.php          → Configuración de BD
├── setup.sql           → Script para crear BD y tabla
├── ver_contactos.php   → Muestra registros con estadísticas
├── insertar.php        → Inserta nuevos registros
├── login.php           → Panel de administración
└── logout.php          → Cierre de sesión
```

## Sitio web publicado

- **Página principal:** https://la-salle-contacto.infinityfreeapp.com/index.html
- **Formulario de contacto:** https://la-salle-contacto.infinityfreeapp.com/contacto.php
- **Ver contactos registrados:** https://la-salle-contacto.infinityfreeapp.com/php/ver_contactos.php
- **Panel admin:** https://la-salle-contacto.infinityfreeapp.com/php/login.php

## Cambios realizados

### Commit 1 - Conexión formulario con backend PHP

- Se modificó `js/validacion.js` para enviar los datos al servidor usando `fetch`.
- Se modificó `php/insertar.php` para responder en formato JSON.
- Los datos del formulario ahora se guardan correctamente en la base de datos.

### Commit 2 - Actualización de configuración y mejora de ver_contactos

- Se actualizó `php/config.php` con los datos de la nueva base de datos.
- Se mejoró el diseño de `php/ver_contactos.php` con estadísticas y badges de colores.

### Commit 3 - Ajustes de estilos, títulos y datos de contacto

- Se ajustó el título de la página principal.
- Se actualizaron los datos de contacto.
- Se mejoró el CSS con diseño responsive para móviles.

### Commit 4 - Panel de administración y seguridad

- Se agregó `contacto.php` con protección CSRF.
- Se agregó panel admin con `php/login.php` y `php/logout.php`.
- Se agregó `.gitignore` para proteger archivos sensibles.
- Se agregó `css/admin.css` con estilos del panel administrativo.

### Commit 5 - Preparación para Producción / Despliegue 
- feat es para cuando el usuario ve algo nuevo (un formulario, un botón).

- chore es para el "trabajo detrás de escena" (actualizar el .gitignore, cambiar una ruta en la base de datos, organizar carpetas).

- Con este commit, tu historial de GitHub se verá muy limpio

## Tecnologías utilizadas

- HTML5, CSS3, JavaScript (vanilla)
- PHP 8 + MySQLi
- MySQL (InfinityFree)
- GitHub (control de versiones)
