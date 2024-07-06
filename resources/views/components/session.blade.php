@php
    $type??=$key;
@endphp
@if (session($key))
    <div class="container">
        <div class="alert alert-{{$type}} alert-dismissible fade show mt-3 w-75" role="alert" id="alert-{{$type}}">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{session($key)}} <strong>{{$slot}}</strong>
        </div>
    </div>
    <script>
        setTimeout(() => {
        document.getElementById('alert-{{ $type }}')?.remove();
        }, 5000);
    </script>
@endif
