document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();
  let valid = true;

  const campos = [
    { id: "nombre", errId: "err-nombre", msg: "El nombre es obligatorio." },
    { id: "email", errId: "err-email", msg: "El correo es obligatorio." },
    { id: "asunto", errId: "err-asunto", msg: "Selecciona un asunto." },
    { id: "mensaje", errId: "err-mensaje", msg: "El mensaje es obligatorio." },
  ];

  campos.forEach(({ id, errId, msg }) => {
    const el = document.getElementById(id);
    const err = document.getElementById(errId);
    if (!el.value.trim()) {
      err.textContent = msg;
      el.classList.add("invalid");
      valid = false;
    } else {
      err.textContent = "";
      el.classList.remove("invalid");
    }
  });

  // Validar formato email
  const emailEl = document.getElementById("email");
  const emailErr = document.getElementById("err-email");
  if (
    emailEl.value.trim() &&
    !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value)
  ) {
    emailErr.textContent = "Ingresa un correo válido.";
    emailEl.classList.add("invalid");
    valid = false;
  }

  if (!valid) return; // Si hay errores, no enviamos

  // NUEVO: Enviar los datos al backend PHP via fetch
  const boton = this.querySelector('button[type="submit"]');
  boton.disabled = true;
  boton.textContent = "Enviando...";

  const formData = new FormData(this);

  fetch("php/insertar.php", {
    method: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    body: formData,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      if (data.ok) {
        // Ocultar formulario y mostrar mensaje de éxito
        document.getElementById("contactForm").style.display = "none";
        document.getElementById("successMsg").style.display = "block";
      } else {
        // Mostrar el error que vino del servidor
        alert("Error al enviar: " + data.error);
        boton.disabled = false;
        boton.textContent = "Enviar mensaje";
      }
    })
    .catch(function () {
      alert("No se pudo conectar con el servidor. Intenta de nuevo más tarde.");
      boton.disabled = false;
      boton.textContent = "Enviar mensaje";
    });
});

// Limpiar error al escribir
document.querySelectorAll("input, select, textarea").forEach(function (el) {
  el.addEventListener("input", function () {
    el.classList.remove("invalid");
    const err = document.getElementById("err-" + el.id);
    if (err) err.textContent = "";
  });
});
