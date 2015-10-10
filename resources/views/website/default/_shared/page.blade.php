<div class="page" style="clear:both;">
@if($data['checked']['page']>1)
<a class="up_page" href="javascript:void(0)">上一页</a>
@endif
@if($data['sum_page'] > 1 && $data['sum_page'] <=5)
	@for($i=1; $i<=$data['sum_page']; $i++)
	<a href="javascript:void(0)" data-page="{{$i}}"
		class="npage @if($data['checked']['page'] == $i)
				checkedon
				@endif
		"
	>{{$i}}</a>
	@endfor
@elseif($data['sum_page'] > 5)
	@for($i=-2; $i<=$data['checked']['page']; $i++)
	<a href="javascript:void(0)" data-page="{{$i}}"
		class="npage @if($data['checked']['page'] -2 == $i)
				checkedon
				@endif
		"
	>{{$data['checked']['page'] + $i}}</a>
	@endfor
@endif
@if($data['checked']['page'] < $data['sum_page'])
<a class="down_page" href="javascript:void(0)">下一页</a>
@endif
<input id="sum_page" type="hidden" value="{{$data['sum_page']}}" />
</div>