@csrf

        @errors @enderrors

        <div class="mb-3">
            <label for="">{{ __('Title') }}</label>
            <input type="text" name="title" id="" value="{{ old('title', $post->title ?? null)}}" class="form-control">
        </div>

        

        <div class="mb-3">
            <label for="">{{ __('Content') }}</label>
            <input type="text" name="content" id="" value="{{old('content', $post->content ?? null)}}" class="form-control">            
        </div>

        <div class="mb-3">
          <label for="" class="form-label">{{ __('Thumbnail') }}</label>
          <input type="file" class="form-control-file" name="thumbnail" id="" placeholder="" aria-describedby="fileHelpId">
        </div>

        <input type="submit" name="submit" value="{{ __('Add') }}"  class="btn btn-primary text-white">

        

        