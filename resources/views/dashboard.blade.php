<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="hero py-8">
                    <div class="hero-content text-center">
                        <div class="max-w-md">
                            <h1 class="text-5xl font-bold">Mural de posts!</h1>
                            <p class="py-6">
                                Recados, avisos, notícias e etc. Crie um post e veja no mural
                            </p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary dark:text-white">Criar Post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg flex gap-4 flex-wrap p-4 items-center justify-center">
                @foreach ($posts as $post)
                    <div class="card w-1/4 shadow-2xl bg-white dark:bg-gray-800">
                        <figure>
                            <img src="{{ url('storage/' . $post->imagem) }}" alt="">
                        </figure>
                        <div class="card-body">
                            <small>Autor: {{ $post->user->name }}</small>
                            <div class="card-title">
                                <h3>{{ $post->title }}</h3>
                                <div
                                    class="badge 
                                    @if ($post->type === 'geral') badge-primary @endif
                                    @if ($post->type === 'recado') badge-warning @endif
                                    @if ($post->type === 'noticia') badge-success @endif
                                    @if ($post->type === 'aviso') badge-error @endif
                                    ">
                                    {{ $post->type }}
                                </div>
                            </div>
                            <p>{{ $post->content }}</p>
                            <div class="card-actions justify-end">
                                @if ($post->user_id === auth()->user()->id)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                        Editar
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                            Deletar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
