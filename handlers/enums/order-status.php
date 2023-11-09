<?php

enum OrderStatus
{
    case NotStarted; // Order recieved, but not yet started
    case Started; //Order started
    case Ready; // Order is ready for collection
    case Completed; // Order has been collected and receipt is confirmed
    case Cancelled; // Order cancelled
}