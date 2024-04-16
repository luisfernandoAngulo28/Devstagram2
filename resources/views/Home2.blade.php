@if($posts->count())
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($posts as $post)
                <div>
                    <a href="{{ route('posts.show',['post'=>$post,'user'=>$user])}}">

                        <img src="{{ asset('uploads').'/'.$post->imagen }}" 
                        alt="Imagen del post {{$post->titulo }}" >
                    </a>
                </div>            
            @endforeach   
        </div>
        <div class="my-10">
            {{ $posts->links() }}
        </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif

        esta linea se reemplaza por el 
        <x-listar-post :posts="$posts"/>
    <!--------------Codigo livewire------------------------------------------------->
    <div class="flex gap-2 items-center">
        <button
            wire:click="like"
        >
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-6 w-6" 
                fill="{{ $isLiked ? "red" : "white" }}" 
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>

        <p class="font-bold">{{ $likes }} 
            <span class="font-normal"> Likes</span>
        </p>
    </div>    
<!--------------Comentario Multilinea en blade.php------------------------------------------------->

     {{--               @if($post->checkLike(auth()->user()))
                <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                    <div class="my-4">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" 
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597
                                1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 
                                3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>                        
                </form>
                @else
                    <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                        @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" 
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597
                                    1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 
                                    3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>                        
                    </form>
                @endif

   
    -- Todo ese codigo se puede meter un metodo del evento gracias a @livewire             
    --------------------------aqui un ejemplo
    public function like()
    {
        if( $this->post->checkLike( auth()->user() )) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }             
                  --}} 
