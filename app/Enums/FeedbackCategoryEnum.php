<?php

namespace App\Enums;

enum FeedbackCategoryEnum: string
{
    use EnumTrait;

    case BugReport = 'bug-report';
    case FeatureRequest = 'feature-request';
    case Improvement = 'improvement';
}
