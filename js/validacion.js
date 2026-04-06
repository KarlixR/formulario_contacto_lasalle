document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();
  let valid = true;

  const campos = [
    { id: 'nombre', errId: 'err-nombre', msg: 'El nombre es obligatorio.' },
    { id: 'email',  errId: 'err-email',  msg: 'El correo es obligatorio.' },
    { id: 'asunto', errId: 'err-asunto', msg: 'Selecciona un asunto.' },
    { id: 'mensaje',errId: 'err-mensaje',msg: 'El mensaje es obligatorio.' },
  ];

  campos.forEach(({ id, errId, msg }) => {
    const el = document.getElementById(id);
    const err = document.getElementById(errId);
    if (!el.value.trim()) {
      err.textContent = msg;
      el.classList.add('invalid');
      valid = false;
    } else {
      err.textContent = '';
      el.classList.remove('invalid');
    }
  });

  // Validar formato email
  const emailEl = document.getElementById('email');
  const emailErr = document.getElementById('err-email');
  if (emailEl.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value)) {
    emailErr.textContent = 'Ingresa un correo válido.';
    emailEl.classList.add('invalid');
    valid = false;
  }

  if (valid) {
    this.style.display = 'none';
    document.getElementById('successMsg').style.display = 'block';
  }
});

// Limpiar error al escribir
document.querySelectorAll('input, select, textarea').forEach(el => {
  el.addEventListener('input', () => {
    el.classList.remove('invalid');
    const err = document.getElementById('err-' + el.id);
    if (err) err.textContent = '';
  });
});
