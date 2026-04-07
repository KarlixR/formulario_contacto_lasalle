# Formulario de Contacto - Universidad La Salle

## Estructura del proyecto

```
formulario_contacto_lasalle/
├── index.html          → Página principal
├── contacto.html       → Formulario de contacto
├── css/
│   └── style.css       → Estilos
├── js/
│   └── validacion.js   → Validación del formulario
└── php/
    ├── config.php          → Configuración de BD
    ├── setup.sql           → Script para crear BD y tabla
    ├── ver_contactos.php   → Muestra registros (SELECT)
    └── insertar.php        → Inserta nuevos registros (INSERT)
```

## 🌐 Sitio web publicado

- **Página principal:** https://la-salle-contacto.infinityfreeapp.com/index.html
- **Formulario de contacto:** https://la-salle-contacto.infinityfreeapp.com/contacto.html
- **Ver contactos registrados:** https://la-salle-contacto.infinityfreeapp.com/php/ver_contactos.php

## Cambios realizados

### Commit 1 - Conexión formulario con backend PHP

- Se modificó `js/validacion.js` para enviar los datos del
  formulario al servidor usando `fetch` en lugar de solo
  mostrar un mensaje visual.
- Se modificó `php/insertar.php` para responder en formato
  JSON cuando recibe una petición desde el formulario.
- Ahora los datos del formulario se guardan correctamente
  en la base de datos.

---

## Tecnologías utilizadas

- HTML5, CSS3, JavaScript (vanilla)
- PHP 8 + MySQLi
- MySQL (via XAMPP)
- Netlify / GitHub Pages (despliegue)
