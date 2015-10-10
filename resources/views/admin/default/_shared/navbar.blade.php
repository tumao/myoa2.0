<div>
    <ul class="breadcrumb">
    	@foreach($menu['navbar'] as $navbar)
        <li>
            <a href="{{$navbar->path}}">{{$navbar->name}}</a>
        </li>
        @endforeach
    </ul>
</div>

	