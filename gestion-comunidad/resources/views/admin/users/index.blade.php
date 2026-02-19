@extends('layouts.admin')

@section('title', 'Gestión de Usuarios - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5">

        {{-- Header Section --}}
        <x-admin.users.header />

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Filters Card --}}
        <x-admin.users.filters />

        {{-- Users List --}}
        <x-admin.users.table :users="$users" />

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="mt-2">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif

    </div>
@endsection