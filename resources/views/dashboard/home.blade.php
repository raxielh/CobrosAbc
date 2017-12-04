@extends('layouts.app')

@section('content')
    <h4 style="margin: 6px;color: #676767;font-weight: 200;">Capital Base: {{($data['datos'][0]["total"])}} </h4>
	
	<script type="text/javascript">
	$(function() {
	  $("#home").addClass("active");
	});
	</script>
@endsection
