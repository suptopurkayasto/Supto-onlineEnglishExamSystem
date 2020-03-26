
@foreach($grammarQuestions as $grammarQuestion)
    @if(3 === $grammarQuestion->set->id)
        {{ $grammarQuestion->question }}
    @endif
@endforeach
