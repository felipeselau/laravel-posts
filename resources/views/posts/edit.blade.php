<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="w-1/2 p-16">
                    @method('PUT')
                    @csrf

                    <div class="form-control mt-4">
                        <label class="label" for="title">Título do post:</label>
                        <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="input input-primary"
                        required    
                        value="{{ $post->title }}"  
                        placeholder="Título do post">
                    </div>

                    <div class="form-control mt-4">
                        <label class="label" for="content">Conteúdo do post:</label>
                        <textarea 
                        name="content" 
                        id="content" 
                        class="textarea textarea-primary" 
                        placeholder="Conteúdo do post"
                        required
                        >{{ $post->content }}</textarea>
                    </div>

                    <div class="form-control mt-4">
                        <label for="type" class="label">Tipo de post</label>
                        <select name="type" id="type" class="select select-bordered w-full">
                            <option value="" disabled>Selecione o tipo de post</option>
                            <option @if($post->type == "geral") selected @endif value="geral">Geral</option>
                            <option @if($post->type == "recado") selected @endif value="recado">Recado</option>
                            <option @if($post->type == "noticia") selected @endif value="noticia">Notícia</option>
                            <option @if($post->type == "aviso") selected @endif value="aviso">Aviso</option>
                        </select>
                    </div>

                    <div class="form-control mt-4">
                        <label for="imagem">Imagem do post</label>
                        <input type="file" accept="image" name="imagem" id="imagem" class="file-input file-input-primary">
                    </div>

                    <div class="form-control mt-4">
                        <button type="submit" class="btn btn-primary">Editar Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
