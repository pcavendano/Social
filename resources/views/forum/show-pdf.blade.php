<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <style>
        p{
            text-align: justify;
        }
    </style>
</head>
<body>
    <h3>{{$forumPost->title}}</h3>
    <p>{!! $forumPost->body !!}</p>
    <p><strong>Category:</strong> @isset($forumPost->forumHasCategory->category) {{ $forumPost->forumHasCategory->category }} @endisset</p>
    <p><strong>Author:</strong> {{ $forumPost->forumHasUser->name}}</p>
</body>
</html>
