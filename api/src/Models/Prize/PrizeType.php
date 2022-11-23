<?php

namespace OlZyuzin\Models\Prize;

enum PrizeType: string
{
    case Score = 'score';
    case Thing = 'thing';
    case Money = 'money';
}