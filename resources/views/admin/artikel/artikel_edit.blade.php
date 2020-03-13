@extends('layouts.dashboard')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3>{{ $title }}</h3>
			</div>
			<div class="box-body">
				<form role="form" method="POST" action="{{ url('admin/artikel/'.$at->artikel_id) }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="text" class="form-control" name="judul" value="{{ $at->judul }}">
					</div>
					<div class="form-group">
						<div class="row" style="margin: 0;">
							@if(isset($at->foto) && $at->foto != '')
							<div style="width: 20%;">
								<img src="{{ asset('/public/'.$at->foto) }}" width="100%">
							</div>
							@endif

							<div class="col-12">
								<input type="file" class="form-control" name="foto">
							</div>
						</div>
					</div>
					<div class="form-group">
						<textarea name="isi" class="form-control textarea" rows="20">{!! $at->isi !!}</textarea>
					</div>
					<button type="submit" class="btn btn-success btn-block">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		var flash = "{{ Session::has('pesan') }}";
		if(flash){
			var pesan = "{{ Session::get('pesan') }}";
			alert(pesan);
		}
	})
</script>

@endsection