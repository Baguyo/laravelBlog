<div class="mb-2 mt-2">

    @auth

        @errors @enderrors
        {{-- {{ route('post.comment.store', ['post'=>$post->id]) }} --}}
        <form action="{{ $route }}" method="POST" class="form">

            @csrf

            <div class="mb-3">
            <label for="" class="form-label"></label>
            <textarea class="form-control" name="content" id="" rows="3" ></textarea>
            </div>

            <input type="submit" name="submit" class="btn btn-primary  text-white d-block" value="{{ __('Add comment') }}">

        </form>    
    @else

        <p>
            <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Sign in') }} </a> {{ __("to post comments") }}
        </p>

    @endauth

</div>
<hr>