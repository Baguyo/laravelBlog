 <div class="card border {{$margin ?? ""}} ">
              
              <div class="card-body">

                <h4 class="card-title"> {{ $title }} </h4>
                <p class="card-text"> {{ $caption }} </p>

              </div>

                <ul class="list-group">

                @if ( is_a($items, 'Illuminate\Support\Collection' ) )
                    @foreach ($items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item }}
                        </li>
                    @endforeach    
                @else
                    {{$items}}
                @endif

                

                </ul>

</div>