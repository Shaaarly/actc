@extends('users.layouts.settings')

@section('settings-content')
    <h4 class="mb-4 mt-4 text-dark">Notificaciones</h4>
    <h5 class="text-muted mb-4">Elige qué tipo de notificaciones deseas recibir</h5>

    <form action="{{ route('notifications.update') }}" method="POST">
        @csrf
        @method('PUT')
    
        {{-- Seguridad --}}
        <input type="hidden" name="notifications[security]" value="0">
        <div class="form-check mb-2">
            <input type="checkbox" name="notifications[security]" id="notif_security" value="1"
                   class="form-check-input"
                   {{ old('notifications.security', $user->notifications['security'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="notif_security">Cambios de seguridad en la cuenta</label>
        </div>
    
        {{-- Pagos --}}
        <input type="hidden" name="notifications[payments]" value="0">
        <div class="form-check mb-2">
            <input type="checkbox" name="notifications[payments]" id="notif_payments" value="1"
                   class="form-check-input"
                   {{ old('notifications.payments', $user->notifications['payments'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="notif_payments">Alertas de nuevos pagos o vencimientos</label>
        </div>
    
        {{-- Recordatorios --}}
        <input type="hidden" name="notifications[reminders]" value="0">
        <div class="form-check mb-2">
            <input type="checkbox" name="notifications[reminders]" id="notif_reminders" value="1"
                   class="form-check-input"
                   {{ old('notifications.reminders', $user->notifications['reminders'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="notif_reminders">Recordatorios de renovación de contrato</label>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3">Guardar preferencias</button>
    </form>
    
@endsection
