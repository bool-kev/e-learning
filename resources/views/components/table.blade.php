@props(['datas'])
@dd($datas)
<table class="table table-striped table-hover table-bordered mt-3">
    <thead>
        <tr>
            @foreach (array_keys($datas) as $key)
             <th scope="col">{{$key}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach (array_values($datas) as $item)
            <tr>
                <td class="" >{{$item}}</td>
            </tr>
        @endforeach
    </tbody>
</table>