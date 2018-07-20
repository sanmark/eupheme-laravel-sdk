<li class="media">
    <div class="media-left"></div>
    <div class="media-body">
        <h4 class="media-heading">
            <span>{{$userHelper->getUserNameFromID($comment->userID)}}</span>
            <small class="pull-right">{{$comment->getCreateTime()}}</small>
        </h4>
        <p>{{$comment->text}}</p>

        @if(isset($withChildren) && $withChildren)
            <ul class="media-list" id="reply-list-{{$comment->id}}">
                @foreach($comment->children as $child)
                    @include('eupheme-laravel-sdk::single-comment', ['comment' => $child, 'withChildren' => false])
                @endforeach
            </ul>

            <form method="POST" action="/eupheme-save-comment"
                  onsubmit="submitForm(event, '#reply-list-{{$comment->id}}')">
                <div class="form-group">
                    <input type="hidden" name="instance" value="{{$eupheme_instance or ''}}"/>
                    <input type="hidden" name="status" value="{{config('eupheme-laravel-sdk.auto_approve')}}"/>
                    <input type="hidden" name="ext_ref" value="{{$eupheme_ext_ref or ''}}"/>
                    <input type="hidden" name="user_id" value="{{$authUserID}}"/>
                    <input type="hidden" name="parent_id" value="{{$comment->id}}"/>
                    <textarea name="text" class="form-control" placeholder="Reply to comment..."></textarea>
                    <button class="btn btn-primary">Reply</button>
                </div>
            </form>
        @endif

    </div>
</li>