@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ (!empty($clubs))?'View':'Create'}} Club
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12 text-right">
            			<a href="{{ route('club.index') }}" class="btn btn-info mb-2 text-white"><< Back</a>
            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                     <form id="clubForm" action="{{ route('club.index')}}" method="POST">
	                     	@csrf
	                     	<div class="row">
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label for="name">Name <sub class="required">*</sub></label>
			                     		<input type="text"  name="name" class="form-control" value="{{ (!empty($clubs))?$clubs->name:old('name') }}"  {{ (!empty($clubs))?'disabled':''}}/>
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label>Location <sub class="required">*</sub></label>
			                     		<input type="text"  name="location" class="form-control" value="{{ (!empty($clubs))?$clubs->location:old('location') }}"  {{ (!empty($clubs))?'disabled':''}} />
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-12 text-center">
			                     	 <a href="{{ route('club.index') }}" class="btn btn-danger">Cancel</a>
	                     			@if(empty($clubs))
			                     	 	<button type="submit" class="btn btn-success">Create Club</button>
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
	$("#clubForm").validate({
    	rules: {
            name: {
            	required :true,
            },
            location: {
                required: true, 
            }, 
	    },
	    messages: {
	        name : {
	            required:"You must enter a club name",
	        },
	        location : {
	            required:"You must enter a location",
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
    });
</script>  
@endpush