@if(isset($data['isHomePage']))
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<script type="text/javascript" src="/default/app/js/website-merchandise.js"></script>
<style type="text/css">
	.search_value{
		padding-top: 108px;
		padding-left: 60px;
	}
	.btn.btn-default.search_it{
		float: right;
		margin-top: 80px;
		margin-right: 50px;
	}
</style>
@endif
	<div class="search_box">
		<span>从</span>	<input id="from" type="text" placeholder="起运地" value="{{$data['checked']['from']}}">
		<span>到</span> <input id="to" type="text" placeholder="目的地" value="{{$data['checked'][
		'to']}}">
		@if(!isset($data['isHomePage']))
		<button id="search" class="btn btn-default search_it" type="button">搜索货源</button>
		@endif
	</div>
	<div class="tags">
		<div class="att">
			<div class="att_key">货物类型:</div>
			<div class="att_val merchandise_type">
				<ul>
					<li data-merchandise-type="0"
						@if(empty($data['checked']['merchandise_type']))
							class="check"
						@endif
					>不限</li>
					@foreach($data['mer_type'] as $item)
					<li data-merchandise-type="{{$item->id}}"
						@if(!empty($data['checked']['merchandise_type']) && $data['checked']['merchandise_type'] == $item->id)
							class="check"
						@endif

					>{{$item->type_name}}</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="att">
			<div class="att_key">运输类型:</div>
			<div class="att_val merchandise_shipping_method">
				<ul>
					<li data-merchandise-shipping-method="0"
						@if(empty($data['checked']['merchandise_shipping_method']))
							class="check"
						@endif
					>不限</li>
					@foreach($data['mer_shipping_type'] as $item)
					<li data-merchandise-shipping-method="{{$item->id}}"
						@if(!empty($data['checked']['merchandise_shipping_method']) && $data['checked']['merchandise_shipping_method'] == $item->id)
							class="check"
						@endif
					>{{$item->shipping_method}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>