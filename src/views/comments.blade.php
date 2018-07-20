<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (is_null($comments) || count($comments)< 1)
                <div class="page-header">
                    <h1>
                        Comments
                        <small class="pull-right">0 comments</small>
                    </h1>
                </div>

                <div class="alert alert-info">
                    No Comments
                </div>
            @else
                <div class="page-header">
                    <h1>
                        Comments
                        <small class="pull-right">{{count($comments)}} comment(s)</small>
                    </h1>
                </div>

                <ul class="media-list" id="comment-list">
                    @foreach($comments as $comment)
                        @include('eupheme-laravel-sdk::single-comment', ['comment'=>$comment, 'withChildren' => true])
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="col-md-8">
            <form method="POST" action="/eupheme-save-comment" onsubmit="submitForm(event, '#comment-list')">
                <div class="form-group">
                    <input type="hidden" name="instance" value="{{$eupheme_instance or ''}}"/>
                    <input type="hidden" name="status" value="{{config('eupheme-laravel-sdk.auto_approve')}}"/>
                    <input type="hidden" name="ext_ref" value="{{$eupheme_ext_ref}}"/>
                    <input type="hidden" name="user_id" value="{{$authUserID}}"/>
                    <input type="hidden" name="parent_id"/>
                    <textarea name="text" class="form-control" placeholder="Add new comment..."></textarea>
                    <button class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function submitForm(e , listID) {
        e.preventDefault();
        var data = $(e.target).serialize();

        $.post(e.target.action, data).then((data) => {
                $(listID).append(data);
                $(e.target)[0].reset();
            }
        )
        return false;
    }
</script>