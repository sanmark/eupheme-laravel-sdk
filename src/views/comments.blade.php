<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (is_null($comments))
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

                <ul class="media-list">
                    @foreach($comments as $comment)
                        <li class="media">
                            <div class="media-left"></div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <span>{{$comment->userID or "Anonymous"}}</span>
                                    <small class="pull-right">{{$comment->getCreateTime()}}</small>
                                </h4>
                                <p>{{$comment->text}}</p>

                                <ul class="media-list">
                                    @foreach($comment->children as $reply)
                                        <li class="media">
                                            <div class="media-left"></div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <span>{{$reply->userID or "Anonymous"}}</span>
                                                    <small class="pull-right">{{$reply->getCreateTime()}}</small>
                                                </h4>
                                                <p>{{$reply->text}}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


    </div>
</div>
</div>