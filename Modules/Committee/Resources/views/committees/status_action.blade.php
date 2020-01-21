@foreach($committee->getNominationDepartmentsWithRef() as $department)
{{ $department->pivot->has_nominations==1?__('committee::committees.nomination_done'):__('committee::committees.nomination_not_done') }}  
@endforeach

  
        
