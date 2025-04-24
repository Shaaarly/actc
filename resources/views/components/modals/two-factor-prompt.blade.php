<div class="modal fade" id="twoFactorPrompt" tabindex="-1" aria-labelledby="twoFactorPromptLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title" id="twoFactorPromptLabel">Mejora la seguridad de tu cuenta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>Te recomendamos activar la autenticación en dos pasos (2FA) para proteger mejor tu cuenta. ¡Solo toma un minuto y añade una capa extra de seguridad!</p>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Ahora no</button>
          <a href="{{ route('two-factor.setup') }}" class="btn btn-primary">Activar 2FA</a>
        </div>
      </div>
    </div>
  </div>
  