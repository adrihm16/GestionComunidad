@extends('layouts.app')

@section('title', 'Mi Perfil - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-6">

    {{-- Información Personal --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Información personal'])
        @include('profile.partials.update-profile-information-form')
    </section>

    {{-- Cambiar Contraseña --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Seguridad'])
        @include('profile.partials.update-password-form')
    </section>

    {{-- Eliminar Cuenta --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Zona peligrosa'])
        @include('profile.partials.delete-user-form')
    </section>

</div>
@endsection
