<div class="left_part">
	@foreach($menu['sub_menu'] as $item)
	<div class="tag">
		<a href="{{$item['path']}}" @if($item['active']) class="active" style="color:#ff6600;" @endif>{{$item['name']}}</a>
	</div>
	@endforeach
</div>