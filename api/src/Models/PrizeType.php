<?php

namespace OlZyuzin\Models;

enum PrizeType: string
{
    case Score = 'score';
    case Thing = 'thing';
    case Money = 'money';
}