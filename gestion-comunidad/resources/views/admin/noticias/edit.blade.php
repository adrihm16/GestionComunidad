@extends('layouts.admin')

@section('title', 'Editar Noticia - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5">

        {{-- Back button --}}
        <a href="{{ route('admin.noticias.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Volver a noticias
        </a>

        {{-- Page Title --}}
        @include('components.ui.section-title', ['title' => 'Editar noticia', 'titleClass' => 'text-xl'])

        {{-- Form Card --}}
        @component('components.ui.card', ['hover' => false])
        <form action="{{ route('admin.noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-5">
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div class="flex flex-col gap-1.5">
                <label for="titulo" class="text-sm font-medium text-main">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}"
                    placeholder="Ej: Nueva normativa de reciclaje en la comunidad" required maxlength="150" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                   placeholder-gray-400 bg-white
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200
                                   @error('titulo') border-red-400 ring-2 ring-red-100 @enderror">
                @error('titulo')
                    <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contenido --}}
            <div class="flex flex-col gap-1.5">
                <label for="contenido" class="text-sm font-medium text-main">
                    Contenido <span class="text-red-500">*</span>
                </label>
                <textarea id="contenido" name="contenido" rows="8"
                    placeholder="Escribe el contenido completo de la noticia..." required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                   placeholder-gray-400 bg-white resize-none
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200
                                   @error('contenido') border-red-400 ring-2 ring-red-100 @enderror">{{ old('contenido', $noticia->contenido) }}</textarea>
                @error('contenido')
                    <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen actual --}}
            @if($noticia->adjunto_url)
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-main">Imagen actual</label>
                    <div class="relative w-full h-48 rounded-xl overflow-hidden border border-gray-100">
                        <img src="{{ $noticia->adjunto_url }}" alt="Imagen actual" class="w-full h-full object-cover">
                    </div>
                    <p class="text-xs text-muted">Puedes subir una nueva imagen para reemplazarla</p>
                </div>
            @endif

            {{-- Nueva imagen --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-main">
                    {{ $noticia->adjunto_url ? 'Nueva imagen' : 'Imagen' }}
                    <span class="text-xs text-muted font-normal">(opcional)</span>
                </label>

                <div id="upload-area" class="relative w-full border-2 border-dashed border-gray-200 rounded-xl
                                    transition-all duration-200 hover:border-primary/40 hover:bg-primary/5
                                    @error('imagen') border-red-400 @enderror">

                    <input type="file" id="imagen" name="imagen" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this)">

                    <div id="upload-placeholder" class="flex flex-col items-center justify-center py-8 px-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-main mb-0.5">Adjuntar imagen</p>
                        <p class="text-xs text-muted">JPG, PNG o WebP · Máx. 2 MB</p>
                    </div>
                </div>

                <div id="preview-container" class="hidden relative">
                    <img id="preview-image" src="" alt="Preview"
                        class="w-full h-48 object-cover rounded-xl border border-gray-100">
                    <button type="button" onclick="removeImage()" class="absolute top-2 right-2 flex items-center justify-center w-8 h-8 rounded-full
                                           bg-red-500 text-white shadow-lg transition-all duration-200
                                           hover:bg-red-600 hover:scale-110 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @error('imagen')
                    <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full py-3 rounded-xl bg-primary text-white text-sm font-semibold
                               shadow-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-xl
                               hover:shadow-primary/30 active:scale-[0.98]">
                Actualizar noticia
            </button>
        </form>
        @endcomponent

    </div>

    <script>
        function previewImage(input) {
            const uploadArea = document.getElementById('upload-area');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    uploadArea.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const uploadArea = document.getElementById('upload-area');
            const previewContainer = document.getElementById('preview-container');
            const fileInput = document.getElementById('imagen');

            fileInput.value = '';
            uploadArea.classList.remove('hidden');
            previewContainer.classList.add('hidden');
        }
    </script>
@endsection