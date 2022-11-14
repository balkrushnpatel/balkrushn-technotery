@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Club Master') }}
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<a href="{{ route('club.create') }}" class="btn btn-info mb-2 text-white">Create Club</a>

            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                    <table id="clubTable" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Index</th>
					                <th>Name</th>
					                <th>Location</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					             @foreach($allClubs as $key=>$item) 
					             	<tr>
					             		<td>{{ ($key + 1) }}</td>
					             		<td>{{ $item->name }}</td>
					             		<td>{{ $item->location }}</td>
					             		<td>
					             			<a href="{{ route('club.show',encrypt($item->id)) }}"> View</a>
					             		</td>
					             	</tr>
					             @endforeach
					        </tbody>
					    </table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $('#clubTable').DataTable(); 
    });
</script>
@endpush
