@php
    $type??=$key;
@endphp
@if (session($key))
    <div class="alert alert-{{$type}} alert-dismissible fade show mt-3" role="alert" id="alert-{{$type}}">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{session($key)}} <strong>{{$slot}}</strong>
    </div>
    <script>
        setTimeout(() => {
        document.getElementById('alert-{{ $type }}')?.remove();
        }, 5000);
    </script>
@endif