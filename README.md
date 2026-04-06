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

---

## Parte 1 – Publicar la aplicación web (dominio público gratis)

### Opción recomendada: Netlify Drop (sin cuenta)
1. Ve a https://app.netlify.com/drop
2. Arrastra la carpeta `formulario_contacto_lasalle/` (solo los archivos HTML/CSS/JS, **sin la carpeta php**)
3. Netlify genera automáticamente una URL pública tipo `https://nombre-aleatorio.netlify.app`
4. Comparte esa URL con el profesor

### Opción alternativa: GitHub Pages
1. Crea un repositorio en GitHub
2. Sube los archivos HTML/CSS/JS
3. Ve a Settings → Pages → Branch: main → Save
4. URL: `https://tu-usuario.github.io/nombre-repo`

---

## Parte 2 – Ambiente de pruebas con XAMPP

### Paso 1: Instalar y abrir XAMPP
1. Descarga XAMPP desde https://www.apachefriends.org
2. Abre XAMPP Control Panel
3. Inicia los módulos **Apache** y **MySQL**

### Paso 2: Crear la base de datos
1. Abre el navegador y ve a http://localhost/phpmyadmin
2. Haz clic en **SQL** (pestaña superior)
3. Pega el contenido de `php/setup.sql` y ejecuta
4. Esto crea la base de datos `lasalle_pruebas`, la tabla `contactos` e inserta 3 registros de prueba

### Paso 3: Copiar los archivos PHP
1. Copia la carpeta `formulario_contacto_lasalle/` dentro de:
   ```
   C:\xampp\htdocs\formulario_contacto_lasalle\
   ```

### Paso 4: Probar en el navegador

| URL | Descripción |
|-----|-------------|
| `http://localhost/formulario_contacto_lasalle/index.html` | Página principal |
| `http://localhost/formulario_contacto_lasalle/contacto.html` | Formulario de contacto |
| `http://localhost/formulario_contacto_lasalle/php/ver_contactos.php` | Ver registros de la BD (SELECT) |
| `http://localhost/formulario_contacto_lasalle/php/insertar.php` | Insertar nuevo contacto (INSERT) |

### Paso 5: Verificar el flujo completo
1. Abre `ver_contactos.php` → debe mostrar los 3 registros del `setup.sql`
2. Abre `insertar.php` → llena el formulario y guarda
3. Vuelve a `ver_contactos.php` → el nuevo registro debe aparecer

---

## Tecnologías utilizadas
- HTML5, CSS3, JavaScript (vanilla)
- PHP 8 + MySQLi
- MySQL (via XAMPP)
- Netlify / GitHub Pages (despliegue)
