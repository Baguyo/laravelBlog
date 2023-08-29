<p class="text-muted">
    {{ empty(trim($slot)) ? 'Added ' : $slot  }} {{ $date->diffForHumans() }}
    
    @if (isset($userID))
        By: <a href="{{ route('users.show', ['user'=>$userID]) }}"> {{ $name }}</a>
    @else
        By: {{ $name }}
    @endif

</p>