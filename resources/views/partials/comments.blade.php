<div class = "mt-10">
    <div class = "flex">
      <div>
        <img class = "rounded-full w-8 h-8 mr-6"
        src="{{$comment->user->profile_photo_url}}" alt = "{{$comment->user->name}}">
      </div>
      <h2>{{$comment->user->name}} {{$comment->user_id == auth()->id() ? '(You)' : ''}}</h2>
    </div>
    <div class = "flex">
      @include('partials.starts', ['rate' => $comment->stars])
      <p class = "mt-4 ml-6 text-gray-500">{{date('d-M-y', strtotime($comment->created_at))}}</p>
    </div>
    <p class = "mt-4 text-gray-500">
      {{$comment->message}}
    </p>
</div>
