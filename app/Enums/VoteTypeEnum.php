<?php

namespace App\Enums;

enum VoteTypeEnum: string
{
    use EnumTrait;

    case UpVote = 'upvote';
    case DownVote = 'downvote';
}
