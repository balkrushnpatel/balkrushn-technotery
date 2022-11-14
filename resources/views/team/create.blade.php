@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ (!empty($teams))?'View':'Create'}} Team
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12 text-right">
            			<a href="{{ route('team.index') }}" class="btn btn-info mb-2 text-white"><< Back</a>
            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                     <form id="teamForm" action="{{ route('team.index')}}" method="POST">
	                     	@csrf
	                     	<div class="row">
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label for="name">Name <sup class="required">*</sup></label>
			                     		<input type="text"  name="name" class="form-control" value="{{ (!empty($teams))?$teams->name:old('name') }}"  {{ (!empty($teams))?'disabled':''}}/>
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label>Club <sup class="required">*</sup></label>
			                     		<select name="club_id" id="club_id" class="form-control select2"  {{ (!empty($teams))?'disabled':''}}>
			                     			<option value="">Select</option>
			                     			@foreach($clubs as $key=>$name)
			                     				<option value="{{$key}}" {{ ((!empty($teams) && ($teams->club_id == $key)) || (old('club_id') == $key))?'selected':'' }}>{{$name}}</option>
			                     			@endforeach
			                     		</select>
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-12 text-center">
			                     	 <a href="{{ route('team.index') }}" class="btn btn-danger">Cancel</a>
	                     			@if(empty($teams))
			                     	 	<button type="submit" class="btn btn-success">Create Team</button>
			                     	 @endif
			                    </div>
			                </div>
	                     </form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$("#teamForm").validate({
    	rules: {
            name: {
            	required :true,
            },
            club_id: {
                required: true, 
            }, 
	    },
	    messages: {
	        name : {
	            required:"You must enter a team name",
	        },
	        club_id : {
	            required:"You must select a club name",
	        },
	    },
	    errorClass: "error",
	    errorElement: "div",
	    errorPlacement: function(error, element) {
	        var placement = $(element).data('error');
	        if (placement) {
	            $(element).append(error)
	        } else {
	            error.insertAfter(element);
	        }
	    },
	    submitHandler: function (form) {
	        return true;
	    }, 
        messages: {
            name: "Please enter team name",
            club_id: "Please select a club name", 
        }, 
    });
</script> 
@endpush